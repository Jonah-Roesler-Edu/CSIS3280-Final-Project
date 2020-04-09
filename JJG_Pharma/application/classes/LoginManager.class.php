<?php

class LoginManager  {

    //This function checks if the user is logged in, if they are not they are redirected to the login page
    static function verifyLogin()   {

        //Check for a session
        if(!isset($_SESSION)){
            //Start it up
            session_start();
        }
        //If there is session data
        if(!empty($_SESSION)){

            
            //The user is loggedin, return true
                    if(isset($_SESSION["loggedin"])){
                        
                    return true;
                } else {

                //The user is not logged in
                //Destroy any session just in case
                session_destroy();

                //Send them back to the login pages
                return false;

                }
            }
        }
        
    
}

?>