<?php
/*  para não ficar precisando criar a coneção com o banco de dados iremos chamar, aquele arquivo que fizemos a coneção*/
include "teste.php";

// estou atribuindo os valores que se encontram no banco de dados nessa variavel query, alem de já esta realiando um LEFT JOIN para chamar todos os outros campos que estão nas demais tabelas,
//nesse caso na tb_contado e a tb_enreco pois colocamos as informaçoes como de multivalores 
$query = "SELECT c.cliente, co.telefone, co.celular, co.email, e.endereco
            FROM tb_cliente c
            LEFT JOIN tb_contato co ON c.id_cliente = co.TB_Cliente_Id_cliente
            LEFT JOIN tb_endereco e ON c.id_cliente = e.TB_Cliente_Id_cliente";
// Ao usamos o "LEFT JOIN" iremos trazer todas as informaçoes daquele cliente, mesmo que em alguma tabela não tenha uma corespontecia,
// mas como em grande parte do formulario, colocamos que os input deveriam ser penchidos, não há muitos campos vazios


// aquilo de sempre, testa a coneção se tudo tiver ok se embora continuar 
$result = mysqli_query($_con, $query);


if (!$result) {
    echo "Erro na consulta: " . mysqli_error($_con); // caso tenha algum problema na coneção ele nem continua, pois como tudo na programação se resumo em 0 e 1
    exit;
}

$clientes = array(); // criei uma variavel chamada $cliente e falei que ela é um array, isso se torna necessario pois estamos mostrando os clientes em uma lista e como é uma lista ela automaticamnte vai ter mais de uma posição


// como não sabemos quantos cliente tem no banco de dados precisamos fazer um laço de repção para que possamos mostra todos aqueles disponivel
while ($row = mysqli_fetch_assoc($result)) {

    $clientes[] = $row; // E falei que o cliente é que nem a posição que o usuario selecionar

}
?>
<!--=====================================================Inicio do conteudo HTML==========================================  -->
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

    table {
        border-collapse: collapse;
        width: 100%;
    }

    td {
        background-color: #ffffff;
        border-radius: 14px;
        color: #000000;
    }


    th {
        background-color: #8c38dd;
        color: white;
        border-radius: 14px;
        padding: 4px;
    }


    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .floating-menu ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .floating-menu ul li {
        margin-bottom: 5px;
        cursor: pointer;
        color: #000;
    }

    .floating-menu h3 {
        margin: 0 0 10px;
        font-size: 16px;
        color: #000;
    }

    .floating-menu-toggle {
        position: fixed;
        top: 10px;
        right: 10px;
        padding: 5px;
        background-color: #ccc;
        color: #fff;
        border: none;
        cursor: pointer;
    }


    /* Estilos do menu flutuante */
    .floating-menu {
        position: fixed;
        top: 20px;
        right: 20px;
        background-color: #fff;
        border: 1px solid #a624db;
        padding: 10px;
        border-radius: 15px;
        max-height: 200px;
        overflow-y: auto;
    }

    h1 {
        font-size: 3.2rem;
        color: #ffffff;
        margin-left: 26%;
    }

    h2 {
        margin-top: 34px;
    }

    label {
        display: inline-block;
        margin-left: 27%;
    }

    #cliente_digitado {
        padding: 2px;
        font-family: inherit;
        font-size: inherit;
        border-radius: 8px;
        line-height: inherit;
        border-color: #823e91;
    }

    .menu2 {
        margin-top: 27px;
        margin-left: -9px;
    }

    .busca {
        color: #060606;
        background-color: white;
        border-radius: 5px;
        height: 32px;
        width: 65px;
        border: 2px solid #823e91;
    }

    .busar:hover {
        background-color: red;
    }

    .btns_de_navegação {
        display: flex;
        flex-direction: row;
        align-content: space-between;
        justify-content: space-evenly;
        align-items: flex-end;
        margin-top: 28px;
    }


    /* button click effect*/
    .atualizar-button:active {
        transform: translate(2px, 2px);
    }


    .Btn {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        width: 45px;
        height: 45px;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        transition-duration: .3s;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.199);
        background-color: #f10d4f;
        border: 1px solid #fff;
    }

    /* plus sign */
    .sign {
        width: 100%;
        transition-duration: .3s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .sign svg {
        width: 17px;
    }

    .sign svg path {
        fill: white;
    }

    .Btn:hover .sign {
        width: 110%;
        transition-duration: .3s;

    }




    .top {
        width: 45px;
        height: 45px;
        background: linear-gradient(#b844ea, #29d2e3);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        cursor: pointer;
        position: relative;
        border: none;
    }

    .arrow path {
        fill: white;
    }

    .text {
        font-size: 0.7em;
        width: 100px;
        position: absolute;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        bottom: -36px;
        opacity: 0;
        transition-duration: .7s;
    }

    .top:hover .text {
        opacity: 1;
        transition-duration: .7s;
    }

    .top:hover .arrow {
        animation: slide-in-bottom .7s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
    }

    @keyframes slide-in-bottom {
        0% {
            transform: translateY(10px);
            opacity: 0;
        }

        100% {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .noselect {
        width: 150px;
        height: 50px;
        cursor: pointer;
        display: flex;
        align-items: center;
        background: red;
        border: none;
        border-radius: 5px;
        box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.15);
        background: #e62222;
    }

    .noselect,
    button span {
        transition: 200ms;
    }

    .noselect .texto {

        color: white;
        font-weight: bold;
    }

    .noselect .icon {
        position: absolute;

        transform: translateX(110px);
        height: 40px;
        width: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .noselect svg {
        width: 15px;
        fill: #eee;
    }

    .noselect:hover {
        background: #ff3636;
    }

    .noselect:hover .texto {
        color: transparent;
    }

    .noselect:hover .icon {
        width: 150px;
        border-left: none;
        transform: translateX(0);
    }

    .noselect:focus {
        outline: none;
    }

    .noselect:active .icon svg {
        transform: scale(0.8);
    }

    .Comprar {
        width: 180px;
        height: 40px;
        background-image: linear-gradient(rgb(11 247 229), rgb(116 32 197));
        border: none;
        border-radius: 50px;
        color: rgb(255, 255, 255);
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        cursor: pointer;
        box-shadow: 1px 3px 0px rgb(139, 113, 255);
        transition-duration: .3s;
    }

    .cartIcon {
        width: 14px;
        height: fit-content;
    }

    .cartIcon path {
        fill: white;
    }

    .Comprar:active {
        transform: translate(2px, 0px);
        box-shadow: 0px 1px 0px rgb(139, 113, 255);
        padding-bottom: 1px;
    }

    .editar {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        width: 115px;
        height: 40px;
        border: none;
        padding: 0px 20px;
        background-color: rgb(168, 38, 255);
        color: white;
        font-weight: 500;
        cursor: pointer;
        border-radius: 10px;
        box-shadow: 5px 5px 0px rgb(140, 32, 212);
        transition-duration: .3s;
    }

    .svg {
        width: 13px;
        position: absolute;
        right: 0;
        margin-right: 15px;
        fill: white;
        transition-duration: .3s;
    }

    .editar:hover {
        color: transparent;
    }

    .editar:hover svg {
        right: 43%;
        margin: 0;
        padding: 0;
        border: none;
        transition-duration: .3s;
    }

    .editar:active {
        transform: translate(3px, 3px);
        transition-duration: .3s;
        box-shadow: 2px 2px 0px rgb(140, 32, 212);
    }

    .links {
        display: flex;
        flex-direction: row;
        margin-top: 22px;
        flex-wrap: nowrap;
        justify-content: space-evenly;
        align-items: center;
    }

    th,
    td {
        border: 3px solid #020000;
        border-radius: 15px;
        text-align: center;
        padding: 8px;
    }
    </style>


    <!--Para que ocorra a sugestão dos usuarios conforme o usuario precisamos importar dois script, poderiamos escrever eles tambem, mas não tem necessidade disso, então bora pelo mais facil-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Para realizamos isso precisamos desses dois scripts aqui -->
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <script>
    // Aqui inicia a criação da função para que ocorra o autocomplemento do codigo
    $(document).ready(function() {

        // Configura o autocompletar no campo de entrada
        // esse #cliente_digitado é a variavel que colocamos no campo input onde o usuario vai digitar, assim como fizemos na validação do cliente no outro documento

        $("#cliente_digitado").autocomplete({
            source: function(request, response) {
                // Envie uma solicitação AJAX para obter as sugestões do servidor
                $.ajax({
                    url: "buscar_clientes.php", // esse é o documento que reamente vai listar as coisas que tem no banco de dados, recomento dar uma olhada depois 
                    method: "POST", // O meio que enviaremos as informaçoes para esse documeto
                    dataType: "json", // e o tipo dele
                    data: {
                        term: request.term
                    },
                    success: function(
                        data
                    ) { // caso o envio seja um sucesso, automaticamente vai iniciar uma nova função
                        response(data); // Atualiza as sugestões com os dados recebidos
                    }
                });
            },

            minLength: 2, // Essa linha apenas fala depois de quantos caractes, que deve ocorer a sugestão dos cliente que nesse caso é apenas dois
            select: function(event, ui) {
                $("#cliente_digitado").val(ui.item.value);
                return false;
            }
        });

        // Atualizar campo de entrada com o valor selecionado do menu suspenso
        $(document).on("click", ".floating-menu li", function() {
            var selectedValue = $(this).attr("data-value");

            //a criação da variavel do intem selecionado, junto com a atribuição que ele recebe quando o usuario digita algum nome
            $("#cliente_digitado").val(selectedValue);

            // Para não ocorrer uma bugada na hora de mostrar as informaçoes, com dois buscadores diferentes, usaremos apenas um e mudaremos o valor que ele está recebedo
            $(".floating-menu").removeClass("show");
        });
    });
    </script>

</head>

<body>
    <section id="pagina" class="pagina">
        <div class="container">
            <!--Quando se trabalhamos com um formulario,  muitas vezes colocamos um container para facilitar questoes como posiçao e etc (pelo menos eu faço assim né)  -->

            <h1>Selecionar Cliente</h1>

            <form action="../PHP/pedidos.php" method="POST">

                <!-- informaçoes basicas, para onde iremos enviar esse formulario e o metedo que usaremos para fazer isso-->

                <label for="cliente">Nome do Cliente:</label><!-- nome que está do lado do campo input no navegador-->

                <input type="text" id="cliente_digitado" name="cliente_digitado" placeholder="Digite o nome do cliente"
                    value="<?php echo isset($_POST['cliente_digitado']) ? $_POST['cliente_digitado'] : ''; ?>">

                <!-- Aqui termos alguns pontos inportantes, o type que é responsavel por dizer qual é o tipo de input  o nome e o id do campo que nesse caso é o cliente_digitado
                cujo usamos essa variavel lá em cima, alem que estoamos ao mesmo tempo atribuindo valores que vem do banco de dados atraves do post  -->

                <input type="submit" class="busca" value="Buscar">
            </form>
    </section>
    <!--titulo para melhor visualiçao dos elementos -->
    <h2>Informações do Cliente:</h2>

    <!-- falamos que vai ser uma tabela -->

    <form action="../PHP/final.php" method="POST">
        <!-- Início do PHP que faz a busca no banco de dados e exibe os valores -->
        <?php

            // Essa variavel cliente_digitado iremos usar muito, pois passamos essa informação na hora de comprar ou consultar os pedidos que aquela pessoa tem, alem das demais possibilidades, mas aquestão desse if mais especifico é que usamos a variavel cliente_digitado para buscar as informaçoes no banco de dados, e sem esse if automaticamente vai bugar o codigo pois estamos buscando uma variavel que não foi definida ainda  
            if (isset($_POST['cliente_digitado'])) {

                // Verifica se algo foi digitado para iniciar a busca
                $cliente_digitado = mysqli_escape_string($_con, $_POST['cliente_digitado']);


                // Consulta para obter as informações do cliente
                $query = "SELECT c.cliente, co.telefone, co.celular, co.email, e.endereco, e.CEP
                FROM tb_cliente c
                LEFT JOIN tb_contato co ON c.id_cliente = co.TB_Cliente_Id_cliente
                LEFT JOIN tb_endereco e ON c.id_cliente = e.TB_Cliente_Id_cliente 
                WHERE c.cliente LIKE '$cliente_digitado%'";

                $result = mysqli_query($_con, $query);

                //caso ocorra erro na cunsulta 
                if (!$result) {
                    echo "Erro na consulta: " . mysqli_error($_con);
                    exit;
                }

                // caso a culsta volte com alguma informação iremos listar ela
                if ($result->num_rows > 0) {
                    echo "<table>";
                    echo "<tr>
                    <th>Cliente</th>
                    <th>Telefone</th>
                    <th>Celular</th>
                    <th>Email</th>
                    <th>Endereço</th>
                    <th>CEP</th>
                    </tr>";

                    // e commo estamos buscando nomes e não uma chave pk possa ser que tenha mais de um valor e por isso acabamos fazendo tantos laços de reptiçao
                    while ($cliente = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . (isset($cliente['cliente']) ? $cliente['cliente'] : '') . "</td>";
                        echo "<td>" . (isset($cliente['telefone']) ? $cliente['telefone'] : '') . "</td>";
                        echo "<td>" . (isset($cliente['celular']) ? $cliente['celular'] : '') . "</td>";
                        echo "<td>" . (isset($cliente['email']) ? $cliente['email'] : '') . "</td>";
                        echo "<td>" . (isset($cliente['endereco']) ? $cliente['endereco'] : '') . "</td>";
                        echo "<td>" . (isset($cliente['CEP']) ? $cliente['CEP'] : '') . "</td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                } else {
                    echo "Nenhum cliente encontrado.";
                }
            }
        ?>

        <?php
            if (isset($_POST['cliente_digitado'])) {
                    // aqui é complicado, mas pra resumir pegamos todas essas informaçoes e iremos fazer um left join para pegamos o id do cliente com base no que o cliente digiidou e apos isso que vem a parte legal, pois essa chave se torna uma fk em uma tabela, que vai se tornar outro valor/nome que precisamos ir associando 
                    $query = "SELECT
                    p.Numero_do_pedido,
                    p.TB_Produto_id_produto,
                    p.Qt_itens,
                    pr.Valor_do_Produto,
                    p.Valor_total,
                    p.Valor_total_dos_itens,
                    p.Valor_do_frete,
                    p.DT_do_pedido,
                    pag.Forma_de_Pagamento,
                    p.Detalhes_do_pedido,
                    e.Forma_de_envio,
                    parc.QT_de_parcelas,
                    parc.Valor_das_parcelas
                FROM
                    TB_Pedido p
                    LEFT JOIN TB_Produto pr ON p.TB_Produto_id_produto = pr.id_produto
                    LEFT JOIN TB_Cliente c ON p.TB_Cliente_Id_cliente = c.Id_cliente
                    LEFT JOIN TB_Pagamento pag ON p.TB_Cliente_Id_cliente = pag.TB_Pedido_TB_Cliente_Id_cliente
                        AND p.Numero_do_pedido = pag.TB_Pedido_Numero_do_pedido
                    LEFT JOIN TB_Entregas e ON p.TB_Cliente_Id_cliente = e.TB_Pedido_TB_Cliente_Id_cliente
                        AND p.Numero_do_pedido = e.TB_Pedido_Numero_do_pedido
                    LEFT JOIN TB_Parcelamento parc ON pag.id_Pagamento = parc.TB_Pagamento_id_Pagamento
                WHERE
                    c.Cliente LIKE '$cliente_digitado%'";


                // adivinha só ? realiza a pesquisa de todas essas informaçoes que acabos de associar
                $result = mysqli_query($_con, $query);

                // esperamos que não ter erro mas caso ocorra um podemos mostra qual é o erro 
                if (!$result) {
                    echo "Erro na consulta: " . mysqli_error($_con);
                    exit;
                }

                // e verificams se aquele cliente tem alguma compra caso tenha vai ser mostrado e não tiver nem vai aparecer a tabela
                if ($result->num_rows > 0) {
                    echo ' <h2>Compras já realizadas:</h2>';
                    echo "<table class='menu2'>";
                    echo "<tr>
                    <th>Número do Pedido</th>
                    <th>ID do Produto</th>
                    <th>Quantidade de Itens</th>
                    <th>Valor do Produto</th>
                    <th>Valor Total</th>
                    <th>Valor do Frete</th>
                    <th>Data do Pedido</th>
                    <th>Forma de Pagamento</th>
                    <th>Detalhes do Pedido</th>
                    <th>Forma de Envio</th>
                    <th>Quantidade de Parcelas</th>
                    <th>Valor das Parcelas</th>
                </tr>";
                }
                // e como o cara pode comprar mais de um item por vez, entramos mais uma vez no laço 

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>" . $row["Numero_do_pedido"] . "</td>
                    <td>" . $row["TB_Produto_id_produto"] . "</td>
                    <td>" . $row["Qt_itens"] . "</td>
                    <td>" . $row["Valor_do_Produto"] . "</td>
                    <td>" . $row["Valor_total"] . "</td>
                    <td>" . $row["Valor_do_frete"] . "</td>
                    <td>" . $row["DT_do_pedido"] . "</td>
                    <td>" . $row["Forma_de_Pagamento"] . "</td>
                    <td>" . $row["Detalhes_do_pedido"] . "</td>
                    <td>" . $row["Forma_de_envio"] . "</td>
                    <td>" . $row["QT_de_parcelas"] . "</td>
                    <td>" . $row["Valor_das_parcelas"] . "</td>
                </tr>";
                }

                echo "</table>";



                    ?>
                </form>
                    <?php
                    while ($cliente = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . (isset($cliente['cliente']) ? $cliente['cliente'] : '') . "</td>";
                echo "<td>" . (isset($cliente['telefone']) ? $cliente['telefone'] : '') . "</td>";
                echo "<td>" . (isset($cliente['celular']) ? $cliente['celular'] : '') . "</td>";
                echo "<td>" . (isset($cliente['email']) ? $cliente['email'] : '') . "</td>";
                echo "<td>" . (isset($cliente['endereco']) ? $cliente['endereco'] : '') . "</td>";
                echo "<td>" . (isset($cliente['CEP']) ? $cliente['CEP'] : '') . "</td>";
                echo "</tr>";
                    }
                    ?>
                    <div class="links">
            <form action="../PHP/atualizar.php" method="POST">
                <input type="hidden" name="cliente_digitado"
                    value="<?php echo isset($_POST['cliente_digitado']) ? $_POST['cliente_digitado'] : ''; ?>">
                <button class="editar">Editar cliente
                    <svg class="svg" viewBox="0 0 512 512">
                        <path
                            d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z">
                        </path>
                    </svg>
                </button>
            </form>

            <form action="../PHP/deletarcliente.php" method="POST">
                <input type="hidden" name="cliente_digitado"
                    value="<?php echo isset($_POST['cliente_digitado']) ? $_POST['cliente_digitado'] : ''; ?>">
                <button class="noselect">
                    <span class="texto">Deletar Cliente</span><span class="icon"><svg xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z">
                            </path>
                        </svg></span></button>
            </form>

            <form action="../PHP/final.php" method="POST">
                <input type="hidden" name="cliente_digitado"
                    value="<?php echo isset($_POST['cliente_digitado']) ? $_POST['cliente_digitado'] : ''; ?>">
                <button class="Comprar">
                    Realizar Compras
                    <svg class="cartIcon" viewBox="0 0 576 512">
                        <path
                            d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z">
                        </path>
                    </svg>
                </button>
            </form>
        </div>
                    <?php
        } else{
            // caso não tenha sido selecionado um cliente pedimos para que selecione 
                echo '<h3>Selecione um cliente para ver as informaçoes dele </h3>';
            }
        ?>


    <div class="btns_de_navegação">

        <a href="/codigo/" class="button">
            <button class="Btn">
                <div class="sign">
                    <svg viewBox="0 0 512 512">
                        <path
                            d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z">
                        </path>
                    </svg>
                </div>
            </button>
        </a>

        <a href="#pagina" class="button">
            <button class="top">
                <svg height="1.2em" class="arrow" viewBox="0 0 512 512">
                    <path
                        d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z">
                    </path>
                </svg>
                <p class="text">Voltar para o topo</p>
            </button>
        </a>
    </div>

    <!-- Esse menu que tem suspenso é feito por essa parte-->
    <div class="floating-menu">
        <h3>Sugestões de Clientes</h3>
        <ul>
            <!--Onde os itens dele e exibito resalizando uma busca no banco de dados, mostrando apenas o nome, e apos o usurio escolher qual ele dejesa o valor é jogado na variavel cliente que por usa vez é jogado na variavel cliente_dogitado permitindo que o usuario realize a busca -->
            <?php foreach ($clientes as $cliente) { ?>
            <li data-value="<?php echo $cliente['cliente']; ?>"><?php echo $cliente['cliente']; ?></li>
            <?php } ?>
        </ul>
    </div>
        </head>
    </body>
</html>