<?php

session_start();

require_once('Conexao.php');

class Usuario{

    private $usuario;
    private $senha;
    private $per;

    public function getUsuario(){
        return $this -> usuario;
    }

    public function setUsuario($value){
        $this -> usuario = $value;
    }

    public function getSenha(){
        return $this -> senha;
    }

    public function setSenha($value){

        //gera um hash
        $password = password_hash($value, PASSWORD_DEFAULT);

        $this -> senha = $password;
    }

    public function getPermissao(){
        return $this -> per;
    }

    public function setPermissao($value){
        $this -> per = $value;
    }

    public function setDados($login, $senha, $per){

        //seta os dados nos atributos

        $this -> setSenha($senha);
        $this -> setUsuario($login);
        $this -> setPermissao($per);

        $result = $this -> verificaUsuario();

        return $result;

    }

    public function verificaUsuario(){

        // verifica se a linguagem já foi cadastrada no bd

        $sql = new Conexao();

        $result = $sql -> selectWhere('jogador','nickname', 'nickname', $this -> getUsuario());

        if($result > 0){
            return 'Jogador já cadastrado';
        }else{
            $result = $this -> montaInsert();

            return $result;
        }

    }

    public function montaInsert(){

        // monta o insert para o bd

        $sql = new Conexao();

        $tabela = 'jogador';
        $campos = 'nickname, pass, permissao';
        $valores = "'".$this->getUsuario()."','".$this->getSenha()."', '".$this->getPermissao()."'";

        $result = $sql -> insert($tabela, $campos, $valores);

        if($result > 0){
            return 'Erro ao cadastrar!';
        }else{
            return 'Cadastro realizado com sucesso!';
        }
    }

    public function login($login, $senha){

        //efetua o login

        $sql = new Conexao();

        //verifica se o jogador existe

        $sql -> selectWhere('jogador','nickname, pass', 'nickname', $login);

        //$nick = $_SESSION['nickname'];

        foreach($sql -> resultado as $value){

            $nick = $value['nickname'];
            $senhaBD = $value['pass'];

        }

        if(strcmp($login, $nick)==0){ // verifica o login (case sensitive)

            // verifica senha
            if(password_verify($senha, $senhaBD)){

                $sql -> selectWhere('jogador','id_jogador, pontuacao, gameOver, permissao, nivel', 'nickname', $login);

                foreach($sql -> resultado as $value){

                    $pont = $value['pontuacao'];
                    $game = $value['gameOver'];
                    $per = $value['permissao'];
                    $id = $value['id_jogador'];
                    $nivel = $value['nivel'];

                    $_SESSION['permissao'] = $per;
                    $_SESSION['gameOver'] = intval($game);
                    $_SESSION['pontuacao'] = intval($pont);
                    $_SESSION['nickname'] = $nick;
                    $_SESSION['id_usuario'] = intval($id);
                    $_SESSION['nivel'] = intval($nivel);

//                    var_dump($_SESSION);
                }

                $result = 'Senha válida!';

                return $result;

            }else{
                $result = 'Senha inválida';

                return $result;
            }

        }else{
            $result = 'Usuário Inválido';

            return $result;
        }

    }
}

?>
