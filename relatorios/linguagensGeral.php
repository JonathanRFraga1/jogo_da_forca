<?php

session_start();

if(!isset($_SESSION['nickname'])){
    header('location:../index.php');
}else{
    if($_SESSION['permissao'] != 'adm'){
        header('location:../index.php');
    }
}

header("Content-Type: text/html; charset=UTF-8");

require_once ('../classes/Conexao.php');

$con = new Conexao();

require_once ('../TCPDF-master/tcpdf.php');

$pdf = new TCPDF('P','mm','A4',true,'UTF-8',false);

$pdf -> AddPage();

$font = "Times";

$estilo = "B";

$border = "T B";

$alinhaC = "C";

date_default_timezone_set('America/Sao_Paulo');

$data =  date('d-m-Y');

$arquivo = 'relatorio gerel de linguagens '.$data.'.pdf';

/*$sql = "select count(palavras.palavra) as numpalavras, linguagem.id_linguagem, linguagem.linguagem, linguagem.descricao from lingxpal
inner join palavras on lingXpal.id_palavra = palavras.id_palavra
inner join linguagem on lingxpal.id_linguagem = linguagem.id_linguagem
group by linguagem.id_linguagem
order by linguagem.id_linguagem;";*/

$sql = "select id_linguagem, linguagem, descricao from linguagem;";

$result = $con -> selectPre($sql);

$pdf->SetFont('Times','',14);

$pdf -> Cell(190,10,'Relatório Geral de Linguagens', 0, 1, $alinhaC);
$pdf -> Cell(190,10,'', 0, 1, $alinhaC);
$pdf -> Cell(190,10,'', 0, 1, $alinhaC);

$pdf -> SetFont($font, 'B', 10);

$tam = count($con -> resultado);

$pdf -> Cell(185,10,'Número de linguagens: ', 0, 0, "R");
$pdf -> Cell(5,10,$tam, 0, 1, "R");


$pdf -> Cell(190,10,'', 0, 1, $alinhaC);
$pdf -> Cell(190,10,'', 0, 1, $alinhaC);


if($result != 0){

    $pdf -> SetFont($font, 'B', 10);
    $pdf -> Cell(38.5,10,'Id da Linguagem', $border, 0, $alinhaC);
    $pdf -> Cell(48.5,10,'Nome da Linguagem', $border, 0, $alinhaC);
    $pdf -> Cell(47.5,10,'Descrição', $border, 0, $alinhaC);
    $pdf -> Cell(55.5,10,'Número de Palavras Cadastradas', $border, 1, $alinhaC);


    foreach($con -> resultado as $value){
        $pdf -> SetFont($font,"I", 8);
        $pdf -> Cell(38.5,10,$value['id_linguagem'], $border, 0, $alinhaC);
        $pdf -> Cell(48.5,10,$value['linguagem'], $border, 0, $alinhaC);
        $pdf -> Cell(47.5,10,$value['descricao'], $border, 0, $alinhaC);

        $sql = "select count(palavras.palavra) as numpalavras from lingxpal
                inner join palavras on lingXpal.id_palavra = palavras.id_palavra
                inner join linguagem on lingxpal.id_linguagem = linguagem.id_linguagem
                where linguagem.id_linguagem = ".$value['id_linguagem']."
                group by linguagem.id_linguagem
                order by linguagem.id_linguagem;";

        $result = $con -> selectPre($sql);
        
        $numPal = 0;

        foreach($con -> resultado as $value){

            $numPal = intval($value['numpalavras']);
           
        }
        
        if($numPal != null){
            $pdf -> Cell(55.5,10,$numPal, $border, 0, $alinhaC);
        }else{
            $pdf -> Cell(55.5,10,0, $border, 0, $alinhaC);
        }
        
        
        
        $pdf -> Cell(0, 10,'' ,0, 1, $alinhaC);
    }


}else{
    $pdf -> SetFont($font, 'B', 10);
    $pdf -> Cell(190,10,'Sem Linguagens Cadastradas', $border, 0, $alinhaC);
}

$tipo_pdf = 'I';

$pdf -> OutPut($arquivo, $tipo_pdf);




var_dump($con -> resultado);

?>
