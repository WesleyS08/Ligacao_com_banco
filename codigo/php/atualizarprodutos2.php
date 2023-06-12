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
        margin-left: 35%;

    }

    .form {
        margin-top: 30px;
        margin-left: 22%;
        padding: 5px;
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        justify-content: flex-start;
        align-items: center;
        margin-left: 35%;
    }

    label {
        background-color: #9fdce7;
        border-radius: 10px;
        border: 1px solid #65b2e6;
        color: #000000;
        font-size: revert;
        margin-left: 35%;
        margin-top: 7%;
    }

    h1 {
        margin-bottom: 3%;
        margin-left: 25%;
    }


    .form-control {
        border-radius: 4px;
        margin-block: 4px;
        border: 1px solid #3c2348;
        align-items: center;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-content: center;
        flex-wrap: nowrap;
        margin-left: 35%;

    }
    </style>
</head>
<?php

include "teste.php";

// precisamos ver se o item selecionado foi enviado de maneira certa  caso tenha sido iremos para essa parte 
if (isset($_POST['produto_selecionado'])) {

    // atribuimos o produto selecionado anteriomente em uma variavel local, apenas para ficar mais facil 
    $itemSelecionado = $_POST['produto_selecionado'];


    // buscamos as informaçoes do produto selecionado, pois até então só possuimos o id dele 
    $query = "SELECT * FROM tb_produto WHERE id_produto = " . $itemSelecionado;
    $result = mysqli_query($_con, $query);

    if ($result && mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);
        $idProduto = $row['id_produto'];
        $nomeProduto = $row['Nome_produto'];
        $valorProduto = $row['Valor_do_Produto'];
        $imagemProduto = $row['images'];

        $novoNomeProduto = $nomeProduto; // Inicializar a variável com o valor atual
        $novoValorProduto = $valorProduto; // Inicializar a variável com o valor atual
        $nomeImagem = $imagemProduto; // Inicializar a variável com o valor atual

        // Atualizar o produto no banco de dados
        if (isset($_POST["produto"]) && isset($_POST["valor"])) {
            $novoNomeProduto = $_POST["produto"];
            $novoValorProduto = $_POST["valor"];
        

            // Verificar se uma nova imagem foi enviada
            if (isset($_FILES["img"]) && $_FILES["img"]["error"] === UPLOAD_ERR_OK) {
                $imagemTemporaria = $_FILES["img"]["tmp_name"];
        
                $caminhoDestino = "../imagens/" . $itemSelecionado . "/";

                // Verificar se o diretório existe, caso contrário, criá-lo pois o usuario pode adicionar um item sem a imagem inicialmente e apos isso mudar para colocar uma imagem 
                if (!is_dir($caminhoDestino)) {
                    mkdir($caminhoDestino, 0777, true);
                }

                // Mover a nova imagem para o diretório de destino
                $caminhoNovaImagem = $caminhoDestino . $nomeImagem;
                if (move_uploaded_file($imagemTemporaria, $caminhoNovaImagem)) {

                    $currentDateTime = date('YmdHis');
                
                    // Atualizar o nome da imagem no banco de dados com a data e hora que aconteceu a atualização 
                    $query = "UPDATE tb_produto SET Nome_produto = '$novoNomeProduto', Valor_do_Produto = '$novoValorProduto', images = '$currentDateTime' WHERE id_produto = $idProduto";
                    $updateResult = mysqli_query($_con, $query);

                    if ($updateResult) {
                        // Produto atualizado com sucesso
                    } else {
                        echo "Erro ao atualizar o produto.";
                    }
                } else {
                    echo "Erro ao mover a nova imagem.";
                    exit;
                }
            } else {
                // Não foi enviada uma nova imagem, apenas atualizar nome e valor no banco de dados
                $query = "UPDATE tb_produto SET Nome_produto = '$novoNomeProduto', Valor_do_Produto = '$novoValorProduto' WHERE id_produto = $idProduto";
                $updateResult = mysqli_query($_con, $query);

                if ($updateResult) {
                    // Produto atualizado com sucesso
                } else {
                    echo "Erro ao atualizar o produto.";
                }
            }
        }
    } else {
        echo "Erro: Produto não encontrado.";
    }
} else {
    // O campo "produto_selecionado" não foi enviado
    echo "Erro: Produto não selecionado.";
}
?>

<h1>Atualização de produtos</h1>
<form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="produto_selecionado" value="<?php echo $itemSelecionado; ?>">
    <div class="mb-3">
        <label for="produto" class="form-label">Nome do produto</label>
        <input type="text" class="form-control" id="produto" name="produto"
            value="<?php echo isset($novoNomeProduto) ? $novoNomeProduto : $nomeProduto; ?>">
    </div>
    <div class="mb-3">
        <label for="valor" class="form-label">Valor do produto</label>
        <input type="text" class="form-control" id="valor" name="valor"
            value="<?php echo isset($novoValorProduto) ? $novoValorProduto : $valorProduto; ?>">
    </div>
    <div class="mb-3">
        <label for="img" class="form-label">Selecione a imagem do produto</label>
        <input class="form-control" type="file" id="img" name="img">
    
        <?php
        if (isset($nomeImagem)) {
            echo '<img src="../imagens/' . $itemSelecionado . '/' . $nomeImagem . '" alt="Imagem do Produto">';
        } elseif (isset($imagemProduto)) {
            echo '<img src="../imagens/' . $itemSelecionado . '/' . $imagemProduto . '" alt="Imagem do Produto">';
        }
        ?>
    </div>
    <br><br><br><br>
    <button type="submit" class="btn btn-primary">Atualizar</button>
</form>
<br><br><br><br><br>
<a href="/codigo/">
    <button class="Btn">Voltar
        <svg class="svg" viewBox="0 0 512 512">
            <path
                d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z">
            </path>
        </svg>
    </button>
</a>