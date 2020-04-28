<?php
namespace common\models;

use common\components\Helper;
use Yii;
use yii\validators\EmailValidator;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $email_or_phone_number;
    public $password;
    public $user_type_id = null;
    public $rememberMe = true;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email_or_phone_number', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }


    public function attributeLabels()
    {
       return [
           'email_or_phone_number' => Yii::t('app','Email or Phone number'),
           'password' => Yii::t('app','Password'),
           'rememberMe' => Yii::t('app','Remember Me'),
       ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user) {
                $this->addError($attribute, 'Incorrect (Email or phone number) or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided email_or_phone_number and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = $this->findAndValidateByEmail($this->email_or_phone_number,$this->password,$this->user_type_id);
        }
        if ($this->_user === null) {
            $this->_user = $this->findAndValidateByPhoneNumber($this->email_or_phone_number,$this->password,$this->user_type_id);
        }
        return $this->_user;
    }

    private function findAndValidateByEmail($email,$password,$user_type_id=null){
        $user = User::findByEmail($email,$user_type_id);
        if(empty($user)){
            return null;
        }
        $validatePassword = $user->validatePassword($password);
        if(!$validatePassword){
            return null;
        }
        return $user;
    }
    private function findAndValidateByPhoneNumber($phone_number,$password,$user_type_id=null){
        $user = User::findByPhoneNumber($phone_number,$user_type_id);
        if(empty($user)){
            return null;
        }
        $validatePassword = $user->validatePassword($password);
        if(!$validatePassword){
            return null;
        }
        return $user;
    }


}
