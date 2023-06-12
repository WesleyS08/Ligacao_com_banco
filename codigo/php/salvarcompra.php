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
        margin-left: 25%;
    }

    /* linha onde os elesmentos se encontram, cujo pode ser muda do ou apagado */
    .conteiner {
        width: 500px;
        background-image: url(../imagens/fundos/773.jpg);
        background-position: center;
        background-size: cover;
        border: 2px solid #fdfdfd;
        border-radius: 15px;
        align-items: flex-end;
        display: flex;
        margin-top: 2%;
        margin-left: 28%;
        display: grid;
        grid-gap: 10px;
        flex-wrap: wrap;
        flex-direction: column;
        align-content: space-around;
        justify-content: space-around;
    }

    input {
        padding: 5px;
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
    }

    .form-label {
        background-color: #9fdce7;
        border-radius: 10px;
        border: 1px solid #65b2e6;
        color: #000000;
        font-size: revert;
    }

    .form-select {
        font-size: 1.1rem;
        margin-block: 7px;
        margin-block: 7px;
        border-radius: 7px;
        width: 173px;
        border: 1px solid #3c2348;
        margin-left: 22%;
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
        margin-left: 22%;
    }
    </style>
    <?php
// Arquivo responsavel, por inserir as informaçoes de compras no banco de dados mesmo, em um ambiente academico esse codigo funciona, mas se levamos para o mundo "real", não 
// pois ao cadastrar os itens no banco de dados mesmo que compre os itens juntos acaba sendo salvo cada item com um numero de rastreio diferente, que nçao faz muito sentido mas ok 


// ligação com o banco de dados, de lei o codigo não vive sem ele
include "teste.php";


// as informaçoes dos itens selecionados não vem do formulario anterior e sim de um mais antigo, então precisamos fazer dois meios para receber as informaçoes um apenas para os itens selecionados 
if (isset($_POST['itens_selecionados'])) {
    $itensSelecionados = $_POST['itens_selecionados'];
echo '<div class="conteiner">';
  // iremos começar a ver as informaçoes para ser salvas 
    echo "<h1>Itens selecionados e quantidades:</h1><br>";

    // apenas inicinado a variavel 
    $valoritens = 0;
    $valorcomdesconto = 0;

    // para ficar bonitinho iremos usar a data e hora real (nem é pq não saberia como fazer de outra maneira )
    $Data_do_pedido = date('YmdHis');


    // Array para armazenar os IDs dos produtos selecionados, pois deixamos o usuario escolher mais de um item
    $id_produtos = array(); 


    // aqui iremos fazer um laço para podemos somar os valores do item mais facil 
    foreach ($itensSelecionados as $item) {

        // iremos buscar as informaçoes dos produtos que selecionamos. até pq iremos usar para fazer conta
        $query = "SELECT * FROM tb_produto WHERE id_produto = ?";

        // preparou para realizar a consulta no banco de dados 
        $stmt = mysqli_prepare($_con, $query);

        // passamos os paramentros, em muitos momentos voce vai ver letras sozinhas ou em conjuntos no meio do codigo, ela são responsavel por passar qual é o tipo de dado, texto, numeric e etc.
        mysqli_stmt_bind_param($stmt, "s", $item);

        // ao paçamos os parametros podemos fazer a consulta 
        mysqli_stmt_execute($stmt);

        // e atribuimos o resultado de tal, em outra variael
        $result = mysqli_stmt_get_result($stmt);

        // e associamos esse resultado a um numero exemplo voltou com um resultado de 5 itens ao infes de mostra tudo de uma unica vez, iremos mostrar na ordem
        $row = mysqli_fetch_assoc($result);

        if ($row) {
        
            $quantidade = $_POST['quantidade_' . $item] ?? '';
            $nomeItem = $row['Nome_produto'];
            $valorItem = $row['Valor_do_Produto'];
            $id_produto = $row['id_produto'];


            // ver se o item tem uma imagem vinculada a ela 
            if (!empty($row["images"])) {
                echo '<img class="imagens" src="../imagens/' . $row["id_produto"] . '/' . $row["images"] . '" alt="Imagem do Produto"><br>';
            }


            // iremos mostrar a questão dos itens selecionados e isso aqui vou ignora pois já expliquei
            echo "<h3>Item selecionado: $nomeItem</h3><br>";
            echo "<h3>Quantidade: $quantidade<br></h3>";
            echo "<h3>Valor: R$ $valorItem<br><br></h3>";


            // lembra que estamos em um laço e como queremos saber qual é o total dos itens precisamos ir somando eles de acordo com o laço
            $valorParcial = $quantidade * $valorItem;
            $valoritens += $valorParcial;

            // Armazenar o ID do produto no array
            $id_produtos[] = $id_produto;
        }
    }


    // e outro par atrabalhamos realmete com as informaçoes postadas no formuario anterior,

     // Recuperar as informações enviadas do formulário
    if (isset($_POST['finalizar_compra'])) {
    
        // aqui por não ter uma conta certa para ver a questão do frete, apenas falei para gerar um valor aleatorio de 1 a 100, então o frete da pessoa pode ser 1 reais ou 100
        $valorFrete = rand(1, 100);

        // realizamos operaçoes matematicas para salvamos os nomes certinhos (uns nome nada haver né, não seja assim coloque os nomes bonitinhos)
        $valorTotalPedido = $valoritens + $valorFrete;
        $valorDesconto = $valorTotalPedido * 0.02;
        $valorTotal = $valorFrete + $valorDesconto;


        
        $descricao = $_POST['descricao'] ?? '';
        $pagamento = $_POST['pagamento'] ?? '';
        $envio = $_POST['envio'] ?? '';
        $parcelas = $_POST['parcelas'];
        

        // mais conta matematica e
        $valortotaldospedidos =  $valorFrete + $valorTotalPedido;

        // o nosso "parcelas" está sendo tratada como um texto, e dividir um valor por texto fica foda, por isso precisamos mudar o tipo dele
        $valorr = $valortotaldospedidos / floatval($parcelas);
        $valorParcelado = $parcelas / $valortotaldospedidos;
    
        // aqui só recebemos as informaçoes mesmo, coisa simples 
        $anotacao = $_POST['anotacao'] ?? '';
        $sinal = $_POST['sinal'] ?? '';
        $Data_do_pedido = date('YmdHis');
        $clienteId = $_POST['clienteId'] ?? '';


        // toda essa parte só fala que os numeros podem ter duas casas depois da virgula, para não ficar aquela informação enorme que não usariamos
        $valorTotalPedido = number_format($valorTotalPedido, 2, '.', '');
        $valorDesconto = number_format($valorDesconto, 2, '.', '');
        $valorTotal = number_format($valorTotal, 2, '.', '');
        $valorParcelado = number_format($valorParcelado, 2, '.', '');
        $valortotaldospedidos = number_format($valortotaldospedidos, 2, '.', '');
        $valorr = number_format($valorr, 2, '.', '');



        echo "<h1>Pedido(s) inserido(s) com sucesso!</h1><br>";

        echo "<h1>Informações do Pedido:</h1><br>";

        echo "<h1>Valor do Frete: " . $valorFrete . "</h1><br>";

        // iremos fazer um outro laço para salvar as coisas no banco de dados, pois se não fizemos apenas o ultimo item sera salvo e nçao queremos isso
        foreach ($id_produtos as $id_produto) {

            // asssim como fizemos o laço pra conseguir calcular o valor total dos itens 
            $quantidade = $_POST['quantidade_' . $id_produto] ?? '';

            // Inserir os dados na tabela "TB_Pedido"
            $query = "INSERT INTO TB_Pedido (TB_Cliente_Id_cliente, TB_Produto_id_produto, Detalhes_do_pedido, DT_do_pedido, Valor_do_frete, Valor_total_dos_itens, Valor_total, Qt_itens) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($_con, $query);
        
            // aquela questão do parametro que falei antes vai se repedir muito 
            mysqli_stmt_bind_param($stmt, "isssdddd", $clienteId, $id_produto, $descricao, $Data_do_pedido, $valorFrete, $valorTotalPedido, $valortotaldospedidos, $quantidade);
            mysqli_stmt_execute($stmt);

            // Obter o ID do pedido recém-inserido
            $pedidoId = mysqli_insert_id($_con);
            $query = "INSERT INTO TB_pagamento (TB_Pedido_TB_Cliente_Id_cliente, TB_Pedido_Numero_do_pedido, Forma_de_Pagamento, Desconto, Anotacao, Sinal) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($_con, $query);
            mysqli_stmt_bind_param($stmt, "iissss", $clienteId, $pedidoId, $pagamento, $valorDesconto, $anotacao, $sinal);
            mysqli_stmt_execute($stmt);
            
            // Inserir os dados na tabela "TB_Parcelamento"
            $query = "INSERT INTO TB_Parcelamento(TB_Pagamento_id_Pagamento, QT_de_parcelas, Valor_das_parcelas) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($_con, $query);
            mysqli_stmt_bind_param($stmt, "iis", $pedidoId, $parcelas, $valorr);
            mysqli_stmt_execute($stmt);

            // Inserir os dados na tabela "TB_Entregas"
            $query = "INSERT INTO TB_Entregas(TB_Pedido_TB_Cliente_Id_cliente, TB_Pedido_Numero_do_pedido, Forma_de_envio) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($_con, $query);
            mysqli_stmt_bind_param($stmt, "iis", $clienteId, $pedidoId, $envio);
            mysqli_stmt_execute($stmt);
        }

        // Fechar a conexão com o banco de dados
        mysqli_close($_con);

        // Exibir as informações do pedido recém-inserido é uma boa forma para ver o que foi salvo
        

        // esses echos apenas mostram as informaçoes 
        echo "<h1>id(s) dos produtos: " . implode(', ', $id_produtos) . "</h1><br>";
        echo "<h1>Valor Total: R$ " . $valorTotalPedido . "</h1><br>";
        echo "<h1>Valor do Frete: R$ " . $valorFrete . "</h1><br>";
        echo "<h1>Valor do Desconto: R$ " . $valorDesconto . "</h1><br>";
        echo "<h1>Meio de pagamento: " . $pagamento . "</h1><br>";
        echo "<h1>Parcelado em: " . $parcelas . " com o valor de R$ " . $valorr . "</h1><br>";
        echo "<a href='../index.html'>";
        echo "<button type='button' class='button'>";
        echo "<span class='button__text'>Voltar</span>";
        echo "</button>";
        echo "</a>";
    echo "</div>";
    } else {
        echo "Formulário não enviado corretamente ou cliente não encontrado.";
    }
}
?>