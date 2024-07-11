<?php
$title = 'Login Page';
@session_start();
if(isset($_SESSION['token'])){
    $token = $_SESSION['token']= uniquid();
}else{
    $token = $_SESSION['token'];
}
if(isset($_COOKIE['admin_username'])){
    session_start();
    $_SESSION['admin_username']=$_COOKIE['admin_username'];
    header('location:dashboard.php');
}
if(isset($_POST['login'])){
    $process = false;
    if (isset($_POST['_token']) && ! empty($_POST['_token'])){
        $msg = "Invalid Token";
        echojson_encode(array('message'=> 'Invalid Token'));
    }else{
        $process = true;
    }
}else{
    $msg = "Token not found";
}
if($process){
    //creating new array to store error
    $err=[];
    if (isset($_POST['username']) && !empty($_POST['username'])){
        $username=$_POST['username'];
    }else{
        $err['username'] = "Enter Username";
    }
    if(isset($_POST['password']) && !empty($_POST['password'])){
        $password = md5($_POST['password']);
    }

    //checking no of error to process login
    if(count($err)==0){
        require_once "connection.php";
        $sql = "SELECT * FROM tbl_users WHERE status=1 and username= '$username' and password= '$password'";
        $result = $connect->query($sql);
        if($result->num_rows == 1){
            $user = $result->fetch_assoc();
            //start session
            @session_start();
            //store username into session
            $_SESSION ['admin_username'] = $user['username'];
            $_SESSION['admin_name'] = $user['name'];
            $_SESSION['admin_id'] = $user['id'];
            //check remember me button
            if(isset($_POST['remember'])){
                setcookie('admin_username', $username, time()+7*24*60*60);
            }
            //redirect to next page
            header ("location:dashboard.php");
        }else{
            $msg = "Login failed";
        }
    }
}
?>
<div class="container login-a">
    <div class="card">
        <div class="card-header">
            Login
        </div>
        <div class="card-body">
            <div class="container">
                <?php if (isset($_GET['msg']) && $_GET['msg']==1) {?>
                <p class = "alert alert-denger">Please login to access dashboard</p  
                <?php } ?>
                
                <?php if(isset($msg)){ ?>
                    <p class= "alert alert-danger" > <?php echo $msg ?></p>
                <?php } ?>
                    < form method = "post" action="<?php echo $_SERVER['PHP_SELF']?>"><input type= "hidden " name= "_token" value="<?php echo $token; ?>">
                    <div class = "form-group">
                        <lable for="username">Username:</lable>
                        <input type="text" class="form-control" name="username" id= "" aria-describedby = "helpId" placeholder="">
                        <?php if (isset ($err['username'])){?>
                            <span class="text-danger"><?php echo $err['username']; ?></span>
                            <?php } ?> 
                        </div>
                        <div class ="form-group">
                            <lable>
                                <input type = "checkbox" value="" name="remember"> 
                                Remember me
                            </label>
                        </div>
                        <div class="form-group">
                            <input type ="submit" class="btnbtn-primary" value= "login" name= "login">
                        </div>
                        <small class="text-muted">
                        <?php if(isset($err['message'])) echo $err['message']; ?>
                        </small>
                    </form>
                    <div>

            </div>
        </div>