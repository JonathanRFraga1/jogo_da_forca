<!DOCTYPE html>

<?php

session_start();

require_once('../classes/Fase.php');
require_once('../classes/Conexao.php');

if(!isset($_SESSION['permissao'])){
    header('location:../index.php');
}

if($_SESSION['pontuacao']<1300){
    $nivel = 1;
}


$fase = new Fase();

//var_dump($_SESSION);

?>


<html>

    <head>

        <meta charset="utf-8">
        <meta lang="pt-br">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <title>Jogo da Forca</title>
        <link rel="stylesheet" href="../css/fase.css" type="text/css">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
        <link rel="shortcut icon" href="../img/forca.png" />
    </head>

    <?php

    //var_dump($_SESSION);

    if($_SESSION['gameOver'] == 1 || $_SESSION['nivel'] == 1){

        $fase -> nivel1();

        $array_palavras = $fase -> array_palavras;

        $array_dica = $fase -> array_dica;

        $array_numChar = $fase -> array_numChar;

        $array_id = $fase -> array_id;

        $nivel = 1;
    }else{

        if((isset($_SESSION['dificuldade'])) && (!isset($_SESSION['linguagem']))){

            if($_SESSION['dificuldade'] != 0){

                $dif = intval($_SESSION['dificuldade']);

                $nivel = $dif;

                //echo $nivel;

                $result = $fase -> nivelDificuldade($dif);

                $array_palavras = $fase -> array_palavras;

                $array_dica = $fase -> array_dica;

                $array_numChar = $fase -> array_numChar;

                $array_id = $fase -> array_id;

                //echo $result;

                unset($_SESSION['dificuldade']);

            }else{

                $result = $fase -> nivelMisto();

                $array_palavras = $fase -> array_palavras;

                $array_dica = $fase -> array_dica;

                $array_numChar = $fase -> array_numChar;

                $array_id = $fase -> array_id;

                $nivel = 6;

                //echo $result;

                unset($_SESSION['dificuldade']);
            }

        }else{

            if(!isset($_SESSION['dificuldade']) && isset($_SESSION['linguagem'])){

                if(intval($_SESSION['linguagem']) != 0){

                    $nivel = 6;

                    $result = $fase -> nivelLinguagem($_SESSION['linguagem']);

                    $array_palavras = $fase -> array_palavras;

                    $array_dica = $fase -> array_dica;

                    $array_numChar = $fase -> array_numChar;

                    $array_id = $fase -> array_id;

                    //echo $result;

                    unset($_SESSION['linguagem']);
                }else{

                    $result = $fase -> nivelMisto();

                    $array_palavras = $fase -> array_palavras;

                    $array_dica = $fase -> array_dica;

                    $array_numChar = $fase -> array_numChar;

                    $array_id = $fase -> array_id;

                    $nivel = 6;

                    //echo $result;

                    unset($_SESSION['linguagem']);

                }

            }else{
                if(isset($_SESSION['dificuldade'], $_SESSION['linguagem'])){

                    if($_SESSION['dificuldade'] != 7 && $_SESSION['linguagem'] != 0){

                        $result = $fase -> nivelEscolha($_SESSION['dificuldade'], $_SESSION['linguagem']);

                        $nivel = $_SESSION['dificuldade'];

                        $array_palavras = $fase -> array_palavras;

                        $array_dica = $fase -> array_dica;

                        $array_numChar = $fase -> array_numChar;

                        $array_id = $fase -> array_id;

                        //echo $result;

                        unset($_SESSION['linguagem'], $_SESSION['linguagem']);
                    }else{
                        if($_SESSION['dificuldade'] != 7 && $_SESSION['linguagem'] == 0){

                            $dif = intval($_SESSION['dificuldade']);

                            $nivel = $dif;

                            //echo $nivel;

                            $result = $fase -> nivelDificuldade($dif);

                            $array_palavras = $fase -> array_palavras;

                            $array_dica = $fase -> array_dica;

                            $array_numChar = $fase -> array_numChar;

                            $array_id = $fase -> array_id;

                            //echo $result;

                            unset($_SESSION['linguagem'], $_SESSION['linguagem']);

                        }else{

                            if($_SESSION['dificuldade'] == 7 && $_SESSION['linguagem'] != 0){

                                $nivel = 7;

                                $result = $fase -> nivelLinguagem($_SESSION['linguagem']);

                                $array_palavras = $fase -> array_palavras;

                                $array_dica = $fase -> array_dica;

                                $array_numChar = $fase -> array_numChar;

                                $array_id = $fase -> array_id;

                            }else{

                                $result = $fase -> nivelMisto();

                                $array_palavras = $fase -> array_palavras;

                                $array_dica = $fase -> array_dica;

                                $array_numChar = $fase -> array_numChar;

                                $array_id = $fase -> array_id;

                                $nivel = 7;


                            }

                        }
                    }

                }else{

                    $result = $fase -> nivelMisto();

                    $array_palavras = $fase -> array_palavras;

                    $array_dica = $fase -> array_dica;

                    $array_numChar = $fase -> array_numChar;

                    $array_id = $fase -> array_id;

                    $nivel = 7;

                }
            }

        }

    }

    ?>

    <script>

        var i, array_palavras, string_array, array_dica, array_numChar;

        var x = 1;

        if(x == 1){

            var pont = <?php echo $_SESSION['pontuacao']; ?>

                string_array = '<?php echo $array_palavras; ?>';
            array_palavras = string_array.split("|");

            string_array = '<?php echo $array_dica; ?>';
            array_dica = string_array.split("|");

            string_array = '<?php echo $array_numChar; ?>';
            array_numChar = string_array.split("|");

            string_array = '<?php echo $array_id; ?>';
            array_id = string_array.split("|");

            var nivel = <?php echo $nivel; ?>;

            var gameOver = <?php echo $_SESSION['gameOver']; ?>

                x++;

        }



    </script>

    <script src="../js/fase.js"></script>

    <body>
        <div class="principal" id="principal">

            <div class="barraSup">
                <div class="nick">
                    <img src="../icons/user2.png">
                    <span>&nbsp;&nbsp;
                        <?php
                        echo $_SESSION['nickname'];
                        ?>
                    </span>
                </div>
                <div class="link">
                    <a href="../index.php">Jogo da Forca</a>
                </div>
            </div>

            <div class="centro">

                <div class="boneco">
                    <div class="erros"><p>Erros:&nbsp;</p> <p id='erro'></p></div>

                    <img src="../img/erro0.png" class="displayed" id="boenco">
                </div>

                <div class="palavra">
                    <div class="dica">
                        <p id="dica"></p>
                    </div>



                    <div class="pal">
                        <div id="letter" class="letras">

                        </div>
                    </div>


                    <div class="chute">
                        <div class="chuteLetra">
                            <input type="text" id="letra" maxlength="1" placeholder="Digite uma letra" autocomplete="off" autofocus>
                            <input type="button" value="Chutar!" id="letraC">
                        </div>
                        <div class="chutePalavra">
                            <input type="text" id="palavra" placeholder="Digite a palavra" autocomplete="off">
                            <input type="button" value="Chutar!" id="palavraC">
                        </div>
                        <div class="chutePalavra">
                            <input type="button" value="Ajuda" id="btajuda">
                        </div>
                    </div>

                </div>

            </div>

            <div class="rodape">
                <div class="pont">
                    <p>Pontuação:&nbsp;
                    </p>
                    <p id="pont">
                        <?php
                        echo trim ($_SESSION['pontuacao']);
                        ?>
                    </p>
                </div>
                <div class="nivel">
                    <?php
                    echo 'Nível: '.$nivel;
                    ?>
                </div>
            </div>

        </div>

        <div id="modal" class="modal-container">
            <div id="popUp" class="modal">
                <p id="msg"></p>
                <input type="button" id="btmodal">
            </div>
        </div>

        <div id="modalAjuda" class="modal-container">
            <div id="popUp" class="modalAjuda">
                <p align="left" style="font-size:1.3em; font-weight: bold;padding-left:2%;">Ajuda</p>
                <div class="conteudoModal">
                    <p align="center">
                        Nessa tela você encontrará os seguintes elementos:
                    </p><br>
                    <p>Na parte superior é onde se encontra as suas informações como usuário.</p>
                    <p>Logo abaixo, à direita, encontra-se as letras que você errou.</p>
                    <p>À esquerda encontra-se a dica da palavra.</p>
                    <p>Abaixo dessa sessão, enconta-se o espaço com a "forca" e a palavra da atual rodada.</p>
                    <p>A seguir encontra-se os espaços destinados aos "chutes", tanto de letras, quanto de palavras.</p>
                    <p>Por fim, encontra-se a sua pontuação e o atual nível de dificuldade.</p>
                </div>
                <div class="fechar">
                    <input type="button" id="btmodalAjuda" value="Fechar">
                </div>

            </div>
        </div>

        <div class="teclado">
            <div class="teclas">
                <div class="linha">
                    <input type="button" class="button" id="q" value="Q">
                    <input type="button" class="button" id="w" value="W">
                    <input type="button" class="button" id="e" value="E">
                    <input type="button" class="button" id="r" value="R">
                    <input type="button" class="button" id="t" value="T">
                    <input type="button" class="button" id="y" value="Y">
                    <input type="button" class="button" id="u" value="U">
                    <input type="button" class="button" id="i" value="I">
                    <input type="button" class="button" id="o" value="O">
                    <input type="button" class="button" id="p" value="P">
                </div>
                <div class="linha">
                    <input type="button" class="button" id="a" value="A">
                    <input type="button" class="button" id="s" value="S">
                    <input type="button" class="button" id="d" value="D">
                    <input type="button" class="button" id="f" value="F">
                    <input type="button" class="button" id="g" value="G">
                    <input type="button" class="button" id="h" value="H">
                    <input type="button" class="button" id="j" value="J">
                    <input type="button" class="button" id="k" value="K">
                    <input type="button" class="button" id="l" value="L">
                </div>
                <div class="linha">
                    <input type="button" class="button" id="z" value="Z">
                    <input type="button" class="button" id="x" value="X">
                    <input type="button" class="button" id="c" value="C">
                    <input type="button" class="button" id="v" value="V">
                    <input type="button" class="button" id="b" value="B">
                    <input type="button" class="button" id="n" value="N">
                    <input type="button" class="button" id="m" value="M">
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function(){

                switch (nivel) {
                    case 1:
                        $('#principal').addClass('nivel1');
                        $('#letra').addClass('n1');
                        $('#palavra').addClass('n1');
                        $('#letraC').addClass('nn1');
                        $('#palavraC').addClass('nn1');
                        $('#btajuda').addClass('nn1');
                        $('#btmodalAjuda').addClass('nn1');
                        $('#btmodal').addClass('nn1');
                        $('.button').addClass('nn1');
                        break;
                    case 2:
                        $('#principal').addClass('nivel2');
                        $('#letra').addClass('n2');
                        $('#palavra').addClass('n2');
                        $('#letraC').addClass('nn2');
                        $('#palavraC').addClass('nn2');
                        $('#btajuda').addClass('nn2');
                        $('#btmodalAjuda').addClass('nn2');
                        $('#btmodal').addClass('nn2');
                        $('.button').addClass('nn2');
                        break;
                    case 3:
                        $('#principal').addClass('nivel3');
                        $('#letra').addClass('n3');
                        $('#palavra').addClass('n3');
                        $('#letraC').addClass('nn3');
                        $('#palavraC').addClass('nn3');
                        $('#btajuda').addClass('nn3');
                        $('#btmodalAjuda').addClass('nn3');
                        $('#btmodal').addClass('nn3');
                        $('.button').addClass('nn3');
                        break;
                    case 4:
                        $('#principal').addClass('nivel4');
                        $('#letra').addClass('n4');
                        $('#palavra').addClass('n4');
                        $('#letraC').addClass('nn4');
                        $('#palavraC').addClass('nn4');
                        $('#btajuda').addClass('nn4');
                        $('#btmodalAjuda').addClass('nn4');
                        $('#btmodal').addClass('nn4');
                        $('.button').addClass('nn4');
                        break;
                    case 5:
                        $('#principal').addClass('nivel5');
                        $('#letra').addClass('n5');
                        $('#palavra').addClass('n5');
                        $('#letraC').addClass('nn5');
                        $('#palavraC').addClass('nn5');
                        $('#btajuda').addClass('nn5');
                        $('#btmodalAjuda').addClass('nn5');
                        $('#btmodal').addClass('nn5');
                        $('.button').addClass('nn5');
                        break;
                    case 6:
                        $('#principal').addClass('nivel6');
                        $('#letra').addClass('n6');
                        $('#palavra').addClass('n6');
                        $('#letraC').addClass('nn6');
                        $('#palavraC').addClass('nn6');
                        $('#btajuda').addClass('nn6');
                        $('#btmodalAjuda').addClass('nn6');
                        $('#btmodal').addClass('nn6');
                        $('.button').addClass('nn6');
                        break;
                    case 7:
                        $('#principal').addClass('nivel7');
                        $('#letra').addClass('n7');
                        $('#palavra').addClass('n7');
                        $('#letraC').addClass('nn7');
                        $('#palavraC').addClass('nn7');
                        $('#btajuda').addClass('nn7');
                        $('#btmodalAjuda').addClass('nn7');
                        $('#btmodal').addClass('nn7');
                        $('.button').addClass('nn7');
                        break;
                } 
            });

            $("#btajuda").click(function(){
                $("#modalAjuda").addClass("mostrar");
            });

            $('#btmodalAjuda').click(function() {
                $("#modalAjuda").removeClass("mostrar");
            });

            $('#q').click(function(){
                teclado($('#q').val());
            });

            $('#w').click(function(){
                teclado($('#w').val());
            })

            $('#e').click(function(){
                teclado($('#e').val());
            })

            $('#r').click(function(){
                teclado($('#r').val());
            })

            $('#t').click(function(){
                teclado($('#t').val());
            })

            $('#y').click(function(){
                teclado($('#y').val());
            })

            $('#u').click(function(){
                teclado($('#u').val());
            })

            $('#i').click(function(){
                teclado($('#i').val());
            })

            $('#o').click(function(){
                teclado($('#o').val());
            })

            $('#p').click(function(){
                teclado($('#p').val());
            })

            $('#a').click(function(){
                teclado($('#a').val());
            })

            $('#s').click(function(){
                teclado($('#s').val());
            })

            $('#d').click(function(){
                teclado($('#d').val());
            })

            $('#f').click(function(){
                teclado($('#f').val());
            })

            $('#g').click(function(){
                teclado($('#g').val());
            })

            $('#h').click(function(){
                teclado($('#h').val());
            })

            $('#j').click(function(){
                teclado($('#j').val());
            })

            $('#k').click(function(){
                teclado($('#k').val());
            })

            $('#l').click(function(){
                teclado($('#l').val());
            })

            $('#z').click(function(){
                teclado($('#z').val());
            })

            $('#x').click(function(){
                teclado($('#x').val());
            })

            $('#c').click(function(){
                teclado($('#c').val());
            })

            $('#v').click(function(){
                teclado($('#v').val());
            })

            $('#b').click(function(){
                teclado($('#b').val());
            })

            $('#n').click(function(){
                teclado($('#n').val());
            })

            $('#m').click(function(){
                teclado($('#m').val());
            })

        </script>

    </body>
</html>
