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

$arquivo = 'relatorio de usuarios '.$data.'.pdf';

$sql = "select DISTINCT jogador.nickname,jogador.pontuacao, jogador.permissao, jogador.gameOver, jogador.id_jogador, tentativas.id_jogador as               id_tentativa,
        IF(jogador.gameOver ='1', tentativas.data_jogada, 'Sem Registro') as data_jogada
        from jogador
        inner join tentativas on tentativas.id_jogador = jogador.id_jogador
        group by tentativas.id_jogador
        order by jogador.pontuacao desc;";

$result = $con -> selectPre($sql);

$pdf->SetFont('Times','',14);

$pdf -> Cell(190,10,'Relatório de Usuários', 0, 1, $alinhaC);
$pdf -> Cell(190,10,'', 0, 1, $alinhaC);
$pdf -> Cell(190,10,'', 0, 1, $alinhaC);

$pdf -> SetFont($font, 'B', 10);
$pdf -> Cell(190,5,'Legenda:', 0, 1 );
$pdf -> Cell(190,5,'adm: Adminstrador', 0, 1 );
$pdf -> Cell(30,5,'com: Usuário Comum', 0, 0 );

$tam = count($con -> resultado);

$pdf -> Cell(150,10,'Número de jogadores: ', 0, 0, "R");
$pdf -> Cell(5,10,$tam, 0, 1, "R");


$pdf -> Cell(190,10,'', 0, 1, $alinhaC);
$pdf -> Cell(190,10,'', 0, 1, $alinhaC);


if($result != 0){

    $pdf -> SetFont($font, 'B', 10);
    $pdf -> Cell(31.67,10,'Id do Usuário', $border, 0, $alinhaC);
    $pdf -> Cell(31.67,10,'Nome do Usuário', $border, 0, $alinhaC);
    $pdf -> Cell(31.67,10,'Pontuação', $border, 0, $alinhaC);
    $pdf -> Cell(31.67,10,'Permissão', $border, 0, $alinhaC);
    $pdf -> Cell(31.67,10,'Game Over', $border, 0, $alinhaC);
    $pdf -> Cell(31.67,10,'Última Partida', $border, 1, $alinhaC);

    $ids = [];
    $i = 0;

    foreach($con -> resultado as $value){
        if(array_search($value['id_jogador'], $ids) != -1){
            $pdf -> SetFont($font,"I", 8);
            $pdf -> Cell(31.67,10,$value['id_jogador'], $border, 0, $alinhaC);
            $pdf -> Cell(31.67,10,$value['nickname'], $border, 0, $alinhaC);
            $pdf -> Cell(31.67,10,$value['pontuacao'], $border, 0, $alinhaC);
            $pdf -> Cell(31.67,10,$value['permissao'], $border, 0, $alinhaC);
            if($value['gameOver'] == 0){
                $gameOver = 'Não';
            }else{
                $gameOver = 'Sim';
            }
            $pdf -> Cell(31.67,10,$gameOver, $border, 0, $alinhaC);
            $pdf -> Cell(31.67,10,$value['data_jogada'], $border, 1, $alinhaC);
            $ids[$i] = $value['id_jogador'];
            $i = $i +1;
        }
    }


}else{
    $pdf -> SetFont($font, 'B', 10);
    $pdf -> Cell(190,10,'Sem Usuários Cadastrados', $border, 0, $alinhaC);
}

$tipo_pdf = 'I';

$pdf -> OutPut($arquivo, $tipo_pdf);




var_dump($con -> resultado);

?>
