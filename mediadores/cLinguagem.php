<?php

require_once('../classes/Linguagem.php');

if(isset($_POST['linguagem']) && isset($_POST['descricao'])){

    $lin = new Linguagem();

    $result = $lin -> setDados($_POST['linguagem'], $_POST['descricao']);

    session_start();

    if(isset($_SESSION['resp'])){
        unset($_SESSION['resp']);
    }

    $_SESSION['resp'] = $result;
    
    if($result == 'Cadastro realizado com sucesso!'){
        
         header('location: ../telas/linguagens.php');
        
    }else{
        
         header('location: ../telas/novaLinguagem.php');
        
    }

   


}else{

}

?>
