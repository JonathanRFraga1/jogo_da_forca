<!DOCTYPE html>

<?php

session_start();

if(isset($_SESSION['nickname'])){ //verifica se já foi efetuado o login

    $usuario = $_SESSION['nickname'];
    $per = $_SESSION['permissao'];
    $set = 1;
    $pont = $_SESSION['pontuacao'];

    if($per == "com"){
        $per = "Jogador";
    }else{
        $per = "Adminstrador";
    }
}else{
    $set = 2;
}

?>


<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <meta lang="pt-br">
        <title>Jogo da Forca</title>
        <link rel="stylesheet" href="./css/index.css" type="text/css">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
        <link rel="shortcut icon" href="./img/forca.png" />

    </head>

    <body>

        <div class="principal">

            <div class="esquerda">

                <p>Jogo da Forca</p>

            </div>

            <div class="direita">

                <div class="ajuste">

                    <div class="user">
                        <?php
                        if($set == 1){
                            echo $usuario."&nbsp;&nbsp;";
                            echo'<img src="./icons/user1.png">&nbsp;&nbsp;';
                        }
                        ?>
                    </div>

                    <div class="menuPrincipal">

                        <?php

                        if($set == 2){

                            echo '<div class="menu">
                        <img src="./icons/user.png">&nbsp;&nbsp;
                        <a href="./telas/login.php">Entrar</a><br>
                        </div>';

                            echo '<div class="menu">
                        <img src="./icons/add">&nbsp;&nbsp;
                        <a href="./telas/novoUsuario.php">Novo Player</a><br>
                        </div>';

                        }else{

                            if($_SESSION['gameOver'] == 1 || $_SESSION['nivel'] == 1){ // caso seja um novo usuário ou tenha gameOver == true

                                echo '<div class="menu">
                             <img src="./icons/game.png">&nbsp;&nbsp;
                             <a href="./telas/fase.php">Novo Jogo</a><br>
                            </div>';

                            }
                            if($_SESSION['gameOver'] != 1 && $_SESSION['nivel'] > 1){ // caso gameOver == false -> para continuar uma partida anterior

                                echo '<div class="menu">
                                <img src="./icons/continue.png">&nbsp;&nbsp;
                        <a href="./telas/escolhaDificuldade.php">Continuar</a><br>
                        </div>';

                            }



                            if($per == 'Adminstrador'){ // funções de crud
                                echo '<div class="menu">
                                <img src="./icons/data.png">&nbsp;&nbsp;
                            <a href="./telas/cruds.php">Cadastros</a><br>
                            </div>';
                            }

                            echo '<div class="menu">
                            <img src="./icons/exit.png">&nbsp;&nbsp;
                        <a href="./mediadores/logout.php">Sair</a><br>
                        </div>';

                        }

                        ?>

                        <div class="menu">
                            <img src="./icons/list.png">&nbsp;&nbsp;
                            <a href="./telas/ranking.php">Ranking</a><br>
                        </div>

                    </div>

                    <div class="rodape">

                        <div class="copy">
                            <p>&copy; Jonathan Rossetto de Fraga</p>
                        </div>
                        <div class="ajuda">
                            <input type="checkbox" id="btajuda"/>
                            <label for="btajuda" id="iconAjuda"><img src="icons/help.png"></label>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div id="modal" class="modal-container">
            <div id="popUp" class="modal">
                <p id="titulo" style="">
                    Ajuda
                </p>
                <div class="conteudoModal">
                    <p>
                        1º - Cadastre-se ou faça o login para poder acessar o sistema!
                    </p>
                    <p>
                        2º - Após fazer o login, você poderá inicar um novo jogo, ou
                        continuar um jogo anterior, caso você não tenha perdido uma partida anterior.
                    </p>
                    <p>
                        3º - Para efetuar o logout, volte a tela inicial e clique em sair.
                    </p>
                </div>
                <div class="fechar">
                    <input type="button" id="btmodal" value="Fechar">
                </div>

            </div>
        </div>



        <script>
            $("#btajuda").click(function() {
                $("#modal").addClass("mostrar");
            })

            $('#btmodal').click(function() {
                $("#modal").removeClass("mostrar");
                $("#btajuda").prop('checked', false); 
            });

        </script>


    </body>

</html>