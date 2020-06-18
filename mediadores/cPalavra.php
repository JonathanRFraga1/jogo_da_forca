<?php

require_once('../classes/Palavra.php');
require_once('../classes/Conexao.php');

if(isset($_POST['palavra']) && isset($_POST['dica']) && isset($_POST['dificuldade'])){

    $x = $_POST['numLing'];

    $x--;

//    var_dump($_POST);

    $dados = null;

    $id = array();

    $i =0;

    $pal = new Palavra();

    $sql = new Conexao();

    $result = $pal -> setDados($_POST['palavra'], $_POST['dificuldade'], $_POST['dica']);

    echo $result;


//var_dump($_POST);
    for($x = $_POST['numLing'];$x >=0; $x--){

        if(isset($_POST['linguagem'.$x])){
            $id_linguagem = $_POST['id_ling'.$x];

            $id[$i] = $id_linguagem;

            $i++;

        }

        
    }

    $i--;



    $sql -> selectWhere('palavras', 'id_palavra', 'palavra', $_POST['palavra']);

    foreach($sql -> resultado as $value){
        $id_palavra = $value['id_palavra'];
    }

    while($i>=0){
        echo $id[$i];

        $resultado = $sql -> insert('lingXpal', 'id_palavra, id_linguagem', $id_palavra.', '.$id[$i]);
        
//        echo $id[$i];

//        echo $resultado.' cadastro N..N';

        $i--;
    }

    session_start();

    if(isset($_SESSION['resp'])){
        unset ($_SESSION['resp']);
    }

    $_SESSION['resp'] = $result;
    
    echo $_SESSION['resp'];
    
    

    if($result == 'Cadastro realizado com sucesso!'){

        header('location:../telas/palavras.php');

    }else{

        header('location:../telas/novaPalavra.php');


    }
}

?>
