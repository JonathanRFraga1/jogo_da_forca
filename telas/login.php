<!DOCTYPE html>

<?php

session_start();

if(isset($_SESSION['id_usuario'])){
    header('location:../index.php');
}

?>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Login</title>
        <meta lang="pt-br">
        <link rel="stylesheet" href="../css/login.css" type="text/css">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="../js/login.js"></script>
        <link rel="shortcut icon" href="../img/login.png" />

    </head>

    <body>

        <div class="principal">

            <div class="ajuste">

                <div class="titulo">
                    <p>Login</p>
                </div>
                <div class="form">

                    <form method="post" action="../mediadores/cLogin.php">


                        <div class="group">      
                            <input type="text" id="login" name="login" autocomplete="off">
                            <span class="highlight"></span>
                            <span class="bar" id="llogin"></span>
                            <label>Nickname</label>
                        </div>

                        <div class="group">      
                            <input type="password" id="senha" name="senha">
                            <span class="highlight"></span>
                            <span class="bar" id="lsenha"></span>
                            <label>Senha</label>
                        </div>

                        <br>

                        <input type="submit" value="Login" id="enviar">
                        
                        <br>
                        <p id="resposta">
                        <?php

                        if(isset($_SESSION['resp'])){

                            echo $_SESSION['resp'].'<br>';
                            unset($_SESSION['resp']);
                        }

                        ?>
                        <br>
                        <a href="../telas/novoUsuario.php">Novo por aqui? Então crie uma conta!</a>
                        
                        
                    </form>

                </div>
            </div>
        </div>

    </body>

</html>