<?php
/**
 * Created by PhpStorm.
 * User: anasjamil
 * Date: 4/10/18
 * Time: 16:39 PM
 */
namespace common\behaviors;

use common\components\ApiSerializer;
use Yii;
use yii\base\Arrayable;
use yii\base\Behavior;
use yii\base\Model;
use yii\data\DataProviderInterface;


class ApiResponseBehavior extends Behavior
{
    public function sendFailedResponse($message, $errorMask = NULL, $name='', $code = 400, $header_status = 200)
    {


        $this->setHeader($header_status);
        $response = array(
            'code' => $code,
            'name' => $name,
            'message' =>    $message,
            'status' => $header_status,
            'type' => 'Custom error',
        );
        
        if(!empty($errorMask)) {
            if(is_array($errorMask)){
               $response['errorMask'] = Yii::t('app',$errorMask['errorMask']);
               $response['errorGroup'] = $errorMask['errorGroup'];
            }else{
                $response['errorMask'] = Yii::t('app', $errorMask);
               $response['errorGroup'] = $errorMask;
            }
            
        }
        
        return $response;

    }

    public function sendSuccessResponse($data = false, $additional_info = false, $code = 200, $header_status = 200)
    {
        $this->setHeader($header_status);

        $response = [];
        $response['code'] = $code;

        if ($data){

            if ($data instanceof Model || $data instanceof Arrayable || $data instanceof DataProviderInterface) {
                $serializer = new ApiSerializer();
                $output = $serializer->serialize($data);
                if($data instanceof DataProviderInterface){
                    $extra = $serializer->serializePagination($data->getPagination());
                    $output = ['items'=>$output,'extra'=>$extra];
                }
                $response['data'] = $output;
            }else{
                $response['data'] = $data;
            }

        }

        if ($additional_info) {
            $response = array_merge($response, $additional_info);
        }
        return $response;

    }

    protected function setHeader($status)
    {
        $text = $this->_getStatusCodeMessage($status);
        Yii::$app->response->setStatusCode($status, $text);

        //No need for this headers we already handle that in response object
        /*$status_header = 'HTTP/1.1 ' . $status . ' ' . $text;
        $content_type = "application/json; charset=utf-8";
        header($status_header);
        header('Content-type: ' . $content_type);
        header('X-Powered-By: ' . "Your Company <www.mywebsite.com>");
        header('Access-Control-Allow-Origin:*');*/

    }

    protected function _getStatusCodeMessage($status)
    {
        $codes = [
            100 => 'Continue',
            101 => 'Switching Protocols',
            102 => 'Processing',
            118 => 'Connection timed out',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            207 => 'Multi-Status',
            208 => 'Already Reported',
            210 => 'Content Different',
            226 => 'IM Used',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => 'Reserved',
            307 => 'Temporary Redirect',
            308 => 'Permanent Redirect',
            310 => 'Too many Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Time-out',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested range unsatisfiable',
            417 => 'Expectation failed',
            418 => 'I\'m a teapot',
            421 => 'Misdirected Request',
            422 => 'Unprocessable entity',
            423 => 'Locked',
            424 => 'Method failure',
            425 => 'Unordered Collection',
            426 => 'Upgrade Required',
            428 => 'Precondition Required',
            429 => 'Too Many Requests',
            431 => 'Request Header Fields Too Large',
            449 => 'Retry With',
            450 => 'Blocked by Windows Parental Controls',
            451 => 'Unavailable For Legal Reasons',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway or Proxy Error',
            503 => 'Service Unavailable',
            504 => 'Gateway Time-out',
            505 => 'HTTP Version not supported',
            507 => 'Insufficient storage',
            508 => 'Loop Detected',
            509 => 'Bandwidth Limit Exceeded',
            510 => 'Not Extended',
            511 => 'Network Authentication Required'
        ];
        return (isset($codes[$status])) ? $codes[$status] : '';
    }

   
}