<?php
$local = 'localhost';  //local do banco de dados
$banco = 'telatv'; //nome do banco de dados
$usuario = 'root'; //usuario padrão do banco de dados
$senha = ''; //senha do banco de dados

try {
    $conexao = new PDO ("mysql:host=$local;dbname=$banco", $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "Não deu certo!" . $e->getMessage();
}
?>