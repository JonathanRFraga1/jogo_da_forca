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
        <title>Relatórios - Linguagem</title>
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="../css/cruds.css" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Delius&display=swap" rel="stylesheet">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="../js/modal.js"></script>
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
                            <li><a>Relatórios Linguagens</a></li>
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
                    Relatórios Linguagem
                </div>

                <div class="ajuste">
                    <div class="form">
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2" align="center">Selecione o Tipo de Relatório</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Relatório Geral</td>
                                    <td>
                                        <input type="button" id="relatorio" value="Gerar Relatório" onclick="window.location.href = '../relatorios/linguagensGeral.php'; ">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Relatórios Específicos</td>
                                    <td>
                                        <input type="button" id="relatorioEsp" value="Exibir Mais">
                                    </td>
                            </tbody>
                        </table>


                    </div>

                </div>
            </div>
        </div>

        <div id="modal" class="modal-container">
            <div id="popUp" class="modal">
                <p align="left" style="font-size:1.2em; font-weight: bold;">
                    Linguagens
                </p>
                <div class="conteudoModal"> 
                    <p id='txtcli'>Carregando dados...</p>
                </div>
                <div class="fechar">
                    <input type="button" id="btmodal" value="Fechar">
                </div>

            </div>
        </div>


    </body>
</html>