<?php
  
  include("pessoa.php");

  $id = $_POST['id'];
  $nome = $_POST['nome'];
  $email = $_POST['email'];
    
  $pessoa = new pessoa($id, $nome, $email);
  $pessoa->imprimir();

  define('HOST', 'localhost');
  define('USER', 'root');
  define('PASSWORD', '');
  define('DB_NAME', 'Aula');

  $banco = new PDO('mysql:host='.HOST.';dbname='.DB_NAME, USER, PASSWORD);
    
  
  if($banco){
    echo("<br> Conexão OK!");
  }


  if(isset($_POST['cadastrar'])){
    
    $nova_pessoa = array($pessoa->id, $pessoa->nome, $pessoa->email);
    $gravar = $banco->prepare("insert into pessoa (id, nome, email) values (?,?,?)");

    if($gravar->execute($nova_pessoa)){
        echo("<br> Pessoa cadastrada com sucesso!");
    }else{
        echo("<br> Erro ao cadastrar pessoa!");
    }
  }

  if(isset($_POST['consultar'])){

    $consulta = $banco->prepare("select * from pessoa");
    $consulta->execute();
    $linha = $consulta->fetchAll(PDO::FETCH_OBJ);

    foreach($linha as $pessoa){
        echo("<br>Id = ". $pessoa->id.
        "<br> Nome = ". $pessoa->nome.
        "<br> Email = ". $pessoa->email);
        echo("<br>---------------------------");
    }
  }
  
  if(isset($_POST['alterar'])){
    
    $editar = $banco->prepare("update pessoa set nome=?, email=? where id=?");
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $editar->execute(array($nome, $email, $id));
    if($editar){
        echo ("<br> Atualização feita com sucesso!");
    }else{
        echo("<br> Erro ao atualizar pessoa!");
    }

  }
  
  if(isset($_POST['remover'])){
    $id = $_POST['id'];
    $deletar = $banco->prepare("delete from pessoa where id=?");
    $deletar->execute(array($id));

    if($deletar){
        echo("<br> Pessoa excluída com sucesso!");
    }else{
        echo("<br> Erro ao excluir pessoa!");
    }
  }
?>
