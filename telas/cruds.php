<!DOCTYPE html>

<?php

session_start();

if($_SESSION['permissao'] != 'adm'){ //apenas o adm deve possuir acesso
    header('location:../index.php');
}


?>

<html>

    <head>
        <meta charset="utf-8">
        <meta lang="pt-br">
        <title>Base de Dados</title>
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="../css/cruds.css" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Delius&display=swap" rel="stylesheet">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
        <link rel="shortcut icon" href="../img/database.png" />

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
                    <li><a href="./usuarios.php">Usuários</a>
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
                    <p>Bem Vindo a Base de Dados</p>
                    <p>Selecione uma das opções abaixo:</p>
                </div>
                <div class="op">
                    <div class="links">
                        <a href="./usuarios.php"><img src="../icons/user.png">Usuários</a>
                    </div>
                    <div class="links">
                        <a href="./linguagens.php"><img src="../icons/language.png">linguagens</a>
                    </div>
                    <div class="links">
                        <a href="./palavras.php"><img src="../icons/word.png">Palavras</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>