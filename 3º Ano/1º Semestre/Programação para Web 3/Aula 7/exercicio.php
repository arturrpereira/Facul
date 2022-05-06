<?php

    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASSWORD', '');
    define('DB_NAME', 'Aula');

    $banco = new PDO('mysql:host='.HOST.';dbname='.DB_NAME, USER, PASSWORD);

    if($banco){
        echo("<br> Conexão OK!");
    }

    $id = '1';
    $nome = 'James Bond';
    $email = 'jamesbond@gmail.com';
    
    //Inserir pessoa

    $nova_pessoa = array($id, $nome, $email);
    $gravar = $banco->prepare("insert into pessoa (id, nome, email) values (?,?,?)");

    if($gravar->execute($nova_pessoa)){
        echo("<br> Pessoa cadastrada com sucesso!");
    }else{
        echo("<br> Erro ao cadastrar pessoa!");
    }

    //Consultar tabela funcionario

    $consulta = $banco->prepare("select * from pessoa");
    $consulta->execute();
    $linha = $consulta->fetchAll(PDO::FETCH_OBJ);

    foreach($linha as $pessoa){
        echo("<br>Id = ". $pessoa->id.
        "<br> Nome = ". $pessoa->nome.
        "<br> Email = ". $pessoa->email);
        echo("<br>---------------------------");
    }

    //Atualizar (editar) um funcionario
    $editar = $banco->prepare("update pessoa set nome=? and email=? where id=?");
    $nome = "Lucas Carmo";
    $email = "lucascarmo@gmail.com";

    $editar->execute(array($unidade,$nome, $id));
    if($editar){
        echo ("<br> Atualização feita com sucesso!");
    }else{
        echo("<br> Erro ao atualizar pessoa!");
    }

    //Excluir funcionario
    $nome = "James Bond";
    $deletar = $banco->prepare("delete from pessoa where nome=?");
    $deletar->execute(array($nome));

    if($deletar){
        echo("<br> Pessoa excluída com sucesso!");
    }else{
        echo("<br> Erro ao excluir pessoa!");
    }


    $banco = null;

?>
