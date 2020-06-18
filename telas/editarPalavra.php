<!DOCTYPE html>

<?php

session_start();

if($_SESSION['permissao'] != 'adm'){ //apenas o adm deve possuir acesso
    header('location:../index.php');
}

error_reporting(0);
ini_set(“display_errors”, 0 );

if(isset($_GET['id'])){
    $id = $_GET['id'];

    require_once('../classes/Conexao.php');

    $sql = new Conexao();

    $result = $sql -> selectWhere('palavras', 'id_palavra, palavra, dificuldade, numeroCaracteres, dica', 'id_palavra', $id);

    foreach($sql -> resultado as $value){
        $id = $value['id_palavra'];
        $palavra = $value['palavra'];
        $dificuldade = $value['dificuldade'];
        $numChar = $value['numeroCaracteres'];
        $dica = $value['dica'];
    }

    $dif1 = null;
    $dif2 = null;
    $dif3 = null;
    $dif4 = null;
    $dif5 = null;
    $dif6 = null;

    switch($dificuldade){
        case 1:
            $dif1 = 'checked="checked"';
            break;

        case 2:
            $dif2 = 'checked="checked"';
            break;

        case 3:
            $dif3 = 'checked="checked"';
            break;

        case 4:
            $dif4 = 'checked="checked"';
            break;

        case 5:
            $dif5 = 'checked="checked"';
            break;

        case 6:
            $dif6 = 'checked="checked"';
            break;
    }
}else{
    header('location:./palavras.php');
}



?>

<html>

    <head>
        <meta charset="utf-8">
        <meta lang="pt-br">
        <title>Editar Palavra</title>
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
                    <li><a href="palavras.php">Palavras</a>
                        <ul>
                            <li id="nu"><a href="./novaPalavra.php">Nova Palavra</a></li>
                        </ul>
                    </li>
                </ul>

            </nav>
            <div class="conteudo">
                <div class="texto">
                    Editar Palavra
                </div>

                <div class="ajuste">
                    <div class="form">
                        <form method="post" action="../mediadores/ePalavra.php">

                            <label for="pal">Palavra:</label><br>
                            <input type="text" id="pal" name="palavra" placeholder="Digite a palavra" autocomplete="off" autofocus value="<?php echo $palavra ?>">

                            <label for="dica">Dica:</label><br>
                            <textarea id="dica" name="dica" rows="5" cols="33" placeholder="Digite a dica da palavra" autocomplete="off"><?php echo $dica ?></textarea>
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
                                    <input type="radio" id="dif1" name="dificuldade" value="1" <?php echo $dif1 ?>><label for="dif1">Nível 1</label>&nbsp;&nbsp;
                                    <input type="radio" id="dif2" name="dificuldade" value="2" <?php echo $dif2 ?>><label for="dif2">Nível 2</label>&nbsp;&nbsp;
                                    <input type="radio" id="dif3" name="dificuldade" value="3" <?php echo $dif3 ?>><label for="dif3">Nível 3</label>&nbsp;&nbsp;

                                    <input type="radio" id="dif4" name="dificuldade" value="4" <?php echo $dif4 ?>><label for="dif4">Nível 4</label>&nbsp;&nbsp;
                                    <input type="radio" id="dif5" name="dificuldade" value="5" <?php echo $dif5 ?>><label for="dif5">Nível 5</label>&nbsp;&nbsp;
                                    <input type="radio" id="dif6" name="dificuldade" value="6" <?php echo $dif6 ?>><label for="dif6">Nível 6</label>&nbsp;&nbsp;
                                </div>
                            </div>

                            <br>
                            <br>

                            <input type="hidden" name="id" value="<?php echo $id ?>">

                            <div class="links">


                                <table>
                                    <tr>
                                        <td><strong>Linguagem</strong></td>
                                        <td><strong>Descrição</strong></td>
                                    </tr>

                                    <?php

    $sql -> selectWhere('lingXpal', 'id_linguagem', 'id_palavra', $id);

                                           $_id = array();

                                           $y =0;

                                           foreach($sql -> resultado as $value){
                                               if($value['id_linguagem'] !=0){
                                                   $_id[$y] = $value['id_linguagem'];
                                                   $y++;
                                               }
                                           }

                                           //var_dump($_id);

                                           $x =1;

                                           $result = $sql -> selectSimples('linguagem', 'linguagem, id_linguagem, descricao');

                                           $y =0;

                                           $z = sizeof($_id);

                                           if($z != 0){
                                               $z--;

                                           }


                                           //var_dump($z);

                                           foreach($sql -> resultado as $value){
                                               $ling = $value['linguagem'];
                                               if($value['id_linguagem'] !=0){
                                                   $id = $value['id_linguagem'];
                                               }
                                               $desc = $value['descricao'];

                                               if($_id[$y] == $id && $y <= $z){
                                                   //echo $_id[$y], $id;
                                                   $var = 'checked';
                                                   $y++;
                                               }else{
                                                   $var = null;
                                               }

                                               echo '<tr><td><input type="checkbox" value="'.$ling.'" name="linguagem'.$x.'" id="'.$ling.'" '.$var.'> <label for="'.$ling.'" >'.$ling.'</label></td>';
                                               echo'<td>'.$desc.'</td>';

                                               echo'<input type="hidden" value="'.$id.'" name="id_ling'.$x.'">';

                                               $x++;
                                           }


                                    ?>

                                </table>
                            </div>
                            <?php

                            echo '<input type="hidden" value="'.$x.'" name="numLing">';

                            ?>


                            <input type="submit" id="cadastrar" value="Atualizar"><br>

                        </form>


                    </div>
                </div>
            </div>
        </div>

    </body>

</html>
