<?php

session_start();

require_once('../classes/Conexao.php');

if(isset($_POST['linguagem']) && isset($_POST['descricao'])){


    $sql = new Conexao();

    $return = $sql -> selectWhere('linguagem', 'linguagem, descricao', 'id_palavra', $_POST['id']);

    foreach($sql -> resultado as $value){

        $linguagem = $value['linguagem'];
        $descricao = $value['descricao'];

    }

    if($linguagem == $_POST['linguagem'] && $descricao != $_POST['descricao']){

        $stringUpdate = "linguagem ='".$_POST['linguagem']."'";

        $result = $sql -> update('linguagem', $stringUpdate, 'id_linguagem', $_POST['id']);

    }else{

        if($linguagem == $_POST['linguagem'] && $descricao != $_POST['descricao']){

            $stringUpdate = "descricao = '".$_POST['descricao']."'";

            $result = $sql -> update('linguagem', $stringUpdate, 'id_linguagem', $_POST['id']);

        }else{

            $stringUpdate = "linguagem ='".$_POST['linguagem']."', descricao = '".$_POST['descricao']."'";

            $result = $sql -> update('linguagem', $stringUpdate, 'id_linguagem', $_POST['id']);

        }

    }
    
    if(isset($_SESSION['resp'])){
        unset ($_SESSION['resp']);
    }

    $_SESSION['resp'] = $result;

    header('location: ../telas/linguagens.php');


}

?>