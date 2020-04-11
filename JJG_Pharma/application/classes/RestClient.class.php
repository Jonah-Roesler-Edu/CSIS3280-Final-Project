<?php
//Rest client taken from LAB10 !
//edited
class RestClient{

    static function call($method, $callData = array(),String $apiChoice="")    {

        //State the request header
        $requestHeader = array('reqquesttype' => $method);

        $data = array_merge($requestHeader, $callData);

        $options = array(
            'http' => array(
                'header' => 'Content-type: application/json\r\n',
                'method' => $method,
                'content' => json_encode($data)
            )
        );

        $context = stream_context_create($options);
        // $result = file_get_contents(API_URL, false, $context);
        switch($apiChoice) {
            case "register":
                $result = file_get_contents(API_REGISTER, false, $context);
            break;
            case "profile":
                $result = file_get_contents(API_PROFILE, false, $context);
            break;
            case "medicine":
                $result = file_get_contents(API_MEDICINE, false, $context);
            break;
            case "transaction":
                $result = file_get_contents(API_TRANSACTION, false, $context);
            break;
            case "test":
                $result = file_get_contents(API_URL, false, $context);
            break;
            
            default:
                $result = file_get_contents(API_URL, false, $context);
            break;
        }
        
        return json_decode($result);
        // return $result;

    }

}