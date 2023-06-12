<html>
<head>
<title>Cliente</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<body >

<?php

// exemplo de inserção de dados em uma tabela de um banco de dados

include "testa_banco.php";


$id = $_POST['id'];
$nome = $_POST['Nome'];
$telefone = $_POST['telefone'];
$celular = $_POST['celular'];
$email = $_POST['email'];
$endereco = $_POST['endereco'];
$CEP= $_POST['CEP'];
$TipoServico_Produto = $_POST['TipoServico_Produto'];

$sql = 'INSERT INTO tb_cliente (id, nome, telefone, celular, email, endereco, CEP, TipoServico_Produto) VALUES (\'' .$id. '\', \'' .$nome. '\', \'' .$telefone. '\', \'' .$celular. '\', \'' .$email. '\', \'' .$endereco. '\', \'' .$CEP. '\', \'' .$TipoServico_Produto. '\')';

 echo $sql;

?>

</body>
</html>