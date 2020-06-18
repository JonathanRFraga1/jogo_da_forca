<!DOCTYPE html>

<?php

session_start();
require_once('../classes/Conexao.php');

$sql = new Conexao();

$sql -> selectRanking();

?>

<html>

    <head>
        <meta charset="utf-8">
        <meta lang="pt-br">
        <meta name="viewport" content="width=device-width">
        <title>Ranking</title>
        <link rel="stylesheet" href="../css/ranking.css" type="text/css">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
        <link rel="shortcut icon" href="../img/badge.png" />

    </head>
    <body>

        <div class="principal">
            <div class="ajuste">
                <div class="titulo">
                    <p>Ranking</p>
                </div>
                <div class="ranking">

                    <?php

                    echo'<table>
                <thead>
                <tr id="campos">
                <td>Nickname</td>
                <td>Pontuação</td>
                </tr>
                </thead>
                <tbody>';

                    foreach($sql -> resultado as $value){
                        $nick = $value['jogador'];
                        $pont = $value['pontuacao'];

                        echo '<tr><td>'.$nick.'</td>';
                        echo '<td>'.$pont.'</td>
                    </tr>';
                    }

                    echo'</tbody>
                </table>';

                    ?>

                </div>
                <div class="rodape">
                    <div class="copy">
                        <p>&copy; Jonathan Rossetto de Fraga</p>
                    </div>
                    <div class="link">
                    <?php
                    if(isset($_SESSION['nickname'])){

                        if($_SESSION['gameOver'] != 1 && $_SESSION['nivel'] > 1){ // caso gameOver == false -> para continuar uma partida anterior

                            echo '<a href="./telas/escolhaDificuldade.php">Continuar</a>';

                        }else{

                            echo'<a href="../telas/fase.php">Novo Jogo</a>';
                        }
                    }
                    ?>
                    
                    <a href="../index.php">Menu Principal</a>
                    
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>