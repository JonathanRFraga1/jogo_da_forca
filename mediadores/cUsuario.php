<?php

require_once('../classes/Usuario.php');
require_once('../classes/Conexao.php');

if(isset($_POST['login']) && isset($_POST['senha']) && isset($_POST['per'])){


    $user = new Usuario();
    $sql = new Conexao();

    $result = $user -> setDados($_POST['login'], $_POST['senha'], $_POST['per']);;

    session_start();

    if(isset($_SESSION['resp'])){
        unset ($_SESSION['resp']);
    }

    $_SESSION['resp'] = $result;

    if(isset($_SESSION['permissao']) && $_SESSION['permissao'] == 'adm'){

        if($result == 'Cadastro realizado com sucesso!'){

            header('location: ../telas/usuarios.php');

        }else{

            header('location: ../telas/novoUsuarioC.php');

        }

    }else{

        if($result == 'Cadastro realizado com sucesso!'){

          $sql -> selectWhere('jogador', 'id_jogador', 'jogador', $_POST['login']);

          foreach($sql -> resultado as $value){

            $_SESSION['id'] = intval($value['id_jogador']);

          }

          $_SESSION['permissao'] = 'com';
          $_SESSION['gameOver'] = intval(1);
          $_SESSION['pontuacao'] = intval(0);
          $_SESSION['nickname'] = $_POST['login'];
          $_SESSION['nivel'] = intval($nivel);

            header('location: ../index.php');

        }else{

            header('location: ../telas/novoUsuario.php');

        }

    }

}

?>
