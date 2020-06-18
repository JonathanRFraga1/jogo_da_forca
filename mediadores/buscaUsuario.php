<?php

session_start();

require_once ('../classes/Conexao.php');

$con = new Conexao();


$sql = 'select id_jogador, nickname, pontuacao, gameOver, permissao from jogador';

echo'<center>';
echo'<table><thead><tr id="campos"><td>Id Jogador</td><td>Nickname</td><td>Pontuação</td><td>Game Over</td><td>Permissão</td><td>Opções</td></thead></tr><tbody>';


//echo $sql;


$nm=$_GET['q']; //recupera o parâmetro passado na visualização
if ($nm!='') {      
    if ($nm!='') {
        $sql.=" WHERE UPPER(nickname) LIKE UPPER('%$nm%')";   
    }
    /*unset($_POST['nome']);
    unset($_POST['filtrar']);*/

}
$sql.=" ORDER BY id_jogador";

$result = $con -> selectPre($sql);

if($result != 0){

    foreach($con -> resultado as $value){
        $id = $value['id_jogador'];
        $nick = $value['nickname'];
        $pontuacao = $value['pontuacao'];
        $gameOver = $value['gameOver'];
        $permissao = $value['permissao'];


        echo '<tr><td>'.$id.'</td>';
        echo '<td>'.$nick.'</td>';
        echo '<td>'.$pontuacao.'</td>';
        echo '<td>'.$gameOver.'</td>';
        echo '<td>'.$permissao.'</td>';
        echo '<td><a href="editarUsuario.php?id='.$id.'">Editar</a> | <a href="excluirUsuario.php?id='.$id.'">Excluir</a></td></tr>';
    }


    echo"</tbody></table></center>";

} else {

    echo '<strong>Jogador não encontrado!</strong><br>';

}




?>
