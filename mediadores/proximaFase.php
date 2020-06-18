<?php

session_start();

if(isset($_POST['dificuldade'])){
    $_SESSION['dificuldade'] = intval($_POST['dificuldade']);
}
if(isset($_POST['linguagem'])){
    
    $_SESSION['linguagem'] = intval($_POST['linguagem']);
}

var_dump($_POST);
var_dump($_SESSION);

header('location:../telas/fase.php');

?>