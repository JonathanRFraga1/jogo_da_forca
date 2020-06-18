<?php

require_once('../classes/Palavra.php');
require_once('../classes/Conexao.php');

if(isset($_POST['palavra']) && isset($_POST['dica']) && isset($_POST['dificuldade'])){


    session_start();

    $sql = new Conexao();

    $pal = new Palavra();


    $result = $pal -> setPalavra($_POST['palavra']);

    if(isset($_SESSION['resp'])){
        unset ($_SESSION['resp']);
    }

    $_SESSION['resp'] = $result;

    $return = $sql -> selectWhere('palavras', 'dificuldade, palavra, dica', 'id_palavra', $_POST['id']);

    foreach($sql -> resultado as $value){

        $dificuldade = $value['dificuldade'];
        $palavra = $value['palavra'];
        $dica = $value['dica'];

    }

    if($palavra != $_POST['palavra'] && $dica == $_POST['dica'] && $dificuldade == $_POST['dificuldade']){

        $stringUpdate = "palavra = '".$_POST['palavra']."'";

        $result = $sql -> update('palavras', $stringUpdate, 'id_palavra', $_POST['id']);

    }else{

        if($palavra == $_POST['palavra'] && $dica != $_POST['dica'] && $dificuldade == $_POST['dificuldade']){

            $stringUpdate = "dica = '".$_POST['dica']."'";

            $result = $sql -> update('palavras', $stringUpdate, 'id_palavra', $_POST['id']);

        }else{

            if($palavra == $_POST['palavra'] && $dica == $_POST['dica'] && $dificuldade != $_POST['dificuldade']){

                $stringUpdate = "dificuldade = ".$_POST['dificuldade'];

                $result = $sql -> update('palavras', $stringUpdate, 'id_palavra', $_POST['id']);

            }else{
                
                $stringUpdate = "palavra ='".$_POST['palavra']."', numeroCaracteres = ". $pal -> getCharNum().", dica = '".$_POST['dica']."', dificuldade = ".$_POST['dificuldade'];
                
                $result = $sql -> update('palavras', $stringUpdate, 'id_palavra', $_POST['id']);
                
            }

        }

    }

    $id = array();

    $i =0;

    $x = $_POST['numLing'];

    while($x >=0){

        if(isset($_POST['linguagem'.$x])){

            $id_linguagem = $_POST['id_ling'.$x];

            $id[$i] = $id_linguagem;

            $i++;
        }

        $x--;
    }

    $i--;
    
    $sql -> delete('lingXpal', 'id_palavra', $_POST['id']);

    while($i>=0){
        echo $id[$i];
        
         $resultado = $sql -> insert('lingXpal', 'id_palavra, id_linguagem', $_POST['id'].', '.$id[$i]);
        
        $i--;
    }

    if(isset($_SESSION['resp'])){
        unset ($_SESSION['resp']);
    }

    $_SESSION['resp'] = $result;

    //echo $results;

    header('location: ../telas/palavras.php');


}

?>