<?php

session_start();

require_once ('../classes/Conexao.php');

$con = new Conexao();


$sql = 'select id_linguagem, linguagem, descricao from linguagem';

echo'<center>';
echo'<table><thead><tr id="campos"><td>Id Linguagem</td><td>Linguagem</td><td>Descrição</td><td>Opções</td></tr></thead>';

$nm=$_GET['q'];
if ($nm!='') {      
    if ($nm!='') {
        $sql.=" WHERE UPPER(linguagem) LIKE UPPER('%$nm%')";   
    }
    
}
$sql.=" ORDER BY id_linguagem";

$result = $con -> selectPre($sql);

if($result != 0){

    foreach($con -> resultado as $value){
        $id = $value['id_linguagem'];
        $ling = $value['linguagem'];
        $desc = $value['descricao'];


        echo '<tr><td>'.$id.'</td>';
        echo '<td>'.$ling.'</td>';
        echo '<td>'.$desc.'</td>';
        echo '<td><a href="editarLinguagem.php?id='.$id.'">Editar</a> | <a href="excluirLinguagem.php?id='.$id.'">Excluir</a></td></tr>';
    }

    echo"</table></center>";

} else {

    echo '<strong>Linguagem não encontrada!</strong><br>';

}

?>
