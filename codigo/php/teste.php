<?php
/* esse documento cria a coneção com o seu banco de dados, sem ele a parte do php pede sua funcionalidade */
/* A ultilização de um arquivo par aser responsavel pela conecão ao banco de dados, tem alguns pontos possitivos, caso voce queira alterar o banco que esteja se conectando
ou mudou de maquina e naquela maquina especifica tenha senha,  fazer desse jeito vai  te econimizar tempo pois voce só vai  precisar alterar um unico documento */

$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "teste";
$_con = mysqli_connect($servidor, $usuario, $senha, $banco);


// se a coneção for falsa ou seja se não tiver conseguido realizar ela, vai aparecer a mensagem de erro caso se conecte não aperece nada 
    if($_con===false){
        echo "<div align='center' id='titulo'>N&atilde;oo foi poss&iacute;vel conectar ao MySQL <br>";
        }
    else {

    }