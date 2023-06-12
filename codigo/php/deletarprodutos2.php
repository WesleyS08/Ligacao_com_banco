<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente</title>
    <style>
    /* Importação de fontes para ser usado no projeto */
    /* Esses são elementros que pegam em todo o html, ou seja elementos globais*/
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap');

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

    /*=======================================================================================================================*/
    /*Estilos dos btn, apenas muda a questão visual, a funcionalidade permanece a mesma  */
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

    h1 {
        background-color: #9fdce7;
        border-radius: 10px;
        border: 1px solid #65b2e6;
        text-align: center;
        font-size: 1.2rem;
        margin-left: 0%;
        color: #000;
    }

    h3 {
        color: #000;
        text-align: center;
        background-color: white;
        border-radius: 15px;
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

// iremos ver se o item selecionado para ser excluido foi enviado de maneira certa 
if (isset($_POST['itens_selecionados'])) {
    $itensSelecionados = $_POST['itens_selecionados'];

       // Iterar sobre os itens selecionados
    foreach ($itensSelecionados as $itemSelecionado) {
        // Consultar o banco de dados para obter as informações do item selecionado
        $query = "SELECT * FROM tb_produto WHERE id_produto = " . $itemSelecionado;
        $result = mysqli_query($_con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            // Obter os dados do item selecionado
            $row = mysqli_fetch_assoc($result);
            $idProduto = $row['id_produto'];
            $nomeItem = $row['Nome_produto'];
            $valorItem = $row['Valor_do_Produto'];
            $imagesItem = $row['images'];

            // Remover o item do banco de dados
            $queryExclusao = "DELETE FROM tb_produto WHERE id_produto = " . $idProduto;
            $resultExclusao = mysqli_query($_con, $queryExclusao);

            if ($resultExclusao) {
                // Remover as imagens relacionadas ao item
                $caminhoPastaImagens = "../imagens/" . $idProduto;
                if (is_dir($caminhoPastaImagens)) {
                    $files = glob($caminhoPastaImagens . '/*');

                    foreach ($files as $file) {
                        if (is_file($file)) {
                            unlink($file); // serve para apager o arquivo 
                        } elseif (is_dir($file)) {
                            rmdir($file); // esse apaga a pasta 
                        }
                    }

                    rmdir($caminhoPastaImagens);
                }
            }

            echo "<h1>Produto e pasta de imagens excluídos com sucesso.</h1><br><br><br><br>";
            echo "<a href='../index.html'>";
            echo "<button type='button' class='button'>";
            echo "<span class='button__text'>Voltar</span>";
            echo "</button>";
            echo "</a>";
        } else {
            echo "Erro ao excluir o produto.";
        }
    } 
}

?>
