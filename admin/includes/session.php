<?php

class Session {

    //Props
    private $signed_in = false;
    public $user_id;
    
    //Pre Method
    function __construct()
    {
        //Start Session
        session_start();

        //Check Session
        $this->check_the_login();
    }

    //Check User Signed In / Getter Method
    public function is_signed_in(){
        return $this->signed_in;
    }

    //Login Method
    public function login($user){
        
        //Check User
        if ($user){
            //Assign  UserID & Flip SignIn Flag
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->signed_in = true;

        }

    }

    //Logout Method
    public function logout(){
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->signed_in = false;
    }

    //Check User Login
    private function check_the_login(){
        //Check If User Has Session
        if(isset($_SESSION['user_id'])){
            //Set UserID & Signed In Flag
            $this->user_id = $_SESSION['user_id'];
            $this->signed_in = true;
        }
        else{
            //Unset UserID and Set SignedIn False
            unset($this->user_id);
            $this->signed_in = false;
        }
    }


}

//Instatuate Session
$session = new Session();

?>