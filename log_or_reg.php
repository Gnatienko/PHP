<?php
session_start();
$login = $_POST['login'];
$password=$_POST['password'];

if ($login=='' or $password=='') {
    echo "please enter log\pass";
} else {

    require 'configDB.php';

    $sql = mysqli_query($connectionDB, "SELECT * FROM `users` WHERE login='$login'");
    while ($result = mysqli_fetch_array($sql)) {
       $usersArray[$result['login']]=$result['password'];
    }

    if (isset($usersArray[$login])){
       if ($usersArray[$login]==$password){
            $_SESSION['login']=$login;
            echo 'authorisation success your login is "'.$_SESSION['login'].'"';
           header('Refresh: 2; url= start_form.php');

       }
       else {
           echo "password is incorrect";
           header('Refresh: 2; url= index.html');

            }

    }
    else {
        $sql = "INSERT INTO users (login, password) VALUES ('$login', '$password')";
        mysqli_query($connectionDB, $sql);
        $_SESSION['login']=$login;
        echo 'Hi, "'.$_SESSION['login'].'" thank you for registration';
        header('Refresh: 2; url= start_form.php');
    }
}


?>