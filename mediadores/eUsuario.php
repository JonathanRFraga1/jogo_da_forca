<?php

require_once('../classes/Usuario.php');
require_once('../classes/Conexao.php');

//var_dump($_SESSION);

if(isset($_POST['login']) && isset($_POST['senha']) && isset($_POST['per'])){


    $user = new Usuario();

    $user -> setSenha($_POST['senha']);
    
    $sql = new Conexao();
    
    $stringUpdate = "nickname ='".$_POST['login']."', pass='".$user -> getSenha()."', permissao = '".$_POST['per']."'";
    
    echo $stringUpdate.'<br>';
    
    
    $result = $sql -> update('jogador', $stringUpdate, 'id_jogador', $_POST['id']);
    
    echo $result;
    
    
     session_start();

    if(isset($_SESSION['resp'])){
        unset ($_SESSION['resp']);
    }

    $_SESSION['resp'] = $result;

    header('location: ../telas/usuarios.php');


}

?>