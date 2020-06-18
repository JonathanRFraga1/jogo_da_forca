<?php

session_start();

require_once ('../classes/Conexao.php');

$con = new Conexao();


$sql = 'select id_palavra, palavra, dificuldade, numeroCaracteres, dica from palavras';

echo'<center>';
echo'<table><thead class="fixed"><tr id="campos"><td>Id Palavra</td><td>Palavra</td><td>Dificuldade</td><td>N° Caracteres</td><td>Dica</td><td>Opções</td></tr></thead>';

//echo $sql;

echo '<tbody>';


$nm=$_GET['q'];//recupera o parâmetro passado na visualização
$od=$_GET['od'];
$ln =$_GET['ln'];//recupera o parâmetro passado na visualização
if ($nm!='') {
    if ($nm!='') {
        $sql.=" WHERE UPPER(palavra) LIKE UPPER('%$nm%') ORDER BY $od $ln";
    }else{
        if($nm=='' && $od!=''){
            $sql.=" ORDER BY $od $ln"; 
        }
    }
    /*unset($_POST['nome']);
    unset($_POST['filtrar']);*/

}else{
    if($od!='undefined'){
        $sql.=" ORDER BY $od $ln"; 
    }else{

        $sql.=" ORDER BY dificuldade ASC";
    }

}



$result = $con -> selectPre($sql);

if($result != 0){

    foreach($con -> resultado as $value){
        $id = $value['id_palavra'];
        $palavra = $value['palavra'];
        $dificuldade = $value['dificuldade'];
        $numChar = $value['numeroCaracteres'];
        $dica = $value['dica'];


        echo '<tr><td>'.$id.'</td>';
        echo '<td>'.$palavra.'</td>';
        echo '<td>'.$dificuldade.'</td>';
        echo '<td>'.$numChar.'</td>';
        echo '<td>'.$dica.'</td>';
        echo '<td><a href="editarPalavra.php?id='.$id.'">Editar</a> <a href="excluirPalavra.php?id='.$id.'">Excluir</a></td></tr>';
    }


    echo"</tbody>";
    echo"</table>";
    echo"</center>";

} else {

    echo '<strong>Palavra não encontrada!</strong><br>';

}


?>
