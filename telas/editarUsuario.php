<!DOCTYPE html>

<?php

session_start();

if(isset($_GET['id'])){
    $id = $_GET['id'];

    require_once('../classes/Conexao.php');

    $sql = new Conexao();

    $result = $sql -> selectWhere('jogador', 'nickname, permissao', 'id_jogador', $id);

    foreach($sql -> resultado as $value){

        $nick = $value['nickname'];
        $permissao = $value['permissao'];

        // echo "Nick: ".$nick,', Permissão: '.$permissao."<br>";
    }

    if(strcmp($permissao, 'adm')==0){
        $adm = 'checked';
        $com = 'false';
    }else{
        $adm = 'false';
        $com = 'checked';
    }

}else{
    header('location:./usuarios.php');
}

?>

<html>

    <head>
        <meta charset="utf-8">
        <meta lang="pt-br">
        <title>Editar Usuário</title>
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="../css/cruds.css" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Delius&display=swap" rel="stylesheet">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="../js/atUsuario.js"></script>
        <link rel="shortcut icon" href="../img/team.png" />

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
                   Editar Usuário
                </div>

               <div class="ajuste">
                <div class="form">
                    <?php

                    if(isset($_GET['id'])){

                        echo'

            <form method="post" action="../mediadores/eUsuario.php">

                <div class="">
                    <label for="login">Nickname:</label><br>
                    <input type="text" id="login" name="login" placeholder="Digite o seu Nickname" maxlength="15" value="'.$nick.'" autocomplete="off" autofocus>
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
                                            <input type="radio" id="pa" name="per" value="adm"  '.$adm.'>

                                        </div>

                                        <div class="link">

                                            <label for="pc">Usuário Comum:</label>&nbsp;&nbsp;
                                            <input type="radio" id="pc" name="per" value="com" '.$com.'>

                                        </div>


                                    </div>

                                </div>

                            </div>


                <input type="hidden" name="id" value="'.$id.'">

                <input type="submit" name="editar" value="Editar" id="editar">
                <div class="">
                    <p id="resposta"></p>
                </div>

            </form>';

                    ?>


                    <?php

                        if(isset($_SESSION['resp'])){ 
                            echo $_SESSION['resp'];
                            unset($_SESSION['resp']);
                        }

                    } 

                    ?>


                </div>

            </div>
        </div>
        </div>


    </body>
</html>