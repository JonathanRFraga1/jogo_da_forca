<!DOCTYPE html>

<?php

session_start();

if($_SESSION['permissao'] != 'adm'){ //apenas o adm deve possuir acesso
    header('location:../index.php');
}

require_once('../classes/Conexao.php');

$sql = new Conexao();

if(isset($_GET['id'])){

    $sql -> selectWhere('jogador', 'nickname', 'id_jogador', $_GET['id']);

    foreach($sql -> resultado as $value){
        $nick = $value['nickname'];
    }

}else{

    header('location:./usuarios.php');

}


?>

<html>

    <head>
        <meta charset="utf-8">
        <meta lang="pt-br">
        <title>Excluir Usuário</title>
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="../css/cruds.css" type="text/css">
        <link rel="stylesheet" href="../css/palavras.css" type="text/css">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
        <link rel="shortcut icon" href="../icons/user.png" />

    </head>

    <body>
        <div class="principal">
            <input type="checkbox" id="bt_menu">
            <label for='bt_menu'>&#9776;</label>

            <nav class="menu">
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><?php
                        if($_SESSION['gameOver'] == 1){
                            echo'<a href="./fase.php">Novo Jogo</a>';
                        }else{
                            echo'<a href="./escolhaDificuldade.php">Continuar</a>';
                        }
                        ?></li>
                    <li><a>Usuários</a>
                        <ul>
                            <li><a href="./novoUsuarioC.php">Novo Usuário</a></li>
                            <li><a href="../relatorios/usuarios.php">Relatório Usuários</a></li>
                        </ul>
                    </li>
                    <li><a href="./linguagens.php">Linguagens</a>
                        <ul>
                            <li id="nu"><a href='./novaLinguagem.php'>Nova Linguagem</a></li>
                            <li><a href="./relatorioLing.php">Relatórios Linguagens</a></li>
                        </ul>
                    </li>
                    <li><a href="./palavras.php">Palavras</a>
                        <ul>
                            <li id="nu"><a href='./novaPalavra.php'>Nova Palavra</a></li>
                        </ul>
                    </li>
                </ul>

            </nav>

            <div class="conteudo">
                <div class="texto">
                    Excluir Usuário
                </div>

                <div class="ajuste">
                    <div class="form">
                        <?php

                        echo "Deseja realmete excluir o usuário ".$nick."?<br><br>";

                        echo'<form action="" method="post">';

                        echo "<input type='submit' value='Excluir' name='excluir'> &nbsp;&nbsp;";
                        echo "<input type='submit' value='Cancelar' name='cancelar'> &nbsp;&nbsp;";
                        echo '<br><br> ';

                        echo '</form>';

                        if(isset($_POST['excluir'])){

                            $result = $sql -> delete('jogador', 'id_jogador', $_GET['id']);

                            $_SESSION['resp'] = $result;

                            header('location:./usuarios.php');

                        }

                        if(isset($_POST['cancelar'])){

                            header('location:./usuarios.php');
                        }

                        ?>
                    </div>

                </div>
            </div>
        </div>


    </body>
</html>