<?php

session_start();


require_once('../classes/Conexao.php');

$sql = new Conexao();

date_default_timezone_set('America/Sao_Paulo');

$datahora=date('Y-m-d H:i:s');

echo $datahora;

var_dump($_SESSION);
var_dump($_GET);

if(isset($_GET['pont']) && !isset($_GET['gameOver'])){

  //Se errou a palavra

  echo "<scrpit>
            alert('caiu aqui!!!');
        </scrpit>";

    if($_GET['pont'] > 0){

        $campos = 'jogador, pontuacao';
        $dados = "'".$_SESSION['nickname']."', ".$_GET['pont'];
        $tabela = 'ranking';

        $sql -> insert($tabela, $campos, $dados);
    }

    $tabela = 'jogador';
    $campos = 'pontuacao,gameOver,nivel';
    $where = 'nickname';
    $dado = $_SESSION['nickname'];

    $sql -> selectWhere($tabela, $campos, $where, $dado);

    var_dump($sql -> resultado);

    foreach($sql -> resultado as $value){
        $pontBd = $value['pontuacao'];
        echo $pontBd;
        $gameBd = $value['gameOver'];
        echo $gameBd;
        $nivelBd = $value['nivel'];
        echo $nivelBd;
    }

    $pontBd = intval($pontBd);

    if($pontBd != 0 && intval($gameBd) != 1 && intval($nivelBd) != 1){

        $tabela = "jogador";
        $camposDados = "pontuacao=0, gameOver=1, nivel=1";
        $where = 'nickname';
        $dado = "'".$_SESSION['nickname']."'";

        $result = $sql -> update($tabela, $camposDados, $where, $dado);
    }

    if($pontBd == 0 && $gameBd !=1){

        $tabela = "jogador";
        $camposDados = "gameOver=1";
        $where = 'nickname';
        $dado = "'".$_SESSION['nickname']."'";

        $result = $sql -> update($tabela, $camposDados, $where, $dado);
    }

    $id_pal = intval($_GET['id_palavra']);

    //$id_pal++;

    $result = $sql -> selectAnd('tentativas', 'tentativas', 'id_jogador = '.$_SESSION['id_usuario'], 'id_palavra = '.$id_pal);

    //var_dump($sql -> resultado);

    if($result == 0){

      $sql -> insert('tentativas', 'id_jogador, id_palavra, data_jogada', intval($_SESSION['id_usuario']).', '.$id_pal.", '".$datahora."'" );


    }else{

      //var_dump($sql -> resultado);

      foreach($sql->resultado as $value){
          $ten = $value['tentativas'];
      }

      $ten = intval($ten);

      //var_dump($ten);

      $ten = $ten + 1;

      //echo $ten;

      $resultado = $sql -> updateAnd('tentativas', 'tentativas = '.$ten.", data_jogada = '".$datahora."'", 'id_jogador = '.intval($_SESSION['id_usuario']), 'id_palavra = '.$id_pal);

      //echo $resultado;
    }


    $_SESSION['gameOver'] = 1;

    $_SESSION['pontuacao'] = 0;

    $_SESSION['nivel'] = 1;

}

if(isset($_GET['pont']) && isset($_GET['gameOver']) && isset($_GET['nivel'])){

  //Se passou de fase

    if($_SESSION['nivel'] ==6){
        $tabela = "jogador";
        $camposDados = "pontuacao=".$_GET['pont'].", gameOver=".$_GET['gameOver'];
        $where = 'nickname';
        $dado = "'".$_SESSION['nickname']."'";

        $result = $sql -> update($tabela, $camposDados, $where, $dado);

        echo $result;

        $pont = intval($_GET['pont']);

        $_SESSION['gameOver'] = 0;

        $_SESSION['pontuacao'] = $pont;

        var_dump($_SESSION);

    }else{
      if($_SESSION['nivel'] <6 && $_GET['nivel'] > $_SESSION['nivel']){
        $tabela = "jogador";
        $camposDados = "pontuacao=".$_GET['pont'].", gameOver=".$_GET['gameOver'].', nivel='.intval($_GET['nivel']);
        $where = 'nickname';
        $dado = "'".$_SESSION['nickname']."'";

        $result = $sql -> update($tabela, $camposDados, $where, $dado);

        echo $result;

        $pont = intval($_GET['pont']);

        $_SESSION['gameOver'] = 0;

        $_SESSION['pontuacao'] = $pont;

        $nivel = intval($_GET['nivel']);
          
          if($nivel < 7){
              $_SESSION['nivel'] = $nivel;
          }
        

        }

    }

    //var_dump($_GET);

    //header('location:../telas/escolhaDificuldade.php');
  }


?>
