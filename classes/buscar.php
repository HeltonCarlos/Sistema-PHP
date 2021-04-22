<?php

class usuario{

 public function __construct($banco,$host,$user,$pass)
 {
    try{
        $pdo =new PDO("mysql:dbname=".$banco.";local=".$host,$user,$pass);
    }
    catch(PDOException $e){
        echo "Erro no banco de dados!".$e->getMessage();}
        catch(Exception $e){
        echo "Erros Genéricos!".$e->getMessage();}
 }


 public function cadastrar($nome,$email,$senha){
        $cmd=$this->pdo->prepare("SELECT id FROM usuarios where email=:e");
        $cmd->bindValue($email,":e");
        $cmd->execute();
        if($cmd->rowCount()>0){
            return false;
        }else{
            $cmd=$this->pdo->prepare("INSERT INTO usuario(nome,email,senha)values(:n,:e,:s)");
            $cmd->bindValue($nome,":n");
            $cmd->bindValue($email,":e");
            $cmd->bindValue($senha,":s");
            $cmd->execute();
            return true;
        }
 }

}


?>