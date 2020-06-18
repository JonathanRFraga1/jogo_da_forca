<?php

session_start();

require_once ('../classes/Conexao.php');

$con = new Conexao();


$sql = 'select id_linguagem, linguagem, descricao from linguagem';

$nm=$_GET['q'];
if ($nm!='') {      
    if ($nm!='') {
        $sql.=" WHERE UPPER(linguagem) LIKE UPPER('%$nm%')";   
    }

}
$sql.=" ORDER BY id_linguagem";

$result = $con -> selectPre($sql);

echo'<div class="tabela"><table><thead><tr><td>Linguagem</td><td>Descrição</td></tr></thead>';

echo '<tr><td>';
echo '<input type="radio" value="0" name="linguagem" id="tudo" checked> <label for="tudo">Misto</label></td>';
echo '<td>Pode Cair Qualquer Linguagem</td></tr>';


if($result != 0){

    foreach($con -> resultado as $value){
        $ling = $value['linguagem'];
        $desc = $value['descricao'];
        $id = $value['id_linguagem'];


        echo '<tr><td>';
        echo '<input type="radio" value="'.$id.'" name="linguagem" id="'.$ling.'"> <label for="'.$ling.'">'.$ling.'</label></td>';
        echo '<td>'.$desc.'</td></tr>';

    }

    echo'</table></div>';
} else {

    echo '<strong>Linguagem não encontrada!</strong><br>';

}
?>
