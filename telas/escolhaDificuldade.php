<!DOCTYPE html>

<?php

session_start();

//var_dump($_SESSION);

//if($_SESSION['gameOver'] == 1){
//    header('location:../telas/fase.php');
//}

require_once('../classes/Conexao.php');

?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Configuração de Nível</title>
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="../css/escolha.css" type="text/css">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="../js/dificuldade.js"></script>
        <link rel="shortcut icon" href="../img/hangman.png" />
    </head>
    <body>

        <div class="principal">
            <div class="titulo" id="">

                <p>Configuração de Nível</p>

            </div>

            <div class="ranking">

                <form method="post" action="../mediadores/proximaFase.php" id="formulario">

                    <div class="dificuldade">
                        <label for="dif">Selecione a dificuldade</label>

                        <div class="nivel">
                            <?php

                            $pontuacao = $_SESSION['pontuacao'];


                            if($pontuacao < 1300){
                                //header('location:../telas/fase.php');
                            }

                            if($_SESSION['nivel']>=2){
                                echo'<div>';
                                echo'<input type="radio" id="dif1" name="dificuldade" value="1" checked><label for="dif1">Nível 1</label>';
                                echo'</div>';
                                echo'<div>';
                                echo'<input type="radio" id="dif2" name="dificuldade" value="2"><label for="dif2">Nível 2</label>';
                                echo'</div>';
                            }

                            if($_SESSION['nivel']>=3){
                                echo'<div>';
                                echo'<input type="radio" id="dif3" name="dificuldade" value="3"><label for="dif3">Nível 3</label>';
                                echo'</div>';
                            }

                            if($_SESSION['nivel']>=4){
                                echo'<div>';
                                echo'<input type="radio" id="dif4" name="dificuldade" value="4"><label for="dif4">Nível 4</label>';
                                echo'</div>';
                            }

                            if($_SESSION['nivel']>=5){
                                echo'<div>';
                                echo'<input type="radio" id="dif5" name="dificuldade" value="5"><label for="dif5">Nível 5</label>';
                                echo'</div>';
                            }

                            if($_SESSION['nivel']>=6){
                                echo'<div>';
                                echo' <input type="radio" id="dif6" name="dificuldade" value="6"><label for="dif6">Nível 6</label>';
                                echo'</div>';
                                echo'<div>';
                                echo' <input type="radio" id="difn" name="dificuldade" value="7"><label for="difn">Misto</label>';
                                echo'</div>';
                            }


                            ?>
                        </div>

                    </div>

                    <div class="busca">
                        <input type="text" id="nome" autocomplete="off" autofocus placeholder="Digite a Linguagem">
                        <input type="button" value="Home" id="voltar">
                    </div>

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
                            xmlhttp.open("GET", "../mediadores/bLinguagem.php?q=" + str, true);
                            xmlhttp.send();
                        }

                        $(document).ready(function() { //quando terminar de carregar o documento:

                            $('#nome').keyup(function() { // keyup: cada vez que tecla ele chama o showcli
                                showcli($('#nome').val());
                            });
                            showcli('');
                        });
                        
                        $('#voltar').click(function(){
                            window.location.href = "../index.php";
                        })

                    </script>



                    <p id='txtcli'>Carregando dados...</p>


                    <div class="bt">
                        <input type="submit" name="enviar" value="Iniciar" id="cadastrar">
                    </div>


                </form>

            </div>
        </div>
    </body>
</html>
