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
        <title>Palavras</title>
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="../css/palavras.css" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Delius&display=swap" rel="stylesheet">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
        <link rel="shortcut icon" href="../icons/word.png" />

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
                    <li><a href="usuarios.php">Usuários</a>
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
                    <li><a>Palavras</a>
                        <ul>
                            <li id="nu"><a href='./novaPalavra.php'>Nova Palavra</a></li>
                        </ul>
                    </li>
                </ul>

            </nav>
            <div class="conteudo">
                <div class="texto">
                    Palavras
                </div>

                <div class="texto">
                    <input type="text" id="nome" autocomplete="off" autofocus placeholder="Digite a palavra">
                    <div class="radio" id="radio">
                        <br>
                        <p>Ordenar por:</p>
                        <input type="radio" id="r1" name="dificuldade" value="dificuldade" checked><label for="r1">Nivel de Dificuldade</label>&nbsp;&nbsp;
                        <input type="radio" id="r2" name="dificuldade" value="palavra"><label for="r2">Alfabeticamente</label>&nbsp;&nbsp;
                        <input type="radio" id="r3" name="dificuldade" value="numeroCaracteres"><label for="r3">Numero de Caracteres</label>&nbsp;&nbsp;
                        <input type="radio" id="r4" name="dificuldade" value="id_palavra"><label for="r4">Identificador</label><br>
                        <input type="radio" id="r5" name="ordem" value="asc" checked><label for="r5">Crescente</label>&nbsp;&nbsp;
                        <input type="radio" id="r6" name="ordem" value="desc"><label for="r6">Decrescente</label>&nbsp;&nbsp;
                    </div>
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
                        function showcli(nm, od, ln) {
                            str = nm;
                            str1 = od
                            str2 = ln
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
                            xmlhttp.open("GET", "../mediadores/buscaPalavra.php?q=" + str +"&&od=" + str1 + "&&ln=" + ln, true);
                            xmlhttp.send();
                            //xmlhttp.open("POST", "busca_cli.php", true);
                            //xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            //xmlhttp.send("q=" + str);
                        }

                        $(document).ready(function() { //quando terminar de carregar o documento:

                            var valor = '';
                            var ordem = '';
                            $('#nome').keyup(function() { // keyup: cada vez que tecla ele chama o showcli

                                if (document.getElementById('r1').checked) {
                                    valor = document.getElementById('r1').value;
                                }

                                if (document.getElementById('r2').checked) {
                                    valor = document.getElementById('r2').value;
                                }

                                if (document.getElementById('r3').checked) {
                                    valor = document.getElementById('r3').value;
                                }
                                
                                if (document.getElementById('r4').checked) {
                                    valor = document.getElementById('r4').value;
                                }
                                
                                if (document.getElementById('r5').checked) {
                                    ordem = document.getElementById('r5').value;
                                }
                                
                                if (document.getElementById('r6').checked) {
                                    ordem = document.getElementById('r6').value;
                                }

                                showcli($('#nome').val(),valor,ordem );
                            });

                            $('input:radio[name="dificuldade"]').change(
                                function(){
                                    valor =  $(this).is(':checked') && $(this).val() 
                                    showcli($('#nome').val(),valor,ordem );
                                    console.log(valor);
                                });
                            
                            $('input:radio[name="ordem"]').change(
                                function(){
                                    ordem =  $(this).is(':checked') && $(this).val() 
                                    showcli($('#nome').val(),valor,ordem );
                                    console.log(valor);
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