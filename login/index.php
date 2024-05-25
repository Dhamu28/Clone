<?php
    $session_lifetime = 3600 * 24 * 10; // 10 days

    session_set_cookie_params ($session_lifetime);

    session_start();
    // require_once('include/db.php');
    require_once('../config.php');
    // require_once('top.php');
    // require_once('install.php');
if (isset($_POST['submit'])) {
    $userId = $_POST['user'];
    $pass = $_POST['pass'];

    echo "<pre>"; print_r($userId); echo "</pre>";
    echo "<pre>"; print_r($pass); echo "</pre>";
    // $pass = md5($pass);
    // $rows = $db->Q("SELECT * FROM `users` WHERE `phone`= '$phone' AND `pass` = '$password'");
    $q = "SELECT * FROM `student` WHERE `user`= '$userId' AND `pass` = '$pass'";
    // echo $q;
    $row = mysqli_query($conn, $q);
    $rows = mysqli_fetch_assoc($row);
    // echo "<pre>"; print_r($rows); echo "</pre>";

    if ($rows['user']) {
        $_SESSION['user']['user'] = $rows['user'];
        $_SESSION['user']['pass'] = $rows['pass'];
        
    echo "<pre>"; print_r($_SESSION['user']); echo "</pre>";

        header('location:/library/dashboard');

    } else {
        $message = 'Wrong login details! Check and try again.';
    }
}

$title = "Login: Dhamu Softech.com";
$description = $title;
mysqli_close($conn);

?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Home Page </title>
 </head>
 <body>
    <form action="" method="POST"> 
        <input type="text" placeholder="User Id" name="user"><br>
        <input type="password" name="pass"><br>
        <input type="submit" name="submit">
    </form>
    <a href="/library/logout/">Logout</a>
 </body>
 </html>