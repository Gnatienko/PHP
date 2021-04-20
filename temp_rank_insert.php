<?php
session_start();
echo 'Hi, "'.$_SESSION['login'].'"';

$content = $_POST['contentForm'];

require 'configDB.php';

$splittedContent = explode(" ", $content);

foreach ($splittedContent as $word) {
    $splittedWord = explode("_", $word);


    $sql = "UPDATE internal_dictionary SET rank='$splittedWord[1]' WHERE en='$splittedWord[0]'";
    mysqli_query($connectionDB, $sql);
}




?>