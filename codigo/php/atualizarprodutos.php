<!DOCTYPE html>
<html>

<head>
    <title>itens</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <style>
    * {
        padding: 0;
        margin: 0;

    }

    body {
        font-family: 'Roboto', sans-serif;
        font-weight: 400;
        font-style: normal;
        color: #d1d0cf;
        background: #202124;
    }

    button {
        position: relative;
        background-color: rgb(230, 34, 77);
        border-radius: 5px;
        box-shadow: rgb(121, 18, 55) 0px 4px 0px 0px;
        background-repeat: no-repeat;
        box-sizing: border-box;
        width: 96px;
        height: 24px;
        color: #fff;
        border: none;
        margin-left: 35%;
        font-size: 20px;
        transition: all .3s ease-in-out;
        z-index: 1;
        overflow: hidden;
    }

    button::before {
        content: "";
        background-color: rgb(248, 50, 93);
        width: 0;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        z-index: -1;
        transition: width 700ms ease-in-out;
        display: inline-block;
    }

    button:hover::before {
        width: 100%;
    }

    .btn {

        background-color: #868991;
        scale: 1rem;
    }

    .btn-primary:houver {
        scale: 1.2rem;
    }

    img {
        height: 200px;
        width: 200px;
        border-radius: 50%;
        border: 1px solid white;
    }
    </style>
</head>
<?php
include "teste.php";

// Queremos puxar todos os produtos para que o cliente/usuário possa escolher aquele que ele deseja.
$query = "SELECT * FROM tb_produto";

// Verificamos a conexão com o banco de dados
$result = mysqli_query($_con, $query);

 // o formulario inicia tão "cedo", pois como há um laço para exibir todos os produtos se colocamos ele embaixo ele não vai pegar todas as informaçoes 
echo '<form action="../php/atualizarprodutos2.php" method="post">';


// aqui só inicia se tiver algum produto, ele recebou as informaçoes do banco de dados e conta quantos resultados tem, se for mais de 0 ele inicia
if ($result && mysqli_num_rows($result) > 0) {


    // Texto para ficar bonito e falando o que o usuario deve fazer 
    echo '<label for="itens">Selecione o item que deseja atualizar:</label>';
    echo '<br><br><br>';

    echo '<table>'; // Início da tabela


    // e falamos para exibir as informaçoes dos itens até o row ser igual a quantidade de resultados que retonou da pesquisa 
    while ($row = mysqli_fetch_assoc($result)) {
        $nomeItem = $row['Nome_produto'];
        $valorItem = $row['Valor_do_Produto'];
        $imagesItem = $row['images'];
        $id_produto = $row['id_produto'];

        echo '<tr>';

        echo '<td>' . $nomeItem . '</td>';

        if (!empty($row["images"])) {
            echo '<td><input type="radio" name="produto_selecionado" value="' . $id_produto . '" onchange="updateQuantidade(this)"><img class="imagens" src="../imagens/' . $row["id_produto"] . '/' . $row["images"] . '" alt="Imagem do Produto"></td>';
            // colocamos o tipo radio para que o usuario só possa escolher um item por vez
        }

        echo "<td> R$ " . $valorItem . "</td>";
        echo '<br>';

        echo '</tr>';
    }

    echo '</table>'; // Fim da tabela

    // Incluir campos hidden para enviar o valor e as outra informaçoes  do produto selecionado
    echo '<input type="hidden" name="nome_produto" value="' . $nomeItem . '">';
    echo '<input type="hidden" name="valor_produto" value="' . $valorItem . '">';
    echo '<input type="hidden" name="imagem_produto" value="' . $imagesItem . '">';

    // Botão para enviar o formulário
    echo '<br>';
    echo '<button type="submit" class="btn btn-primary">Atualizar</button>';

    

echo '<br><br><br><br>';
}

echo '</form>';

echo '<form action="../php/pedidos.php">';
echo '<button type="submit" class="button">';
echo '<span class="button__text">Voltar</span>';
echo '</button>';
echo '</form>';


// se não tiver itens no banco de dados apensa dar essa mensagem
if (mysqli_num_rows($result) == 0) {
    echo "Nenhum produto encontrado.";
}
?>