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

    <div class="regisFrm">
        <form action="../admin.1/food.php" method="post">
            <input type="password" name="Password" placeholder="ADMIN PASSWORD" required="">
            <div class="send-button">
                <input type="submit" name="AdminSubmit" value="ADMIN_LOGIN">
            </div>
        </form>
        <p>Admin Log in?<a href="registration.php">Admin</a></p>
    </div>
    <?php } ?>
</div>

