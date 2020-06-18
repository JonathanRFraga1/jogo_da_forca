<?php

require_once('Conexao.php');

class Fase{

    public $palavras = array();

    public $numChar = array();

    public $dica = array();

    public $id = array();

    public $numValores;

    public $array_palavra;

    public $array_numChar;

    public $array_dica;

    public $array_id;

    public function nivel1(){

        $sql = new Conexao();

        $sql -> selectWhere('palavras', 'id_palavra, palavra, numeroCaracteres, dica','dificuldade', 1);

        $x =0;

        foreach($sql->resultado as $value){

            $this -> palavras[$x] = $value['palavra'];
            $this -> numChar[$x] = $value['numeroCaracteres'];
            $this -> dica[$x] = $value['dica'];
            $this -> id[$x] = $value['id_palavra'];

            $x ++;

        }

        $this -> array_palavras = implode('|', $this -> palavras);
        $this -> array_dica = implode('|', $this -> dica);
        $this -> array_numChar = implode('|', $this -> numChar);
        $this -> array_id = implode('|', $this -> id);

        /*var_dump($this -> palavras);
        var_dump($this -> numChar);
        var_dump($this -> dica);*/

        $this -> numValores = $x;

    }

    public function nivelEscolha($dificuldade, $linguagem){

        $sql = new Conexao();

        $result = $sql -> selectEscolha($dificuldade, $linguagem);

        $x =0;

        foreach($sql->resultado as $value){

            $this -> palavras[$x] = $value['palavra'];
            $this -> numChar[$x] = $value['numeroCaracteres'];
            $this -> dica[$x] = $value['dica'];
            $this -> id[$x] = $value['id_palavra'];

            $x ++;

        }

        $this -> array_palavras = implode('|', $this -> palavras);
        $this -> array_dica = implode('|', $this -> dica);
        $this -> array_numChar = implode('|', $this -> numChar);
        $this -> array_id = implode('|', $this -> id);

        //        var_dump($this -> palavras);
        //        var_dump($this -> numChar);
        //        var_dump($this -> dica);


        $this -> numValores = $x;

        return $result;

    }

    public function nivelDificuldade($dificuldade){

        $sql = new Conexao();

        $result = $sql -> selectWhere('palavras', 'id_palavra, palavra, numeroCaracteres, dica','dificuldade', $dificuldade);

        $x =0;

        foreach($sql->resultado as $value){

            $this -> palavras[$x] = $value['palavra'];
            $this -> numChar[$x] = $value['numeroCaracteres'];
            $this -> dica[$x] = $value['dica'];
            $this -> id[$x] = $value['id_palavra'];

            $x ++;

        }

        $this -> array_palavras = implode('|', $this -> palavras);
        $this -> array_dica = implode('|', $this -> dica);
        $this -> array_numChar = implode('|', $this -> numChar);
        $this -> array_id = implode('|', $this -> id);

        //        var_dump($this -> palavras);
        //        var_dump($this -> numChar);
        //        var_dump($this -> dica);


        $this -> numValores = $x;

        return $result;

    }

    public function nivelLinguagem($linguagem){

        $sql = new Conexao();

        $result = $sql -> selectLinguagem($linguagem);

        $x =0;

        foreach($sql->resultado as $value){

            $this -> palavras[$x] = $value['palavra'];
            $this -> numChar[$x] = $value['numeroCaracteres'];
            $this -> dica[$x] = $value['dica'];
            $this -> id[$x] = $value['id_palavra'];

            $x ++;

        }

        $this -> array_palavras = implode('|', $this -> palavras);
        $this -> array_dica = implode('|', $this -> dica);
        $this -> array_numChar = implode('|', $this -> numChar);
        $this -> array_id = implode('|', $this -> id);

        //        var_dump($this -> palavras);
        //        var_dump($this -> numChar);
        //        var_dump($this -> dica);


        $this -> numValores = $x;

        return $result;

    }

    public function nivelMisto(){

        $sql = new Conexao();

        $result = $sql -> selectSimples('palavras', 'id_palavra, palavra, numeroCaracteres, dica');

        $x =0;

        foreach($sql->resultado as $value){

            $this -> palavras[$x] = $value['palavra'];
            $this -> numChar[$x] = $value['numeroCaracteres'];
            $this -> dica[$x] = $value['dica'];
            $this -> id[$x] = $value['id_palavra'];

            $x ++;
        }

        $this -> array_palavras = implode('|', $this -> palavras);
        $this -> array_dica = implode('|', $this -> dica);
        $this -> array_numChar = implode('|', $this -> numChar);
        $this -> array_id = implode('|', $this -> id);

        //        var_dump($this -> palavras);
        //        var_dump($this -> numChar);
        //        var_dump($this -> dica);


        $this -> numValores = $x;

        return $result;
    }

}
