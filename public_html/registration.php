<?php

session_start();
# header('location:login.php');

$con = mysqli_connect('localhost', 'qiao6', 'Woshishen@2021');
if(!$con){
    die("connection fail: ". mysqli_connect_error());
}

mysqli_select_db($con, 'qiao6_comp3340');

$name = $_POST['user'];
$pass = $_POST['password'];

$s = "select * from users where username = '$name' ";
$result = mysqli_query($con, $s);
$num = mysqli_num_rows($result);

if($num ==1){
    echo"Username already exist!";
}else{
    $reg = "insert into users(username, password) values ('$name', '$pass')";
    mysqli_query($con, $reg);
    echo "Registration is done.";
}

?>