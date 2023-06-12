<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selecionar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


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
        img {
        height: 200px;
        width: 200px;
        border-radius: 50%;
        border: 1px solid white;
        margin-left: 25%;
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

</style>
<?php
include "teste.php";

    // Queremos puxar todos os produtos para que o cliente/ usuário possa escolher aquele que ele deseja.
    $query = "SELECT * FROM tb_produto";

    // Verificamos a conexão com o banco de dados
    $result = mysqli_query($_con, $query);

    echo '<form action="../php/deletarprodutos2.php" method="post">'; 

    if ($result && mysqli_num_rows($result) > 0) {

        // Texto para ficar bonito
        echo '<label for="itens">Selecione o item que deseja deletar:</label>';
        echo '<br><br><br>';

        echo '<table>'; // Início da tabela

        while ($row = mysqli_fetch_assoc($result)) {
            $nomeItem = $row['Nome_produto'];
            $valorItem = $row['Valor_do_Produto'];
            $imagesItem = $row['images'];
            $id_produto = $row['id_produto'];

            echo '<tr>';

            echo '<td>' . $nomeItem . '</td>';

            if (!empty($row["images"])) {
                echo '<td><input type="radio" name="itens_selecionados[]" value="' . $row["id_produto"] . '" onchange="updateQuantidade(this)"><img class="imagens" src="../imagens/' . $row["id_produto"] . '/' . $row["images"] . '" alt="Imagem do Produto"></td>';
            // novamente o campo do tipo radio para que só possa ser selecionado um produto
            }

            echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Valor: R$ " . $valorItem . "</td>";
            echo '<br>';

            // Incluir um campo hidden para enviar o valor do produto selecionado
            echo '<input type="hidden" name="produto_selecionado" value="' . $id_produto . '">';
        }

        echo '</table>'; // Fim da tabela

        // Botão para enviar o formulário
        echo '<br>';

        echo '<button type="submit" name="finalizar_compra" class="btn btn-primary"> deletar </button>';
        echo "<a href='../index.html'>";
        echo "<button type='button' class='button'>";
        echo "<span class='button__text'>Voltar</span>";
        echo "</button>";
        echo "</a>";
        } else {
            echo "Nenhum produto encontrado.";
        }

        echo '</form>';
?>
