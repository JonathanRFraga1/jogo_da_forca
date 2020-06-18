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
        <title>Linguagens</title>
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="../css/cruds.css" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Delius&display=swap" rel="stylesheet">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
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
                    <li><a>Linguagens</a>
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
                    Linguagens
                </div>

                <div class="texto">
                    <input type="text" id="nome" autocomplete="off" autofocus placeholder="Busque pela linguagem">
                </div>

                <div class="texto">
                <?php

                if(isset($_SESSION['resp'])){ 
                    echo "<br>". $_SESSION['resp'];
                    unset($_SESSION['resp']);
                }

                ?>
                </div>
               
                <div class="conteudo">
                    <script>
                        function showcli(nm) {
                            str = nm;
                            if (window.XMLHttpRequest) {
                                // code for IE7+, Firefox, Chrome, Opera, Safari
                                xmlhttp = new XMLHttpRequest();
                            } else {
                                // code for IE6, IE5
                                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                            }
                            xmlhttp.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    $('#txtcli').html(this.response);
                                }
                            };
                            xmlhttp.open("GET", "../mediadores/buscaLinguagem.php?q=" + str, true);
                            xmlhttp.send();
                            //xmlhttp.open("POST", "busca_cli.php", true);
                            //xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            //xmlhttp.send("q=" + str);
                        }

                        $(document).ready(function() { //quando terminar de carregar o documento:

                            $('#nome').keyup(function() { // keyup: cada vez que tecla ele chama o showcli
                                showcli($('#nome').val());
                            });
                            showcli('');
                        });

                    </script>


                    <p id='txtcli'>Carregando dados dos usuários...</p>
                </div>
            </div>

        </div>


    </body>
</html>