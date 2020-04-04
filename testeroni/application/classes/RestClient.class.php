<?php
//Rest client taken from LAB10 !

class RestClient {

    static function call($method, $callData = array())    {

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
        $result = file_get_contents(API_URL, false, $context);
        // API URL DEFINED IN app>config>constants.php

        return json_decode($result);

    }

}