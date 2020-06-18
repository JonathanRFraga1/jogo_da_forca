<?php

class Conexao extends PDO{

    private $conn;

    public $resultado; // atributo onde os dados são armazendados temporariamente

    public function __construct(){

        //cria a conexão com o bd

        $senha = '';

        $this->conn = new PDO('mysql:dbname=jogo_da_forca; host=localhost', 'root', $senha);

    }

    public function insert($tabela, $campos, $valores) {

        // metodo generico para insersão de dados no bd

        $sql = "";

        $sql = "INSERT INTO ".$tabela." (".$campos.") VALUES (".$valores.");";

        //echo $sql;

        $stmt = $this -> conn -> prepare($sql);

        $this -> resposta = $stmt -> execute();

        //        echo $sql;

        if(empty($this->resultado)){ // <- utilizado para verificar se foi cadatrado no bd

            return $x =0;
        }else{
            return $x =1;
        }

    }

    public function selectWhere($tabela, $campos, $where, $dado){

        // metodo generico para selects com a clausula where

        $sql = 'SELECT '.$campos.' FROM '.$tabela.' WHERE '.$where." = '".$dado."'";

        //echo $sql;

        $stmt = $this -> conn -> prepare($sql);

        $stmt -> execute();

        $this-> resultado = $stmt -> fetchAll(); // envia para um atributo onde são armazenados os dados temporariamente

        if(empty($this->resultado)){ // <- utilizado para verificar se já foi cadatrado anteriormente no bd
            return $x =0;
        }else{
            return $x =1;
        }

    }

    public function selectAnd($tabela, $campos, $where1 , $where2){

        // metodo generico para selects com a clausula where

        $sql = 'SELECT '.$campos.' FROM '.$tabela." WHERE ".$where1." and ".$where2;

        //echo $sql;

        $stmt = $this -> conn -> prepare($sql);

        $stmt -> execute();

        $this-> resultado = $stmt -> fetchAll(); // envia para um atributo onde são armazenados os dados temporariamente

        if(empty($this->resultado)){ // <- utilizado para verificar se já foi cadatrado anteriormente no bd
            return $x =0;
        }else{
            return $x =1;
        }

    }

    public function selectSimples($tabela, $campos) {

        // metodo generico para select sem a clusula where

        $sql = 'SELECT '.$campos.' FROM '.$tabela;

        //echo $sql;

        $stmt = $this -> conn -> prepare($sql);

        $stmt -> execute();

        $this-> resultado = $stmt -> fetchAll(); // envia para um atributo onde são armazenados os dados temporariamente

        if(empty($this->resultado)){ // <- utilizado para verificar se já foi cadatrado anteriormente no bd

            //echo $sql;

            return $x =0;
        }else{
            return $x =1;
        }

    }

    public function selectEscolha($dificuldade, $id_linguagem){
        $sql = 'select palavras.palavra, palavras.id_palavra, palavras.dica, palavras.numeroCaracteres, linguagem.linguagem, lingxpal.id_palavra, lingXpal.id_linguagem from lingxpal
                inner join palavras on lingXpal.id_palavra = palavras.id_palavra
                inner join linguagem on lingxpal.id_linguagem = linguagem.id_linguagem
                where lingXpal.id_linguagem = '.intval($id_linguagem).' and  palavras.dificuldade = '.intval($dificuldade).';';

        $stmt = $this -> conn -> prepare($sql);

        $stmt -> execute();

        $this-> resultado = $stmt -> fetchAll();
    }

    public function selectLinguagem($linguagem){
        $sql = 'select palavras.id_palavra, palavras.palavra, palavras.numeroCaracteres, palavras.dica, lingXpal.id_linguagem from palavras, lingXpal where  lingXpal.id_linguagem = '.$dificuldade;

        $stmt = $this -> conn -> prepare($sql);

        $stmt -> execute();

        $this-> resultado = $stmt -> fetchAll();
    }

    public function selectRanking() {

        // metodo generico para select sem a clusula where

        $sql = 'SELECT jogador, pontuacao FROM ranking ORDER BY pontuacao DESC LIMIT 10';

        //echo $sql;

        $stmt = $this -> conn -> prepare($sql);

        $stmt -> execute();

        $this-> resultado = $stmt -> fetchAll(); // envia para um atributo onde são armazenados os dados temporariamente

        if(empty($this->resultado)){ // <- utilizado para verificar se já foi cadatrado anteriormente no bd

            //echo $sql;

            return $x =0;
        }else{
            return $x =1;
        }

    }

    public function selectPre($sql){

        $stmt = $this -> conn -> prepare($sql);

        $stmt -> execute();

        $this-> resultado = $stmt -> fetchAll();

        if(empty($this->resultado)){ // <- utilizado para verificar se já foi cadatrado anteriormente no bd

            //echo $sql;

            return $x =0;
        }else{
            return $x =1;
        }
    }

    public function update($tabela, $camposDados, $where, $dado){

        $sql = 'UPDATE '.$tabela.' SET '.$camposDados.' WHERE '.$where.'='.$dado;

        //echo $sql.'<br>';

        $stmt = $this -> conn -> prepare($sql);

        $stmt -> execute();

        $nLinhas = $stmt -> rowCount();

        if($nLinhas == 0){
            return 'Erro ao Atualizar!';
        }else{
            return 'Atualização concluida com sucessso!';
        }

    }

    public function updateAnd($tabela, $camposDados, $where1, $where2){

        $sql = 'UPDATE '.$tabela.' SET '.$camposDados.' WHERE '.$where1.' AND '.$where2 ;

        //echo $sql.'<br>';

        $stmt = $this -> conn -> prepare($sql);

        $stmt -> execute();

        $nLinhas = $stmt -> rowCount();

        if($nLinhas == 0){
            return 'Erro ao Atualizar!';
        }else{
            return 'Atualização concluida com sucessso!';
        }

    }

    public function delete($tabela, $where, $dado){

        $sql = 'DELETE FROM '.$tabela.' WHERE '.$where.' = '.$dado;

        $stmt = $this -> conn -> prepare($sql);

        $stmt -> execute();

        $nLinhas = $stmt -> rowCount();

        if($nLinhas == 0){
            return 'Erro ao Excluir!';
        }else{
            return 'Exclusão concluida com sucessso!';
        }

    }
}


?>
