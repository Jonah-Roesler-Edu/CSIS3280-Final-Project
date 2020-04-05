<?php
//Rest client taken from LAB10 !
//edited
class RestClient{

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
        //CODEIGNITER CUSTOM $this->input->raw_input_stream;
        // 'http://localhost/JJG_Pharma/RestAPI.php'
        // $result = file_get_contents('http://localhost/JJG_Pharma/testeroni/RestAPI.php', false, $context);
        $result = file_get_contents('http://localhost/JJG_Pharma/RestAPI.php', false, $context);
        // $inputClass = new CI_Input;
        

        // $result = $this->input->raw_input_stream;
        // API URL DEFINED IN app>config>constants.php
        // var_dump ($this->input->raw_input_stream);
        return json_decode($result);
        // return $result;

    }

}