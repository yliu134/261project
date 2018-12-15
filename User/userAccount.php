<?php
//start session
session_start();
//load and initialize user class
include 'user.php';
$user = new User();
if(isset($_POST['signupSubmit'])){
if(!empty($_POST['Password']) && !empty($_POST['Pnum']) && !empty($_POST['Username']) && !empty($_POST['Confirm_password'])){
        //password and confirm password comparison
        if($_POST['Password'] !== $_POST['Confirm_password']){
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Confirm password must match with the password.';
        }else{

            $userData = array(
                'Password' => md5($_POST['Password']),
                'Username' => $_POST['Username'],
                'Pnum' => $_POST['Pnum']
            );
            $insert = $user->insert($userData);
            $userData['CID'] = mysql_insert_id();
            //set status based on data insert
            if($insert){
                $sessData['status']['type'] = 'success';
                $sessData['status']['msg'] = 'Your userID is'.$userData['CID'];
                $sessData['CID'] = $userData['CID'];
            }else{
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'Failed';
            }
            
        }
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'All fields are mandatory, please fill all the fields.';
    }
    //store signup status into the session
    $_SESSION['sessData'] = $sessData;
    $redirectURL = ($sessData['status']['type'] == 'success')?'login-reg.php':'registration.php';
    //redirect to the home/registration page
    header("Location:".$redirectURL);
}elseif(isset($_POST['loginSubmit'])){
    if(!empty($_POST['CID']) && !empty($_POST['Password'])){
    echo "1";   
    var_dump($_POST);

    $conditions['where'] = array(
            'CID' => $_POST['CID'],
            'Password' => md5($_POST['Password'])
        );
        $conditions['return_type'] = 'single';
        $userData = $user->getRows($conditions);
    var_dump($userData);
    if($userData){
            $sessData['userLoggedIn'] = TRUE;
            $sessData['CID'] = $userData['CID'];
            $sessData['status']['type'] = 'success';
            $sessData['status']['msg'] = $userData;
        }else{
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Wrong email or password, please try again.';
        }
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Enter email and password.';
    }
    //store login status into the session
    $_SESSION['sessData'] = $sessData;
    //redirect to the home page
    $redirectURL = ($sessData['status']['type'] == 'success')?'../index.php':'login-reg.php';
    //redirect to the home/registration page
    header("Location:".$redirectURL);
}elseif(!empty($_REQUEST['logoutSubmit'])){
    //remove session data
    unset($_SESSION['sessData']);
    session_destroy();
    //store logout status into the ession
    $sessData['status']['type'] = 'success';
    $sessData['status']['msg'] = 'You have logout successfully from your account.';
    $_SESSION['sessData'] = $sessData;
    //redirect to the home page
    header("Location:login-reg.php");
}else{
    //redirect to the home page
    header("Location:login-reg.php");
}
