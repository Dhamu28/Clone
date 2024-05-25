<?php 
// require_once('../include/db.php');
require_once('../config.php');
// require_once('../top.php');

// echo "<pre>"; print_r($_POST); echo "</pre>";

if (isset($_POST['signup'])) {
    // check user already exits
        $name = $_POST['name'];
        $phone = $_POST['phone'];
    // $password = md5($password);
    // $rows = $db->Q("SELECT * FROM `student` WHERE `phone`= '$phone'");
    $q = "SELECT * FROM `student` WHERE `phone`= '$phone'";
    $row = mysqli_query($conn, $q);
    $rows = mysqli_num_rows($row);

    echo "<pre>"; 
    print_r($rows); 
    echo "</pre>";
    
    if ($rows <= 0) {
        // get first latter of the user
        $u = ucfirst(substr($name, 0, 1));
        // Create user name 
        $userId = "DL-$u".substr($phone, 6);
        $pass = ucfirst(substr($name, 0, 3))."#".rand(0, 999);
        $q = "INSERT INTO `student`(`name`,`phone`, `user`, `pass`) VALUES ('$name','$phone', '$userId', '$pass')";
        $rows = mysqli_query($conn, $q);
        // $db->Q("INSERT INTO `student`(`user`,`pass`) VALUES ('$userId','$pass')");
        if(!isset($rows)){
        echo "User not registerd";      
        }
        // echo "user registerd";
        echo 'You are successfully registered plese click <a href="library/login">here</a> to login';
        // $type="success";
        $done = true;

    } else {
        echo 'Sorry! but account with this phone number already exists.';
        // $type="danger";
    }
}

$title = "Create an account for join Dhamu Library";
$description = $title;
?>
<div class="container-fluid pt-2">
        <?php //require_once('../header.php'); ?>
        <div class="row justify-content-md-center mb-5 ">
            <div class="col-md-6 col-sm-12 mx-auto px-5" >
            <h1 class="mb-3 mt-5">Create an account</h1>
            <?php if($message){ ?>
                <div class="alert alert-<?=$type?>">
                    <?=$message?>
                </div>
            <?php }  if(!$done) { ?>
<form action="" method="post">
    <input type="text" placeholder="Name" name="name" class="form-control mb-2" value="<?=$name?>" required>
<input type="tel" placeholder="Enter your mobile number" maxlength="10"  name="phone" class="form-control mb-2" pattern="\d{10}" title="Your Mobile Number" value="<?=$phone?>" required>
    <!-- <input type="password" placeholder="password" name="pass" class="form-control mb-2" required> -->
    <input type="submit" name="register" value="Sign up" class=" mt-3 btn btn-dark form-control">
    <h2 class="my-4 mx-auto d-block w-100 text-center">OR</h2>
    <a href="/library/login" class="btn btn-outline-dark mx-auto d-block w-100">Login</a>
</form>
<?php } ?>
    </div>
    </div>
</div>
<footer class="blog-footer">
  <p>
<a  href="#">Dhamu Tech (Dhamu Library)</a>
         <small class="d-block mb-0 text-muted">© <?=date('Y')?></small>
</p>
</footer>

</body>
</html>

