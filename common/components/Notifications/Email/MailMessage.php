<?php
namespace common\components\Notifications\Email;


use common\models\EmailQueue;
use Yii;
use common\components\helpers\BeanstalkHelpers;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\helpers\HtmlPurifier;

class MailMessage {
    /*
     * Save Current User Language Befor Switch
     * */
    public $systemLanguageCode = 'en';

    private $_emailLanguageCode;

    /**
     * Contains the custom from address. If empty the adminEmail param of the
     * application will be used.
     **
     * @var string
     */
    private $_fromAddress;
    /**
     * Contains the custom from name. If empty the app name will be used.
     **
     * @var string
     */
    private $_fromName;
    /**
     * Contains the TO address list.
     **
     * @var array
     */
    private $_to = [];
    /**
     * Contains the reply-to address list.
     *
     *
     * @var array
     */
    private $_replyTo = [];
    /**
     * Contains the CC address list.
     *
     *
     * @var array
     */
    private $_cc = [];
    /**
     * Contains the BCC address list.
     *
     *
     * @var array
     */
    private $_bcc = [];
    /**
     * Contains the tags list.
     *
     *
     * @var array
     */
    private $_tags = [];
    /**
     * Contains the html-encoded subject.
     *
     *
     * @var string
     */
    private $_subject;
    /**
     * Contains the email raw text.
     *
     *
     * @var string
     */
    private $_text;
    /**
     * Contains the email HTML test.
     *
     *
     * @var string
     */
    private $_html;
    /**
     * Contains the list of attachments already processed to be used by Mandrill.
     * Each entry within the array is an array with the following keys:
     *
     * ~~~
     * [
     *  'name' => 'file.png', //the file name
     *  'type' => 'image/png', //the file mime type
     *  'content' => 'dGhpcyBpcyBzb21lIHRleHQ=' //the base64 encoded binary
     * ]
     * ~~~
     *
     *
     * @var array
     */
    private $_attachments = [];
    /**
     * Contains the list of embedded images already processed to be used by Mandrill.
     * Each entry within the array is an array with the following keys:
     *
     * ~~~
     * [
     *  'name' => 'file.png', //the file name
     *  'type' => 'image/png', //the file mime type
     *  'content' => 'dGhpcyBpcyBzb21lIHRleHQ=' //the base64 encoded binary
     * ]
     * ~~~
     *
     *
     * @var array
     */
    private $_images = [];

    /**
     * Contains the instance of \finfo used to get mime type.
     *
     * @var \finfo
     */
    private $_finfo;

    /**
     * In async mode, messages/send will immediately return a status of
     * "queued" for every recipient.
     *
     * Mandrill defaults this value to false for messages with no more than
     * 10 recipients; messages with more than 10 recipients are always sent
     * asynchronously, regardless of the value of async.
     *
     * @var boolean
     * @since 1.3.0
     */
    private $_async = false;

    /**
     * The name of the template inside mandrill.
     *
     * @var string
     * @since 1.3.0
     */
    private $_templateName;

    /**
     * The values that will be used to replace the placeholders inside the template.
     *
     * @var array
     * @since 1.3.0
     */
    private $_templateContent;

    /**
     * Value used to decide whether the message should calculate default values
     * for the sender based on the application settings or return nulls to use
     * mandrill template defaults.
     *
     * @var boolean
     * @since 1.4.0
     */
    private $_calculateDefaultValues = false;

    /**
     * Global merge vars used when sending the message to mandrill.
     *
     * @var array
     * @since 1.4.0
     */
    private $_globalMergeVars = [];



    public function __construct(){
        //setting up language
        $this->systemLanguageCode = Yii::$app->language;
        $this->_emailLanguageCode = $this->systemLanguageCode;
    }

    protected function getCharset()
    {
        return null;
    }

    /**
     * @param $charset
     * @return $this
     */
    protected function setCharset($charset)
    {
        return $this;
    }


    protected function getTags()
    {
        return $this->_tags;
    }

    /**
     * Mandrill lets you use tags to categorize your messages, making it much
     * easier to find the messages your are looking for within their website
     * dashboard.
     *
     * Stats are accumulated within mandrill using tags, though they only store
     * the first 100 they see, so this should not be unique or change frequently.
     * Tags should be 50 characters or less.
     * Any tags starting with an underscore are reserved for internal use and
     * will be ignored.
     *
     * Some common tags include *registration* and *password reset*.
     *
     *
     * @param string|array $tag tag or list of tags
     * @return self
     */
    protected function setTags($tag)
    {
        if (is_string($tag) && $this->isTagValid($tag, '_tags')) {
            $this->_tags[] = $tag;
        }

        if (is_array($tag)) {
            foreach ($tag as $singleTag) {
                if ($this->isTagValid($singleTag, '_tags')) {
                    $this->_tags[] = $singleTag;
                }
            }
        }

        return $this;
    }

    /**
     * Tells whether or not the message will be sent asynchronously.
     *
     * @return boolean
     * @since 1.3.0
     */
    public function isAsync()
    {
        return $this->_async;
    }

    /**
     * Enables async sending for this message.
     *
     * @since 1.3.0
     * @return self
     */
    public function enableAsync()
    {
        $this->_async = true;

        return $this;
    }

    /**
     * Disables async sending the this message.
     *
     * @since 1.3.0
     * @return self
     */
    public function disableAsync()
    {
        $this->_async = false;

        return $this;
    }

    /**
     * Returns the from email address in this format:
     *
     * ~~~
     * Sender Name <email@example.com>
     * ~~~
     *
     * The default value for the sender name is the application name
     * configuration parameter inside `config/web.php`.
     *
     * The default value for the sender address is the adminEmail parameter
     * inside `config/params.php`.
     *
     *
     * @return string
     */
    protected function getFrom()
    {
        $from = null;

        if ($this->getFromName()) {
            $from .= $this->getFromName();
        }

        if ($this->getFromAddress()) {
            $from .= $from === null ? $this->getFromAddress() : '<' . $this->getFromAddress() . '>';
        }

        return $from;
    }

    /**
     * Sets the message sender.
     *
     *
     * @param string|array $from sender email address.
     * You may specify sender name in addition to email address using format:
     * `[email => name]`.
     * If you don't set this parameter the application adminEmail parameter will
     * be used as the sender email address and the application name will be used
     * as the sender name.
     */
    protected function setFrom($from)
    {
        if (is_string($from) && filter_var($from, FILTER_VALIDATE_EMAIL)) {
            $this->_fromAddress = $from;
            $this->_fromName = null;
        }

        if (is_array($from)) {
            $address = key($from);
            $name = array_shift($from);
            if (!filter_var($address, FILTER_VALIDATE_EMAIL)) {
                return $this;
            }

            $this->_fromAddress = $address;
            if (is_string($name) && strlen(trim($name)) > 0) {
                $this->_fromName = trim($name);
            } else {
                $this->_fromName = null;
            }
        }

        return $this;
    }

    /**
     * Returns an array of email addresses in the following format:
     *
     * ~~~
     * [
     *  'email1@example.com', //in case no recipient name was submitted
     *  'email2@example.com' => 'John Doe', //in case a recipient name was submitted
     * ]
     * ~~~
     *
     *
     * @return array
     */
    protected function getTo()
    {
        return $this->_to;
    }

    /**
     * Sets the message recipient(s).
     *
     *
     * @param string|array $to receiver email address.
     * You may pass an array of addresses if multiple recipients should receive this message.
     * You may also specify receiver name in addition to email address using format:
     * `[email => name]`.
     *
     * @return $this
     */
    protected function setTo($to)
    {
        $this->storeEmailAddressesInContainer($to, '_to');

        return $this;
    }

    /**
     * Returns an array of email addresses in the following format:
     *
     * ~~~
     * [
     *  'email1@example.com', //in case no recipient name was submitted
     *  'email2@example.com' => 'John Doe', //in case a recipient name was submitted
     * ]
     * ~~~
     *
     *
     * @return array
     */
    protected function getReplyTo()
    {
        return $this->_replyTo;
    }

    /**
     * Sets the message recipient(s).
     *
     *
     * @param string|array $replyTo Reply-To email address.
     * You may pass an array of addresses if multiple recipients should receive this message.
     * You may also specify receiver name in addition to email address using format:
     * `[email => name]`.
     * @return $this
     */
    protected function setReplyTo($replyTo)
    {
        $this->storeEmailAddressesInContainer($replyTo, '_replyTo');

        return $this;
    }

    /**
     * Returns an array of email addresses in the following format:
     *
     * ~~~
     * [
     *  'email1@example.com', //in case no recipient name was submitted
     *  'email2@example.com' => 'John Doe', //in case a recipient name was submitted
     * ]
     * ~~~
     *
     *
     * @return array
     */
    protected function getCc()
    {
        return $this->_cc;
    }

    /**
     * Sets the message recipient(s).
     *
     *
     * @param string|array $cc cc email address.
     * You may pass an array of addresses if multiple recipients should receive this message.
     * You may also specify receiver name in addition to email address using format:
     * `[email => name]`.
     * @return $this
     */
    protected function setCc($cc)
    {
        $this->storeEmailAddressesInContainer($cc, '_cc');

        return $this;
    }

    /**
     * Returns an array of email addresses in the following format:
     *
     * ~~~
     * [
     *  'email1@example.com', //in case no recipient name was submitted
     *  'email2@example.com' => 'John Doe', //in case a recipient name was submitted
     * ]
     * ~~~
     *
     *
     * @return array
     */
    protected function getBcc()
    {
        return $this->_bcc;
    }

    /**
     * Sets the message recipient(s).
     *
     *
     * @param string|array $bcc bcc email address.
     * You may pass an array of addresses if multiple recipients should receive this message.
     * You may also specify receiver name in addition to email address using format:
     * `[email => name]`.
     *
     * @return $this
     */
    protected function setBcc($bcc)
    {
        $this->storeEmailAddressesInContainer($bcc, '_bcc');

        return $this;
    }

    /**
     * Returns the html-encoded subject.
     *
     *
     * @return string
     */
    protected function getSubject()
    {
        return $this->_subject;
    }

    /**
     * Sets the message subject.
     *
     *
     * @param string $subject
     * The subject will be trimmed.
     *
     * @return $this;
     */
    protected function setSubject($subject)
    {
        if (is_string($subject)) {
            $this->_subject = trim($subject);
        }

        return $this;
    }

    /**
     * Returns the html-purified version of the raw text body.
     *
     *
     * @return string
     */
    protected function getTextBody()
    {
        return $this->_text;
    }

    /**
     * Sets the raw text body.
     *
     *
     * @param string $text
     * The text will be purified.
     * @return $this
     */
    protected function setTextBody($text)
    {
        if (is_string($text)) {
            $this->_text = HtmlPurifier::process($text);
        }

        return $this;
    }

    /**
     * Returns the html purified version of the html body.
     *
     *
     * @return string
     */
    protected function getHtmlBody()
    {
        return $this->_html;
    }

    /**
     * Sets the html body.
     *
     *
     * @param string $html
     * @return self
     */
    protected function setHtmlBody($html)
    {
        if (is_string($html)) {
            $this->_html = $html;
        }

        return $this;
    }

    /**
     * Returns the attachments array.
     **
     * @return array
     */
    protected function getAttachments()
    {
        return $this->_attachments;
    }

    /**
     * Attaches existing file to the email message.
     *
     *
     * @param string $fileName full file name
     * @param array $options options for embed file. Valid options are:
     *
     * - fileName: name, which should be used to attach file.
     * - contentType: attached file MIME type.
     *
     * @return $this
     */
    public function attach($fileName, array $options = [])
    {
        if (file_exists($fileName) && !is_dir($fileName)) {
            $purifiedOptions = [
                'fileName' => ArrayHelper::getValue($options, 'fileName', basename($fileName)),
                'contentType' => ArrayHelper::getValue($options, 'contentType', FileHelper::getMimeType($fileName)),
            ];
            $this->attachContent(file_get_contents($fileName), $purifiedOptions);
        }

        return $this;
    }

    /**
     * Attach specified content as file for the email message.
     *
     *
     * @param string $content attachment file content.
     * @param array $options options for embed file. Valid options are:
     *
     * - fileName: name, which should be used to attach file.
     * - contentType: attached file MIME type.
     *
     * @return $this
     */
    public function attachContent($content, array $options = [])
    {
        $purifiedOptions = is_array($options) ? $options : [];

        if (is_string($content) && strlen($content) !== 0) {
            $this->_attachments[] = [
                'name' => ArrayHelper::getValue($purifiedOptions, 'fileName', ('file_' . count($this->_attachments))),
                'type' => ArrayHelper::getValue($purifiedOptions, 'contentType', $this->getMimeTypeFromBinary($content)),
                'content' => base64_encode($content),
            ];
        }
        return $this;
    }

    /**
     * Returns the images array.
     *

     *
     * @return array list of embedded content
     */
    protected function getEmbeddedContent()
    {
        return $this->_images;
    }

    /**
     * Embeds an image in the email message.
     *
     *
     * @param string $fileName file name.
     * @param array $options options for embed file. Valid options are:
     *
     * - fileName: name, which should be used to attach file.
     * - contentType: attached file MIME type.
     * @return self
     */
    public function embed($fileName, array $options = [])
    {
        if (file_exists($fileName) && !is_dir($fileName) && strpos(FileHelper::getMimeType($fileName), 'image') === 0) {
            $purifiedOptions = [
                'fileName' => ArrayHelper::getValue($options, 'fileName', basename($fileName)),
                'contentType' => ArrayHelper::getValue($options, 'contentType', FileHelper::getMimeType($fileName)),
            ];
            $this->embedContent(file_get_contents($fileName), $purifiedOptions);
        }

        return $this;
    }

    /**
     * Embed a binary as an image in the message.
     *
     *
     * @param string $content attachment file content.
     * @param array $options options for embed file. Valid options are:
     *
     * - fileName: name, which should be used to attach file.
     * - contentType: attached file MIME type.
     *
     * @return self
     */
    public function embedContent($content, array $options = [])
    {
        $purifiedOptions = is_array($options) ? $options : [];

        if (is_string($content) && strlen($content) !== 0 && strpos($this->getMimeTypeFromBinary($content), 'image') === 0) {
            $this->_images[] = [
                'name' => ArrayHelper::getValue($purifiedOptions, 'fileName', ('file_' . count($this->_images))),
                'type' => ArrayHelper::getValue($purifiedOptions, 'contentType', $this->getMimeTypeFromBinary($content)),
                'content' => base64_encode($content),
            ];
        }

        return $this;
    }

    /**
     * Sets the data to be used by the Mandrill template system.
     *
     * @param string $templateName
     * @param array $templateContent
     * @param string $templateLanguage
     *
     * @return self
     *     * @since 1.3.0
     */
    protected function setTemplateData($templateName, array $templateContent = [], $templateLanguage = self::LANGUAGE_MAILCHIMP)
    {
        $this->_templateName = $templateName;

        if ($templateLanguage === self::LANGUAGE_MAILCHIMP) {
            $this->_templateContent = $this->convertParamsForTemplate($templateContent);
        } elseif ($templateLanguage === self::LANGUAGE_HANDLEBARS) {
            $this->setGlobalMergeVars($templateContent);
        }

        $this->_mergeLanguage = $templateLanguage;

        return $this;
    }

    /**
     * Returns the name of the mandrill template to be used.
     *
     * @return string
     * @since 1.3.0
     */
    protected function getTemplateName()
    {
        return $this->_templateName;
    }

    /**
     * Returns the dynamic content used to replace blocks in the template.
     *
     * @return array
     * @since 1.3.0
     */
    protected function getTemplateContent()
    {
        return $this->_templateContent;
    }

    /**
     * Enable the use of template defaults.
     *
     * @return self
     * @since 1.4.0
     */
    public function enableTemplateDefaults()
    {
        $this->_calculateDefaultValues = true;

        return $this;
    }

    /**
     * Disable the use of template defaults.
     *
     * @return self
     * @since 1.4.0
     */
    public function disableTemplateDefaults()
    {
        $this->_calculateDefaultValues = false;

        return $this;
    }

    /**
     * Returns the global merge vars that will be submitted to mandrill.
     *
     * @return array
     * @since 1.4.0
     */
    protected function getGlobalMergeVars()
    {
        return $this->_globalMergeVars;
    }

    /**
     * Adds the given merge vars to the global merge vars array.
     * Merge vars are case insensitive and cannot start with _
     *
     * @param array $mergeVars
     *
     * @return self
     * @since 1.4.0
     */
    protected function setGlobalMergeVars(array $mergeVars)
    {
        foreach ($mergeVars as $name => $content) {
            if ($name{0} === '_') {
                continue;
            }

            array_push($this->_globalMergeVars, [
                'name' => $name,
                'content' => $content
            ]);
        }

        return $this;
    }

    /**
     * Returns the string representation of this message.
     *
     * @return string
     */
    public function toString()
    {
        return $this->getSubject() . ' - Recipients:'
        . ' [TO] ' . implode('; ', $this->getTo())
        . ' [CC] ' . implode('; ', $this->getCc())
        . ' [BCC] ' . implode('; ', $this->getBcc());
    }

    /**
     * Returns the array used by the Mandrill Class to initialize a message
     * and submit it.
     *
     * @return array
     */
    protected function getMandrillMessageArray()
    {
        return [
            'headers' => [
                'Reply-To' => $this->getReplyToString(),
            ],
            'html' => $this->getHtmlBody(),
            'text' => $this->getTextBody(),
            'subject' => $this->getSubject(),
            'from_email' => $this->getFromAddress(),
            'from_name' => $this->getFromName(),
            'to' => $this->getAllRecipients(),
            'track_opens' => true,
            'track_clicks' => true,
            'tags' => $this->_tags,
            'merge_language' => $this->_mergeLanguage,
            'global_merge_vars' => $this->_globalMergeVars,
            'attachments' => $this->_attachments,
            'images' => $this->_images,
        ];
    }

    /**
     * Stores email addresses in a private variable.
     *
     * @param string|array $emailAddresses
     * @param string $container
     */
    private function storeEmailAddressesInContainer($emailAddresses, $container)
    {
        if (is_string($emailAddresses) && $this->isRecipientValid($emailAddresses, $container)) {
            $this->{$container}[] = $emailAddresses;
        }

        if (is_array($emailAddresses)) {
            foreach ($emailAddresses as $key => $value) {
                $this->storeArrayEmailAddressInContainer($key, $value, $container);
            }
        }
    }

    /**
     * Stores the email address coming from an array, correctly placing the
     * recipient name if it exists.
     *
     * @param string|integer $key
     * @param string $value
     * @param string $container
     */
    private function storeArrayEmailAddressInContainer($key, $value, $container)
    {
        $name = is_string($key) ? $value : null;
        $singleAddress = is_string($key) ? $key : $value;
        if ($this->isRecipientValid($singleAddress, $container)) {
            if ($name) {
                $this->{$container}[$singleAddress] = $name;
            } else {
                $this->{$container}[] = $singleAddress;
            }
        }
    }

    /**
     * Checks if an email address is valid and that is not already present within
     * the private attribute.
     *
     * @param string $emailAddress
     * @param string $privateAttributeName
     * @return boolean
     */
    private function isRecipientValid($emailAddress, $privateAttributeName)
    {
        if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        if (array_search($emailAddress, $this->{$privateAttributeName}) !== false) {
            return false;
        }

        if (array_key_exists($emailAddress, $this->{$privateAttributeName}) !== false) {
            return false;
        }

        return true;
    }

    /**
     * Checks that the tag is not already in the private attribute, that is not
     * exceeding the 50 characters limit and that is not starting with an underscore.
     *
     * @param string $string
     * @param string $privateAttributeName
     * @return boolean
     */
    private function isTagValid($string, $privateAttributeName)
    {
        if (array_search($string, $this->{$privateAttributeName}) !== false) {
            return false;
        }

        if (strlen($string) > 50) {
            return false;
        }

        if ($string[0] === '_') {
            return false;
        }

        return true;
    }

    /**
     * Returns the Mime Type from the file binary.
     *
     * @param string $binary
     * @return string
     */
    private function getMimeTypeFromBinary($binary)
    {
        if ($this->_finfo === null) {
            $this->_finfo = new \finfo(FILEINFO_MIME_TYPE);
        }

        return $this->_finfo->buffer($binary);
    }

    /**
     * Gets the string rappresentation of Reply-To to be later used in the
     * email header.
     *
     * @return string
     */
    private function getReplyToString()
    {
        $addresses = [];
        foreach ($this->_replyTo as $key => $value) {
            if (is_string($key)) {
                $addresses[] = $value . ' <' . $key . '>';
            } else {
                $addresses[] = $value;
            }
        }

        return implode(';', $addresses);
    }

    /**
     * Returns the from name default value if no one was set by the user.
     *
     * @return string
     */
    private function getFromName()
    {
        if ($this->_calculateDefaultValues) {
            return $this->_fromName ? $this->_fromName : null;
        }

        return $this->_fromName ? $this->_fromName : \Yii::$app->name;
    }

    /**
     * Returns the from address default value if no one was set by the user.
     *
     * @return string
     */
    private function getFromAddress()
    {
        if ($this->_calculateDefaultValues) {
            return $this->_fromAddress ? $this->_fromAddress : null;
        }

        return $this->_fromAddress ? $this->_fromAddress : \Yii::$app->params['adminEmail'];
    }

    /**
     * Returns all the recipients in the format used by Mandrill.
     *
     * @return array
     */
    private function getAllRecipients()
    {
        $recipients = [];
        foreach ($this->_to as $key => $value) {
            $recipients[] = $this->getRecipientEntry($key, $value, 'to');
        }

        foreach ($this->_cc as $key => $value) {
            $recipients[] = $this->getRecipientEntry($key, $value, 'cc');
        }

        foreach ($this->_bcc as $key => $value) {
            $recipients[] = $this->getRecipientEntry($key, $value, 'bcc');
        }

        return $recipients;
    }

    /**
     * Generates and returns the single recipient array following Mandrill
     * API's specs.
     *
     * @param string $key
     * @param string $value
     * @param string $type
     * @return array
     */
    private function getRecipientEntry($key, $value, $type)
    {
        return [
            'email' => is_string($key) ? $key : $value,
            'name' => is_string($key) ? $value : null,
            'type' => $type,
        ];
    }

    /**
     * Converts the parameters in the format used by Mandrill to render templates.
     *
     * @param array $params
     * @return array
     * @since 1.3.0
     */
    private function convertParamsForTemplate($params)
    {
        $merge = [];
        foreach ($params as $key => $value) {
            $merge[] = ['name' => $key, 'content' => $value];
        }
        return $merge;
    }

    public function send(){
            $mailQueue = new EmailQueue();
            $mailQueue->from_address         = json_encode([$this->getFromAddress()=>$this->getFromName()]);
            $mailQueue->to_address           = json_encode( $this -> getTo() );
            $mailQueue->cc_address           = json_encode( $this -> getCc() );
            $mailQueue->bcc_address          = json_encode( $this -> getBcc() );
            $mailQueue->reply_to_address     = json_encode( $this -> getReplyTo());
            $mailQueue->subject              = $this -> getSubject();
            $mailQueue->message              = $this -> getHtmlBody();
            $mailQueue->remote_address       = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1';
            $mailQueue->http_x_forwarded_for = isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : null;
            $mailQueue->mail_content_type    = 'text/html';
            $mailQueue->mail_charset         = $this -> getCharset();
            $mailQueue->return_path          = '/';
            $mailQueue->priority             = 0;
            $mailQueue->sent                 = 0;
            $mailQueue->language_code        = $this->getLanguage() ;
            $mailQueue->attachment_pathes    = json_encode( $this->getAttachments());
            $mailQueue->save();
            BeanstalkHelpers::put( ['mail_id'=>$mailQueue->id],Yii::$app->params['BEANSTALK']['TUBES']['MAIL_QUEUE']);
        $this->_to =[];
        $this->_cc =[];
        $this->_bcc=[];
        Yii::$app->language = $this->systemLanguageCode;
    }

    public function setLanguage($languageCode){
        $this->_emailLanguageCode   = $languageCode;
        Yii::$app->language         = $this->_emailLanguageCode;
    }

    public function getLanguage(){
       return $this->_emailLanguageCode  ;

    }



}
