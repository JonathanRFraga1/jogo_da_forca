<!DOCTYPE html>

<?php

session_start();

if($_SESSION['permissao']!= 'adm'){
    header('location:../index.php');
}

if(isset($_GET['id'])){
    $id = $_GET['id'];

    require_once('../classes/Conexao.php');

    $sql = new Conexao();

    $result = $sql -> selectWhere('linguagem', 'linguagem, descricao', 'id_linguagem', $id);

    foreach($sql -> resultado as $value){

        $ling = $value['linguagem'];
        $desc = $value['descricao'];

        // echo "Nick: ".$nick,', Permissão: '.$permissao."<br>";
    }

}else{
    header('location:./linguagens.php');
}

?>

<html>

    <head>
        <meta charset="utf-8">
        <meta lang="pt-br">
        <title>Editar Linguagem</title>
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="../css/cruds.css" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Delius&display=swap" rel="stylesheet">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="../js/cadastroLinguagem.js"></script>
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
                    Editar Linguagem
                </div>

                <div class="ajuste">
                    <div class="form">
                        <?php


                        // seta os campos com os dados vindos do bd referente a linguagem escolhida pelo adm
                        echo'

            <form method="post" action="../mediadores/eLinguagem.php">


                            <label for="ling">Linguagem</label><br>

                            <input type="text" id="ling" name="linguagem" placeholder="Digite o nome da linguagem" autocomplete="off" value="'.$ling.'">




                            <label for="dica">Descrição</label><br>
                            <textarea id="desc" name="descricao" placeholder="Digite a descrição da linguagem" autocomplete="off" rows="5" cols="33">'.$desc.'</textarea>

                <input type="hidden" name="id" value="'.$id.'">

                <input type="submit" id="cadastrar" value="Editar">';

                        ?>

                    </div>
                </div>
            </div>
        </div>


    </body>
</html>