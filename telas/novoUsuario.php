<!DOCTYPE html>

<?php

session_start();



if(isset($_SESSION['nickname']) && isset($_SESSION['permissao'])){
    if(isset($_SESSION['permissao'])){
        header('location:../index.php');
    }
}else{

    //valores default
    $op =2;
    $per = 'com';
}



?>

<html>

    <head>

        <meta charset="utf-8">
        <title>Novo Jogador</title>
        <link rel="stylesheet" href="../css/cUsuario.css" type="text/css">
        <meta name="viewport" content="width=device-width">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="../js/cadastroUsuario.js"></script>
        <link rel="shortcut icon" href="../img/add-group.png" />

    </head>

    <body>

        <div class="principal">

            <div class="ajuste">

                <div class="titulo">
                    <p>Novo Player</p>
                </div>
                <div class="form">

                    <form method="post" action="../mediadores/cUsuario.php">


                        <div class="group">      
                            <input type="text" id="login" name="login" autocomplete="off">
                            <span class="highlight"></span>
                            <span class="bar" id="llogin"></span>
                            <label>Nickname</label>
                        </div>

                        <div class="group">      
                            <input type="password" id="senha" name="senha" maxlength="10">
                            <span class="highlight"></span>
                            <span class="bar" id="lsenha"></span>
                            <label>Senha</label>
                        </div>


                        <div class="group">      
                            <input type="password" id="confirma" name="confirma" maxlength="10">
                            <span class="highlight"></span>
                            <span class="bar" id="lsenha"></span>
                            <label>Confirmar Senha</label>
                        </div>

                        <?php

                        echo '<input type="hidden" name="per" value="'.$per.'">';

                        ?>

                        <input type="submit" value="Cadastrar" id="cadastrar">

                        <br>
                        <p id="resposta">

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

    </body>

</html>