<?php require_once('init.php'); ?>

<?php
    //Check Session
    if($session->is_signed_in()){
        redirect('index.php');
    }

    //Check Postback
    if(isset($_POST['submit'])){

        //Get Form Values
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        //Verify DB User Method
        $user_found = User::verify_user($username, $password);

        if($user_found){

            //Login User
            $session->login($user_found);

            //Redirct to Index
            redirect('index.php');

        }
        else{
            //Set Invlaid Message
            $the_message = 'Your password or username are invalid!';

        }

    }
    else{
        $username = '';
        $password = '';
    }






?>