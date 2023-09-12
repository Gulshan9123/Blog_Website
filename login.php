<?php 

include 'config.php';
include 'header.php';
session_start();
if (isset($_SESSION['user_data'])){
    header("location:http://localhost/blog_posts/admin/index.php");
     }
?>
<div class="container">
    <div class="row">
        <div class="col-xl-5 col-md-4 m-auto p-5 mt-5 bg-info">
     <form action="" method="post">
     <h3 class="text-center">Blog! Login your Account</h3>
            <div class="mb-3">
                <input type="email" name="email" placeholder="Enter your email" class="form-control" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" placeholder="Password" class="form-control" required>
            </div>
            <div class="mb-3">
                <input type="submit" name="login_btn"  class="btn btn-primary" value="Login>>">
            </div>
            <!-- ----codiing for display error -->
            <?php 
            if(isset($_SESSION['error'])){
                $error=$_SESSION['error'];
                echo  "<p class='bg-danger p-1 text-white'>".$error."</p>";
                unset($_SESSION['error']);
            } 
            ?>
     </form>
        </div>
    </div>
</div>
<?php include 'footer.php';

// -------------php for login------------


if(isset($_POST['login_btn'])){
  $email=mysqli_real_escape_string($config,$_POST['email']);
  $password=mysqli_real_escape_string($config,sha1($_POST['password']));
//   echo $email."</br>" .$password;     this is for check email and password direct in  website 

$sql="SELECT * FROM user WHERE email='{$email}' AND password='{$password}'";
$query=mysqli_query($config,$sql);
$data=mysqli_num_rows($query);
if ($data){
    $result=mysqli_fetch_assoc($query);
    $user_data=array($result['user_id'],$result['username'],$result['role']);
    $_SESSION['user_data']=$user_data;
    header("location:admin/index.php");
}else{
    echo 
    $_SESSION['error']="Invalid Email/Password...";
    header("location:login.php");
}

}














?>