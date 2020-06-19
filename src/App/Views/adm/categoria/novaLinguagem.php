<!DOCTYPE html>

<?php
session_start();
$_SESSION['gravar']='1';

if($_SESSION['permissao'] != 'adm'){
    header('location:../index.php');
}


?>

<html>

    <head>
        <meta charset="utf-8">
        <meta lang="pt-br">
        <title>Nova Linguagem</title>
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="../css/cruds.css" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Delius&display=swap" rel="stylesheet">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="../js/cadastroLinguagem.js"></script>
        <link rel="shortcut icon" href="../icons/language.png" />

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
                            <li id="nu"><a>Nova Linguagem</a></li>
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
                    Nova Linguagem
                </div>

                <div class="ajuste">
                    <div class="form">
                        <form method="post" action="../mediadores/cLinguagem.php">

                            <label for="ling">Linguagem</label>

                            <input type="text" id="ling" name="linguagem" placeholder="Digite o nome da linguagem" autocomplete="off" autofocus>


                            <label for="dica">Descrição:</label><br>
                            <textarea id="desc" name="descricao" placeholder="Digite a descrição da linguagem" autocomplete="off" rows="5" cols="33"></textarea>


                            <input type="submit" id="cadastrar" value="Cadastrar">

                            <div class="link">
                                <p id="resposta"></p>

                            </div>

                        </form>


                    </div>

                </div>
            </div>
        </div>


    </body>
</html>