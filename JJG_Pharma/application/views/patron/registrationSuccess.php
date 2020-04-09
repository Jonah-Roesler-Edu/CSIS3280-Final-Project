<?php

if(isset($_POST) && !empty($_POST)){
    $lastInserted = RestClient::call("POST", $_POST,"register");
    echo $lastInserted;
    var_dump($_POST);
}