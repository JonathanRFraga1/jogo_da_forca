<?php

session_start();

var_dump($_POST);

require_once('../classes/Usuario.php');

if(($_POST['login'] != '')&&( $_POST['senha'] != '')){

    $user = new Usuario;

    $result = $user -> login($_POST['login'], $_POST['senha']);

    if(isset($_SESSION['resp'])){
        unset ($_SESSION['resp']);
    }

    $_SESSION['resp'] = $result;
    
    echo $result;

    if(strcmp($result, 'Senha válida!')==0){
        
        unset ($_SESSION['resp']);

        //var_dump($_SESSION);

        header('location: ../index.php');
        //header('location: ../telas/login.php');

    }else{ 

        //var_dump($_SESSION);

        header('location: ../telas/login.php');

    }

}else{
    
     $_SESSION['resp'] = 'Primeiro digite os dados!';
    
    header('location: ../telas/login.php');
    
}

?>