<?php

require_once('Conexao.php');

class Linguagem{

    private $linguagem;
    private $descricao;
    private $campos;
    private $tabela;
    private $valores;

    public function getLinguagem(){
        return $this -> linguagem;
    }

    public function setLinguagem($value){
        $this -> linguagem = $value;
    }

    public function getDescricao(){
        return $this -> descricao;
    }

    public function setDescricao($value){
        $this -> descricao = $value;
    }

    public function setDados($linguagem, $descricao){

        //seta os dados nos atributos

        $this -> setLinguagem($linguagem);
        $this -> setDescricao($descricao);

        $result = $this -> verificaLinguagem();

        return $result;

    }

    public function verificaLinguagem(){

        // verifica se a linguagem já foi cadastrada no bd

        $sql = new Conexao();

        $result = $sql -> selectWhere('linguagem','linguagem', 'linguagem', $this -> getLinguagem());

        if($result > 0){
            return 'Linguagem já cadastrada';
        }else{
            $result = $this -> montaInsert();

            return $result;
        }


    }

    public function montaInsert(){

        // monta o insert para o bd

        $sql = new Conexao();

        $this -> tabela = 'linguagem';
        $this -> campos = 'linguagem, descricao';
        $this -> valores = "'".$this->getlinguagem()."','".$this->getDescricao()."'";

        $result = $sql -> insert($this -> tabela, $this-> campos, $this -> valores);

        if($result > 0){
            return 'Erro ao cadastrar!';
        }else{
            return 'Cadastro realizado com sucesso!';
        }
    }
}

?>
