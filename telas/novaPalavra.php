<!DOCTYPE html>

<?php

session_start();

if($_SESSION['permissao'] != 'adm'){ //apenas o adm deve possuir acesso
    header('location:../index.php');
}


$_SESSION['gravar']='1';
include '../mediadores/cPalavra.php';
require_once('../classes/Conexao.php');

?>

<html>

    <head>
        <meta charset="utf-8">
        <meta lang="pt-br">
        <title>Nova Palavra</title>
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="../css/palavras.css" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Delius&display=swap" rel="stylesheet">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
        <link rel="shortcut icon" href="../icons/word.png" />
        <script src="../js/cadastroPalavra.js"></script>

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
                    <li><a href="./usuariosC.php">Usuários</a>
                        <ul>
                            <li><a href="./novoUsuario.php">Novo Usuário</a></li>
                            <li><a href="../relatorios/usuarios.php">Relatório Usuários</a></li>
                        </ul>
                    </li>
                    <li><a href="./linguagens.php">Linguagens</a>
                        <ul>
                            <li id="nu"><a href='./novaLinguagem.php'>Nova Linguagem</a></li>
                            <li><a href="./relatorioLing.php">Relatórios Linguagens</a></li>
                        </ul>
                    </li>
                    <li><a href="palavras.php">Palavras</a>
                        <ul>
                            <li id="nu"><a>Nova Palavra</a></li>
                        </ul>
                    </li>
                </ul>

            </nav>
            <div class="conteudo">
                <div class="texto">
                    Nova Palavra
                </div>

                <div class="ajuste">
                    <div class="form">
                        <form method="post" action="../mediadores/cPalavra.php">

                            <label for="pal">Palavra:</label><br>
                            <input type="text" id="pal" name="palavra" placeholder="Digite a palavra" autocomplete="off" autofocus>

                            <label for="dica">Dica:</label><br>
                            <textarea id="dica" name="dica" rows="5" cols="33" placeholder="Digite a dica da palavra" autocomplete="off"></textarea>
                            <br>

                            <p id="resposta">

                                <?php

                                if(isset($_SESSION['resp'])){ 
                                    echo "<br>". $_SESSION['resp'];
                                    unset($_SESSION['resp']);
                                }

                                ?>

                            </p>

                            <br>

                            <div class="dificuldade">
                                <label for="dif"><strong>Selecione a Dificuldade</strong></label>
                                <br>
                                <br>
                                <div class="linha">
                                    <input type="radio" id="dif1" name="dificuldade" value="1" checked><label for="dif1">Nível 1</label>&nbsp;&nbsp;
                                    <input type="radio" id="dif2" name="dificuldade" value="2"><label for="dif2">Nível 2</label>&nbsp;&nbsp;
                                    <input type="radio" id="dif3" name="dificuldade" value="3"><label for="dif3">Nível 3</label>&nbsp;&nbsp;

                                    <input type="radio" id="dif4" name="dificuldade" value="4"><label for="dif4">Nível 4</label>&nbsp;&nbsp;
                                    <input type="radio" id="dif5" name="dificuldade" value="5"><label for="dif5">Nível 5</label>&nbsp;&nbsp;
                                    <input type="radio" id="dif6" name="dificuldade" value="6"><label for="dif6">Nível 6</label>&nbsp;&nbsp;
                                </div>
                            </div>

                            <br>
                            <br>

                            <div class="links">


                                <table><tr><td><strong>Linguagem</strong></td><td><strong>Descrição</strong></td></tr>

                                    <?php

                                    $sql = new Conexao();

                                    $result = $sql -> selectSimples('linguagem', 'linguagem, id_linguagem, descricao');

                                    $x =1;

                                    echo'';

                                    foreach($sql -> resultado as $value){
                                        $ling = $value['linguagem'];
                                        $id = $value['id_linguagem'];
                                        $desc = $value['descricao'];

                                        echo '<tr><td><input type="checkbox" value="'.$ling.'" name="linguagem'.$x.'" id="'.$ling.'"> <label for="'.$ling.'">'.$ling.'</label>&nbsp;<br>';

                                        echo'<input type="hidden" value="'.$id.'" name="id_ling'.$x.'"></td>';
                                        $x++;

                                        echo'<td>'.$desc.'</td></tr>';
                                    }

                                    ?>
                                </table>
                            </div>
                            <?php

                            echo '<input type="hidden" value="'.$x.'" name="numLing">';

                            ?>


                            <input type="submit" id="cadastrar" value="Cadastrar"><br>

                        </form>


                    </div>
                </div>
            </div>
        </div>

    </body>
</html>