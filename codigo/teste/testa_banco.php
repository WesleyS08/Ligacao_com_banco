<?php

$servidor = "localhost";
$usuario = "root";
$senha = ""; // Deixe vazio se não tiver senha definida para o usuário root
$banco = "bd_empresa";

$_con = mysqli_connect($servidor, $usuario, $senha, $banco);

if (!$_con) {
    die("Falha na conexão: " . mysqli_connect_error());
}

echo "Conexão estabelecida com sucesso.";
?>