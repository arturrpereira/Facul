<?php

  Class Pessoa{
  
    public $id;
    public $nome;
    public $email;

    public function __construct($id, $nome, $email) {
      $this->id = $id;
      $this->nome = $nome;
      $this->email = $email;
    }

    public function imprimir() {
      echo "******** PESSOA CADASTRADA COM SUCESSO ******** <br>";
      echo("Id: ".$this->id)."<br>";
      echo("Nome: ".$this->nome)."<br>";
      echo("Email: ". $this->email)."<br>";
    }
  }
?>
