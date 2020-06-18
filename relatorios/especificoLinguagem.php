<?php

session_start();

if(!isset($_SESSION['nickname'])){
    header('location:../index.php');
}else{
    if($_SESSION['permissao'] != 'adm'){
        header('location:../index.php');
    }
}

$id_ling = $_GET['id'];

header("Content-Type: text/html; charset=UTF-8");

require_once ('../classes/Conexao.php');

$con = new Conexao();

require_once ('../TCPDF-master/tcpdf.php');

$pdf = new TCPDF('L','mm','A4',true,'UTF-8',false);

$pdf -> AddPage();

$font = "Times";

$estilo = "B";

$border = "T B";

$alinhaC = "C";

date_default_timezone_set('America/Sao_Paulo');

$data =  date('d-m-Y');

$arquivo = 'relatorio especifico de linguagem '.$data.'.pdf';

$sql = "select count(palavras.palavra) as numpalavras, linguagem.id_linguagem, linguagem.linguagem, linguagem.descricao from lingxpal
        inner join palavras on lingXpal.id_palavra = palavras.id_palavra 
        inner join linguagem on lingxpal.id_linguagem = linguagem.id_linguagem
        where linguagem.id_linguagem = ".$id_ling."
        order by linguagem.id_linguagem;";

$result = $con -> selectPre($sql);

$pdf->SetFont('Times','',14);

$pdf -> Cell(280,10,'Relatório Específico de Linguagens', 0, 1, $alinhaC);
$pdf -> Cell(190,10,'', 0, 1, $alinhaC);
$pdf -> Cell(190,10,'', 0, 1, $alinhaC);

$pdf -> SetFont($font, 'B', 10);

$tam = count($con -> resultado);

foreach($con -> resultado as $value){
    $pdf -> Cell(275,10,'Número de Palavras: ', 0, 0, "R");
    $pdf -> Cell(5,10,$value['numpalavras'], 0, 1, "R");
}


$pdf -> Cell(190,10,'', 0, 1, $alinhaC);
$pdf -> Cell(190,10,'', 0, 1, $alinhaC);


if($result != 0){

    $pdf -> SetFont($font, 'B', 10);
    $pdf -> Cell(63.33,10,'Id da Linguagem', $border, 0, $alinhaC);
    $pdf -> Cell(63.33,10,'Nome da Linguagem', $border, 0, $alinhaC);
    $pdf -> Cell(153.33,10,'Descrição', $border, 1, $alinhaC);
    //$pdf -> Cell(55.5,10,'Número de Palavras Cadastradas', $border, 1, $alinhaC);


    foreach($con -> resultado as $value){
        $pdf -> SetFont($font,"I", 9);
        $pdf -> Cell(63.33,10,$value['id_linguagem'], $border, 0, $alinhaC);
        $pdf -> Cell(63.33,10,$value['linguagem'], $border, 0, $alinhaC);
        $pdf -> Cell(153.33,10,$value['descricao'], $border, 1, $alinhaC);
        //$pdf -> Cell(55.5,10,$value['numpalavras'], $border, 1, $alinhaC);
    }


    $sql = "select  palavras.id_palavra, palavras.palavra, palavras.dica, palavras.numeroCaracteres, palavras.dificuldade 
            from lingxpal
            inner join palavras on lingXpal.id_palavra = palavras.id_palavra 
            inner join linguagem on lingxpal.id_linguagem = linguagem.id_linguagem
            where linguagem.id_linguagem = ".$id_ling."
            order by linguagem.id_linguagem;";
    
    
    $result = $con -> selectPre($sql);

    $pdf -> Cell(190,10,'', 0, 1, $alinhaC);
    $pdf -> Cell(190,10,'', 0, 1, $alinhaC);

    $pdf -> SetFont($font, 'B', 10);
    $pdf -> Cell(45,10,'Id da Palavra', $border, 0, $alinhaC);
    $pdf -> Cell(70,10,'Palavra', $border, 0, $alinhaC);
    $pdf -> Cell(80,10,'Dica', $border, 0, $alinhaC);
    $pdf -> Cell(45,10,'Número de Caracteres', $border, 0, $alinhaC);
    $pdf -> Cell(40,10,'Dificuldade', $border, 1, $alinhaC);

    foreach($con -> resultado as $value){
        $pdf -> SetFont($font,"I", 9);
        $pdf -> Cell(45,10,$value['id_palavra'], $border, 0, $alinhaC);
        $pdf -> Cell(70,10,$value['palavra'], $border, 0, $alinhaC);
        $pdf -> Cell(80,10,$value['dica'], $border, 0, $alinhaC);
        $pdf -> Cell(45,10,$value['numeroCaracteres'], $border, 0, $alinhaC);
        $pdf -> Cell(40,10,$value['dificuldade'], $border, 1, $alinhaC);
    }


}else{
    $pdf -> SetFont($font, 'B', 10);
    $pdf -> Cell(190,10,'Sem Linguagens Cadastradas', $border, 0, $alinhaC);
}

$tipo_pdf = 'I';

$pdf -> OutPut($arquivo, $tipo_pdf);




var_dump($con -> resultado);

?>
