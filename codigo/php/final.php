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

    .conteiner {
        width: 748px;
        background-image: url(../imagens/fundos/775.jpg);
        background-position: center;
        background-size: cover;
        border: 1px solid #fdfdfd;
        border-radius: 15px;
        align-items: flex-end;
        display: flex;
        margin-top: 2%;
        margin-left: 14%;
        display: grid;
        grid-gap: 10px;
        flex-wrap: wrap;
        flex-direction: column;
        align-content: space-around;
        justify-content: space-around;
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

    h1,
    h3 {
        color: #000;
        text-align: center;
    }
    .continuação{
        margin-left: -45%;
    }

    </style>
</head>

<body>
    <?php
    include "teste.php";
    ?>

    <form action="../php/final2.php" method="post">
        <?php
        /* Verifica se a variavel 'cliente_digitado' foi mandanda de certo */
        if (isset($_POST['cliente_digitado'])) {
            
            /* Recebe o valor digitado no campo "cliente" usando $_POST['cliente_digitado'] e armazena na variável $cliente */
            $cliente_digitado = $_POST['cliente_digitado'];

            // Vai preparar uma consulta no banco de dados para obter o restante das informações
            $query = "SELECT Id_cliente FROM TB_Cliente WHERE cliente = ?";
            $stmt = mysqli_prepare($_con, $query);

            // Vai vincular os parâmetros à consulta que queremos, ou seja, vai buscar o ID referente ao cliente que foi selecionado
            mysqli_stmt_bind_param($stmt, "s", $cliente_digitado);

            // Essa linha vai realmente executar a consulta
            mysqli_stmt_execute($stmt);

            // Após o término da consulta, vai vincular o resultado. Nesse ponto, já temos o nome do cliente e o ID dele, com isso conseguimos ver qualquer informação dele
            mysqli_stmt_bind_result($stmt, $id_cliente);

            // Ver se tem mais alguma consulta a ser feita
            mysqli_stmt_fetch($stmt);

            // Caso não tenha, ele vai fechar a consulta
            mysqli_stmt_close($stmt);
        }
        ?>

        <?php
        // Queremos puxar todos os produtos para que o cliente/ usuario possa escolher aquele que ele deseja.
        $query = "SELECT * FROM tb_produto";
    
       // o de sempre verificamos a coneção com o banco de dados
        $result = mysqli_query($_con, $query);

        $clienteDigitado = $_POST['cliente_digitado'] ?? '';

echo '<div class="conteiner">';
        // Exibir o cliente selecionado
        echo "<h1>Cliente selecionado: $clienteDigitado</h1>";
        // caso tenha algum resultado ou seja caso tenha algum item cadastro iremos exibir ele 
        if ($result && mysqli_num_rows($result) > 0) {
        
            //texto pra ficar bonito
            echo '<label for="itens"><h3>Selecione os itens desejados:<h3></label>';
            echo '<br><br><br>';

            echo '<table>'; // Início da tabela


            // iremos atribuir um laço com base naquele select * from ou seja vai repetir esse pedaço a mesma quantidade de vezes dos produtos que tem no banco, se tiver 1000 irea repedir as mil vezes
            while ($row = mysqli_fetch_assoc($result)) {
            
               // apoveitamos que o $row vai aumentar para associar aquela repedição ao numero do produto no banco de dados, então se estiver por exempro na 5 vez  do laço 
               // vai atrubuir o valor que ele está carregando a outra variavel
                $nomeItem = $row['Nome_produto'];
                $imagesItem = $row['images'];
                $valorItem = $row['Valor_do_Produto'];
                $id_produto = $row['id_produto'];

                echo '<tr>';

                // nome do item em uma nova linha 
                echo '<td><h2>' . $nomeItem . '</h2></td>';

                // mostrando o valor do item e etc 
                
                echo "<td><h2> R$: " . $valorItem . "</h2></td>";
            
                // ver se aquele registro tem imagem, caso tenha vai mostra e se não tiver eu não sei o que acontece pq eu não testei 
                if (!empty($row["images"])) {
                
                    // assim como no cadastro dos produtos criamos um diretorio para amazenar as imagens, termos que fazer o mesmo caminho para obter a imagem
                    // mais o norme do arquivo, e é por isso que é bom fazer uma padrão de nomes
                    // note que as imagens estão com um type de checkbox e um onchange
                    echo '<td><input type="checkbox" name="itens_selecionados[]" value="' . $row["id_produto"] . '" onchange="updateQuantidade(this)"><img class="imagens" src="../imagens/' . $row["id_produto"] . '/' . $row["images"] . '" alt="Imagem do Produto"></td>&nbsp;&nbsp;&nbsp;';
                    
                }


                // essa parte é mais chata, então bora com calma, estamos colocando um campo de input para lidar com a quantidade de itens que o cliente vai querer (perceba que ainda estamos no laço de reptição, ou seja cada produto vai ter o seu campo),
                // até ai ok cada produto tem sua quantidade, mas para que não fique um campo vazio ou com um valor de 0, caso o usuario selecione automaticamete vai receber um valor de 1 por isso o min
                // outro ponto é que esse campo está dessabilidado ou seja, não aceita valores isso é para evitar bagunça no banco de dados, pois o usuario não conseque entrar com um valor se não for levar o item,
                //nessa parte é isso 
                echo '<td><input type="number" name="quantidade_' . $id_produto . '" min="1" value="" disabled><br>&nbsp;&nbsp;&nbsp;Quantidade</td>';
                
                
                echo '<br>';
            }

            echo '</table>';
        } else {
            echo "Nenhum produto encontrado.";
        }
        ?>


        <br><br>
        <div class="continuação">
            <input type="hidden" name="cliente_digitado" value="<?php echo $cliente_digitado; ?>">
            <!--Iremos mandar essas informaçoes de produtos e quantidade para outro formulario  -->

            <button type="submit" name="continuar" class="btn btn-primary"> Continuar </button>

            </form>
            <br><br>
            <a href="../php/pedidos.php">
                <button type="button" class="button">
                    <span class="button__text">Voltar</span>

                </button>
            </a>
        </div>
</div>
    <script>
    // A parte que o filho chora e a mãe não ve 

    // lá na imagem colocalamos uma propriedade de onchange ela serve para que toda vez que o usuario clicar na imagem ele chame alguma função 
    // que nesse caso é essa aqui 
    function updateQuantidade(checkbox) {

        //precisamos  verificar o checkbox certo par que isso funcione, pois se apenas passamos "checkbox" ele só vai contar o primeiro que tiver na pagina, 
        // e falamos que para ele mexer no input de quantidade de acordo com o a posição que ele estiver por isso essa parte 'input[name="quantidade_' + checkbox.value + '"]'
        // resumindo estamos passando o id do input de acordo com o checkbox que ele petence 
        var quantidadeInput = checkbox.parentNode.nextElementSibling.querySelector('input[name="quantidade_' + checkbox
            .value + '"]');


        // e fazemos um if juntando os dois elementos o checkbox e o campo de input, os dois estejam ok 
        if (checkbox.checked && quantidadeInput) {

            // vai remover aquela questão do disable permitindo que o usuario edite o campo 
            quantidadeInput.disabled = false;

            // e colocando de forma automatica o valor de 1 (o usuario pode aumentar mas não diminuir)
            quantidadeInput.value = '1';
        } else if (quantidadeInput) {
            // e caso o usuario desmarque o checkbox  vai desabilidar o campo e remover o calor dele 
            quantidadeInput.disabled = true;
            quantidadeInput.value = '';
        }
    }
    </script>
</body>

</html>