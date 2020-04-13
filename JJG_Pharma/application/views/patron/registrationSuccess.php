<?php

if(isset($_POST) && !empty($_POST)){
    
    $lastInserted = RestClient::call("POST", $_POST,"register");
    if($lastInserted != null){
        
        ?><h2>congratulations you've registered!</h2> <?php

    }
}