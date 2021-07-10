<?php

session_start();

$con = mysqli_connect('localhost', 'qiao6', 'Woshishen@2021');
if(!$con){
    die("connection fail: ". mysqli_connect_error());
}

mysqli_select_db($con, 'qiao6_comp3340');

$name = $_POST['user'];
$pass = $_POST['password'];

$s = "select * from users where username = '$name' && password = '$pass' ";
$result = mysqli_query($con, $s);
$num = mysqli_num_rows($result);

if($num ==1){
    $_SESSION['username'] = $name;
    header('location:index.php');
}else{
    echo"incorrect username/password";
}

?>