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
        <title>Usuários</title>
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="../css/cruds.css" type="text/css">
        <link rel="stylesheet" href="../css/palavras.css" type="text/css">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="../js/cadastroUsuario.js"></script>
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
                    <li><a href="./usuarios.php">Usuários</a>
                        <ul>
                            <li><a>Novo Usuário</a></li>
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
                    Novo Usuário
                </div>

                <div class="ajuste">
                    <div class="form">


                        <form method="post" action="../mediadores/cUsuario.php">

                            <div class="">
                                <label for="login">Nickname:</label><br>
                                <input type="text" id="login" name="login" placeholder="Digite o seu Nickname" maxlength="15" value="" autocomplete="off" autofocus>
                            </div>

                            <div class="">
                                <label for="senha">Senha:</label><br>
                                <input type="password" id="senha" name="senha" placeholder="Digite a sua Senha" maxlength="10">
                            </div>

                            <div class="">
                                <label for="confirma">Digite novamente a sua senha:</label><br>
                                <input type="password" id="confirma" name="confirma" placeholder="Digite Novamente a sua Senha" maxlength="10">
                            </div>

                            <div class="">

                                <div class="">

                                    <div class="">

                                        <div class="link">

                                            <label for="pa">Administrador:</label>&nbsp;&nbsp;
                                            <input type="radio" id="pa" name="per" value="adm">

                                        </div>

                                        <div class="link">

                                            <label for="pc">Usuário Comum:</label>&nbsp;&nbsp;
                                            <input type="radio" id="pc" name="per" value="com" checked>

                                        </div>


                                    </div>

                                </div>

                            </div>

                            <input type="submit" name="editar" value="Cadastrar" id="cadastrar">
                            <div class="">
                                <p id="resposta"></p>
                            </div>

                            <?php

                            if(isset($_SESSION['resp'])){

                                echo $_SESSION['resp'];
                                unset($_SESSION['resp']);
                            }

                            ?>

                        </form>



                    </div>

                </div>
            </div>
        </div>


    </body>
</html>