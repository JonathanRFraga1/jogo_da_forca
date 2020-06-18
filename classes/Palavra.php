<?php

require_once('Conexao.php');

class Palavra{

    private $palavra;
    private $dica;
    private $dificuldade;
    private $charNum;
    private $campos;
    private $tabela;
    private $valores;

    public function getPalavra(){
        return $this -> palavra;
    }

    public function setPalavra($value){
        $pal = strtolower($value);
        $this -> palavra = $pal;
        $this -> setCharNum();
    }

    public function getDica(){
        return $this -> dica;
    }

    public function setDica($value){
        $this -> dica = $value;
    }

    public function getDificuldade(){
        return $this -> dificuldade;
    }

    public function setDificuldade($value){
        $this -> dificuldade = $value;
    }

    public function getCharNum(){
        return $this -> charNum;
    }

    public function setCharNum(){
        $value = $this -> getPalavra();
        $this -> charNum = strlen($value);
    }

    public function setDados($palavra, $dificuldade, $dica){

        //seta os dados nos atributos

        $this -> setPalavra($palavra);
        $this -> setDica($dica);
        $this -> setDificuldade($dificuldade);

        $result = $this -> verificaPalavra();

        return $result;

    }

    public function verificaPalavra(){

        //verifica se a palavra existe no bd

        $sql = new Conexao();

        $result = $sql -> selectWhere('palavras','palavra', 'palavra', $this -> getPalavra());

        if($result > 0){
            return 'Palavra já cadastrada';
        }else{
            $result = $this -> montaInsert();

            return $result;
        }


    }

    public function montaInsert(){

        //monta o insert para o bd

        $sql = new Conexao();

        $this -> tabela = 'palavras';
        $this -> campos = 'palavra, dica, dificuldade, numeroCaracteres';
        $this -> valores = "'".$this->getPalavra()."','".$this->getDica()."',".$this->getDificuldade().",".$this->getCharNum();

        $result = $sql -> insert($this -> tabela, $this-> campos, $this -> valores);

        if($result > 0){
            return 'Erro ao cadastrar!';
        }else{
            return 'Cadastro realizado com sucesso!';
        }
    }
}

?>
