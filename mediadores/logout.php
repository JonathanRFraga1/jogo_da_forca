<?php

session_start();
unset($_SESSION['id_usuario']);
unset($_SESSION['pontuacao']);
unset($_SESSION['gameOver']);
unset($_SESSION['permissao']);
unset($_SESSION['nickname']);
unset($_SESSION['dificuldade']);
unset($_SESSION['linguagem']);
session_destroy();

header('location:../index.php');
