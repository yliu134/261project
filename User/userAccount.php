<?php
//start session
session_start();
//load and initialize user class
include 'user.php';
$user = new User();
if(isset($_POST['signupSubmit'])){
    //check whether user details are empty
    if(!empty($_POST['Password']) && !empty($_POST['Pnum']) && !empty($_POST['Username']) && !empty($_POST['Confirm_password'])){
        //password and confirm password comparison
        if($_POST['Password'] !== $_POST['Confirm_password']){
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Confirm password must match with the password.';
        }else{

            //insert user data in the database
            $userData = array(
				'Password' => $_POST['Password'],
                'Username' => $_POST['Username'],
                'Pnum' => $_POST['Pnum']
            );
            $insert = $user->insert($userData);
			$userData['CID'] = mysql_insert_id();
            //set status based on data insert
            if($insert){
                $sessData['status']['type'] = 'success';
                $sessData['status']['msg'] = 'You have registered successfully, log in with your credentials.';
            }else{
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'Some problem occurred, please try again.';
            }
            
        }
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'All fields are mandatory, please fill all the fields.';
    }
    //store signup status into the session
    $_SESSION['sessData'] = $sessData;
    $redirectURL = ($sessData['status']['type'] == 'success')?'index.php':'registration.php';
    //redirect to the home/registration page
    header("Location:".$redirectURL);
}elseif(isset($_POST['loginSubmit'])){
    //check whether login details are empty
    if(!empty($_POST['CID']) && !empty($_POST['Password'])){
    	 //get user data from user class
        $conditions['where'] = array(
            'CID' => $_POST['CID'],
            'Password' => md5($_POST['Password']),
            'status' => '1'
        );
        $conditions['return_type'] = 'single';
        $userData = $user->getRows($conditions);
        //set user data and status based on login credentials
        if($userData){
            $sessData['userLoggedIn'] = TRUE;
            $sessData['CID'] = $userData['CID'];
            $sessData['status']['type'] = 'success';
            $sessData['status']['msg'] = 'Welcome '.$userData['Username'].'!';
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
    header("Location:index.php");
}elseif(!empty($_REQUEST['logoutSubmit'])){
    //remove session data
    unset($_SESSION['sessData']);
    session_destroy();
    //store logout status into the ession
    $sessData['status']['type'] = 'success';
    $sessData['status']['msg'] = 'You have logout successfully from your account.';
    $_SESSION['sessData'] = $sessData;
    //redirect to the home page
    header("Location:index.php");
}else{
    //redirect to the home page
    header("Location:index.php");
}
Login Form and User Account Details (index.php)
Initially index.php file is loaded with login form and registration page link. After login, the user ID is available in session and the respective user details are shown using the User class. Also, a logout link will appear if the user already logged in.

<?php
session_start();
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
?>
<style>
    <?php
         include 'style.css';
    ?>
</style>

<div class="container">
    <?php
        if(!empty($sessData['userLoggedIn']) && !empty($sessData['CID'])){
            include 'user.php';
            $user = new User();
            $conditions['where'] = array(
                'CID' => $sessData['CID'],
            );
            $conditions['return_type'] = 'single';
            $userData = $user->getRows($conditions);
    ?>
    <h2>Welcome <?php echo $userData['Username']; ?>!</h2>
    <a href="userAccount.php?logoutSubmit=1" class="logout">Logout</a>
    <div class="regisFrm">
        <p><b>Name: </b><?php echo $userData['Username']; ?></p>
		<p><b>ID: </b><?php echo $userData['CID']; ?></p>
        <p><b>Phone: </b><?php echo $userData['phone']; ?></p>
    </div>
    <?php }else{ ?>
    <h2>Login to Your Account</h2>
    <?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>
    <div class="regisFrm">
        <form action="userAccount.php" method="post">
            <input type="" name="CID" placeholder="YOUR ID" required="">
            <input type="password" name="Password" placeholder="PASSWORD" required="">
            <div class="send-button">
                <input type="submit" name="loginSubmit" value="LOGIN">
            </div>
        </form>
        <p>New User?<a href="registration.php">Register</a></p>
    </div>
    <?php } ?>
</div>
