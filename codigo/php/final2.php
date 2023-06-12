<!DOCTYPE html>
<html>

<head>
    <title>Finalizar compra</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <style>
    * {
        padding: 0;
        margin: 0;

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
        font-size: 1.5rem;
        margin-left: 31%;
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

    body {
        font-family: 'Roboto', sans-serif;
        font-weight: 400;
        font-style: normal;
        color: #d1d0cf;
        background: #202124;
    }

    .container {
        width: 601px;
        background-image: url(../imagens/fundos/772.jpeg);
        background-position: center;
        /* background-size: cover; */
        border: 2px solid #fdfdfd;
        border-radius: 15px;
        align-items: stretch;
        /* display: flex; */
        margin-top: 2%;
        margin-left: 21%;
        display: grid;
        grid-gap: 10px;
        flex-wrap: wrap;
        align-items: center;
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
        margin-left: 45%;
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
        margin-left: 30%;
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

        background-color: #9fdce7;
        border-radius: 10px;
        border: 1px solid #65b2e6;
        text-align: center;
        font-size: 1.2rem;
        margin-left: 13%;
        color: #000;
    }

    label {
        background-color: #9fdce7;
        border-radius: 10px;
        border: 1px solid #65b2e6;
        color: #000000;
        font-size: revert;
    }

    input.label {
        color: #000000;
        padding: 0 5px;
        margin-top: 15px;
        margin-block: 15px;
        width: 100%;
        align-items: center;
        text-align: center;
        font-size: 1.2rem;
        border-radius: 5px;
        border: 2px solid #d384e6;
        background-color: #ffff;
    }

    .form-check {
        margin-top: 5px;
        margin-bottom: 5px;
    }

    .form-check-input:checked::before {
        background-color: red;
        /* Defina a cor desejada aqui */
    }

    .opçoes {
        width: 100%;
        margin-left: 2%;
        margin-top: 5px;
        border-radius: 15px;
        font-size: 1.3rem;
        text-align: center;
        border: 2px solid #d384e6;
    }

    #exampleFormControlTextarea1 {
        width: 100%;
        margin-left: 2%;
        margin-top: 5px;
        height: 20px;
    }

    #Sinal {
        width: 86%;
        margin-left: 8%;
        margin-top: 10px;
        height: 16px;
    }
    


    .pagamento {
        -webkit-appearance: none;
    /* display: block; */
    margin: 10px;
    width: 17px;
    height: 17px;
    border-radius: 12px;
    cursor: pointer;
    vertical-align: middle;
    box-shadow: hsla(0,0%,100%,.15) 0 1px 1px, inset hsla(0,0%,0%,.5) 0 0 0 1px;
    background-color: hsl(0deg 0% 0.08% / 81%);
    background-image: -webkit-radial-gradient( hsl(276.92deg 100% 90%) 0%, hsl(277 100% 70% / 1) 15%, hsl(277deg 100% 60% / 30%) 28%, hsl(277deg 100% 30% / 0%) 70% );
    background-repeat: no-repeat;
    -webkit-transition: background-position .15s cubic-bezier(.8, 0, 1, 1), -webkit-transform .25s cubic-bezier(.8, 0, 1, 1);
    outline: none;
}

.pagamento:checked {
  -webkit-transition: background-position .2s .15s cubic-bezier(0, 0, .2, 1),
    -webkit-transform .25s cubic-bezier(0, 0, .2, 1);
}

.pagamento:active {
  -webkit-transform: scale(1.5);
  -webkit-transition: -webkit-transform .1s cubic-bezier(0, 0, .2, 1);
}



/* The up/down direction logic */

.pagamento,
.pagamento:active {
  background-position: 0 24px;
}

.pagamento:checked {
  background-position: 0 0;
}

.pagamento:checked ~ .input,
.pagamentochecked ~ .input:active {
  background-position: 0 -24px;
}
    </style>
</head>
<?php

// momento que chega a ser chato, porem novamnete essa parte precisa ter em todos os arquivos .php e paciencia
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "teste";
$_con = mysqli_connect($servidor, $usuario, $senha, $banco);


// Verificar se o formulário foi enviado corretamente
if (isset($_POST['continuar'])) {

    // Recuperar as informações enviadas do formulário de origem
    if (isset($_POST['itens_selecionados'])) {
        $itensSelecionados = $_POST['itens_selecionados'];
    echo '<div class="container">';
    
        // precisamos do id do cliente para asssociamos os itens a ele, e como realizamos a busca apenas pelo nome precisamos consultar no banco de dados
                $clienteDigitado = $_POST['cliente_digitado'] ?? '';
                echo "<h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cliente selecionado: $clienteDigitado </h1><br>";

        // Processar as informações recebidas
        echo "<h1>Itens selecionados e quantidades: </h1><br>";
        
        // Precisamos fazer a operação matemática para calcular o total dos itens
        $valorTotal = 0; 
        $valorcompleto = 0;
        
        //falo que o desconto vai ser de 2% apenas por ser uma pessoa de bom coração, mas tambem poderiamos aplicar para ser aleatorio
        $desconto = 0.02;
    
    
        // mesma coisa dos demias um laço para todos os itens selecionados anteriomente
        foreach ($itensSelecionados as $item) {


            //seleciona o produto 
            $query = "SELECT * FROM tb_produto WHERE id_produto = ?";

            //prepara para realizar a consulta 
            $stmt = mysqli_prepare($_con, $query);

            //pasado os parametos podemos ir realizar a consulta
            mysqli_stmt_bind_param($stmt, "s", $item);

            //consulta um sucesso iremos dar esse resultado para outra variavel 
            mysqli_stmt_execute($stmt);

            // que é essa no caso 
            $result = mysqli_stmt_get_result($stmt);

            // novamnete precisamos ir item por item então não tem muito para onde ir 
            $row = mysqli_fetch_assoc($result);
        
            // vai ver item por item para podemos mostrar certinho
            if ($row) {
                $quantidade = $_POST['quantidade_' . $item] ?? '';
                $nomeItem = $row['Nome_produto'];
                $valorItem = $row['Valor_do_Produto'];
                $id_produto = $row['id_produto'];
        

                // ver se aquele item tem uma imagem, caso tenha vai mostra
                if (!empty($row["images"])) {
                    echo '<img class="imagens" src="../imagens/' . $row["id_produto"] . '/' . $row["images"] . '" alt="Imagem do Produto"><br>';
                }


                // VAI mostra as informaçoes dos produtos
            
                echo "<h3>Item selecionado: $nomeItem<br></h3>";
                echo "<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Quantidade: $quantidade<br></h3>";
                echo "<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Valor: R$ $valorItem<br><br></h3>";      
            
        
                // Obter o ID do cliente selecionado
                $query = "SELECT id_cliente FROM tb_cliente WHERE cliente = ?";

                // é aquilo como das outras vezes, preparamos a busca, passamos os parametros e atribuimos o resultado a outra variavel
                $stmt = mysqli_prepare($_con, $query);
                mysqli_stmt_bind_param($stmt, "s", $clienteDigitado);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_assoc($result);
                $clienteId = $row['id_cliente'];
        
                // Calcula o valor parcial do item ou seja vai ver o valor do item 1 e a quantidade dele e fazer as contas, mas para não pedemos esse valor atribuimos o resultado a outra variavel
                $valorParcial = $quantidade * $valorItem;
        
                // que no caso seria essa, estamos falando que o valor total, é igual o valor parcial + as outras vezes 
                $valorTotal += $valorParcial;
            } else {
                echo "Nenhum resultado encontrado para o item $item.";
            }
        }
    }
}
            // aqui apenas estamos fazendo contas matematica, e formando o resultado, falando que o resultado apenas pode ter duas casas decimais, para no banco de dados não ficar algo como "6.4455554" ou qualquer coisa parecida
            $valorDESCONTO = ($valorTotal * 0.02);
            $valorcomdesconto = $valorTotal  -$valorDESCONTO;
            $valorcomdesconto = number_format($valorcomdesconto, 2, '.', '');
            $valorDESCONTO = number_format($valorDESCONTO, 2, '.', '');
            $valorTotal = number_format($valorTotal, 2, '.', '');
            ?>

<!--Como ainda termos outras informaçoes para ser prenchidas iremos fazer outro formulario para terminar de optermos os valores que precisamos -->
<form method="post" action="../php/salvarcompra.php">

    <!-- Aqui aconte algo muito interresante e que eu não sabia, se voce notar todos os campos de valores estão desabilidados
                    para que o usuario não possa alterar esse valor, mas ao mesmo tempo que se deixamos asssim, não conseguimos enviar os valores para o outro formulario 
                    e para conseguimos enviar precisamos passar essse valor de novo mas em um campo invisivel que o usuario não vai ver, por isso os campos
                    do tipo "HIDDEN"  Alem que nos values estamos chando o php e passando a variavel para aquele campo ter as informaçoes certas-->
    <label for="" class="form-label">&nbsp;&nbsp;&nbsp;Total do pedido:&nbsp;&nbsp;&nbsp;</label><br>
    <input type="number" class="label" name="valordosItens" disabled value="<?php echo $valorTotal; ?>" readonly><br>

    <label for="" class="form-label">&nbsp;Valor do desconto&nbsp;</label><br>
    <input type="number" class="label" id="valorDesconto" name="valorDesconto" value="<?php echo $valorDESCONTO; ?>"
        disabled><br>
    <input type="hidden" name="valordosItensHidden" value="<?php echo $valorTotal; ?>">
    <input type="hidden" name="valorDescontoHidden" value="<?php echo $valorDESCONTO; ?>">
    <input type="hidden" name="valorcomdescontoHidden" value="<?php echo $valorcomdesconto; ?>">

    <label for="" class="form-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Valor
        Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><br>
    <input type="number" class="label" id="valorcomdesconto" name="valorcomdesconto"
        value="<?php echo $valorcomdesconto; ?>" disabled><br>


    <!-- Colocamos os detalhes do pedido em uma caixa de texto, porem poderia ser um input simples, isso vai muito pelo espaço que voce alogou no seu banco de dados, e como colocamos 45 achei melhor assim-->
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">&nbsp;&nbsp;Detalhes do Pedido&nbsp;&nbsp;</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="descricao"></textarea>
    </div><br>


    <!-- Colocamos a forma de pagamento em um tipo radio para que o usuario possa escolher só um, poderia ser um select tambem, deppende muito da aparecia que voce quer
                    mas, a questão não é essa e sim os "value" pois vai depender de como voce fez o banco de dados, então exempro se eu tivesse colocado um varchar de 1 eu não poderia passar o nome completo 
                    deveria que ser um codigo, 1 , 2 ,3 e por ai vai assim vai ocupar menos espaço no banco de dados, mas ficaria pior para apresentar essa informaçao depois-->
    <h3>Forma de pagamento</h3>
    <div class="form-check form-check-inline">
        <input class="pagamento" type="radio" id="meiodepagamento1" name="pagamento" value="Boleto" required>
        <label class="form-check-label" for="inlineradio1">Boleto</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="pagamento" type="radio" id="meiodepagamento2" name="pagamento" value="Dinheiro" required>
        <label class="form-check-label" for="inlineradio2">Dinheiro</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="pagamento" type="radio" id="meiodepagamento3" name="pagamento" value="Cartao" required>
        <label class="form-check-label" for="inlineradio3">Cartão</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="pagamento" type="radio" id="meiodepagamento4" name="pagamento" value="Deposito" required>
        <label class="form-check-label" for="inlineradio4">Depósito</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="pagamento" type="radio" id="meiodepagamento5" name="pagamento" value="Outros" required>
        <label class="form-check-label" for="inlineradio4">Outros</label>
    </div>

    <!-- è a mesma coisa do que em cima então não vou explicar-->
    <h3>Forma de entrega</h3>
    <div class="form-check form-check-inline">
        <input class="pagamento" type="radio" id="inlineradio1" name="envio" value="PAC" required>
        <label class="form-check-label" for="inlineradio1">PAC</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="pagamento" type="radio" id="inlineradio2" name="envio" value="SEDEX" required>
        <label class="form-check-label" for="inlineradio2">SEDEX</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="pagamento" type="radio" id="inlineradio3" name="envio" value="EM MÃOS" required>
        <label class="form-check-label" for="inlineradio3">EM MÃOS</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="pagamento" type="radio" id="inlineradio4" name="envio" value="TRANSPORTADORA" required>
        <label class="form-check-label" for="inlineradio4">TRANSPORTADORA</label>
    </div>


    <!-- assim como falei la em cima, que poderia ser um select iria depender muito de como queriamos mostra as informaçoes aqui é a mesma cois,
                    Mas aqui tem coisa mais, se voce olhar essa linha toda do select vai ver "onchange="handleParcelasChange()" o que isso significa, que quando o usuario clicar 
                    vai chamar a função com esse nome, e vai passar a quantidade de parcelas que o usuario escolheu-->
    <select class="opçoes" aria-label="Default select example" id="quantidadeParcelas" required name="parcelas"
        onchange="handleParcelasChange()">
        <option selected>Quantidade de Parcelas</option>
        <option value="1">1x</option>
        <option value="2">2x</option>
        <option value="3">3x</option>
        <option value="4">4x</option>
        <option value="5">5x</option>
        <option value="6">6x</option>
        <option value="7">7x</option>
        <option value="8">8x</option>
        <option value="9">9x</option>
        <option value="10">10x</option>
    </select>

    <!--Veja que o value dessa linha está recebendo uma variavel, que está ligada diretamente com a questão da quantidade de parcelas que o usuario escolheu, mas vou explicar isso no script-->
    <input type="number" id="valorParceladoInput" class="label" name="valorParcelado"
        value="<?php echo $valorcomdesconto; ?>" disabled>

    <!-- Campos nomais que não tem nada demais-->
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Anotações do Pedido</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="anotacao"></textarea>
    </div>

    <div>
        <label class="form-label"
            for="Sinal">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sinal:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" class="form-control" id="Sinal" pattern="[0-9]*" name="sinal" oninput="validarCampoSinal()">
    </div>

    <!-- Novamente um laço para podemos enviar todos os itens para o salvar compra-->
    <?php foreach ($itensSelecionados as $item) { ?>
    <input type="hidden" name="itens_selecionados[]" value="<?php echo $item; ?>">
    <input type="hidden" name="quantidade_<?php echo $item; ?>"
        value="<?php echo $_POST['quantidade_' . $item] ?? ''; ?>">
    <?php } ?>

    <!--Campos invisivel para enviar o restante das informaçoes-->
    <input type="hidden" name="clienteId" value="<?php echo $clienteId; ?>">
    <input type="hidden" name="itensSelecionados" value="<?php echo implode(',', $itensSelecionados); ?>">
    <input type="hidden" name="produtoId" value="<?php echo $produtoId; ?>">
    <input type="hidden" name="detalhes" value="<?php echo $detalhes; ?>">
    <input type="hidden" name="qtItens" value="<?php echo $qtItens; ?>">

    <!-- BTN para enviar as coisas para o proximo formulario-->
    <button type="submit" name="finalizar_compra" class="btn btn-primary"> Finalizar Compra </button>

    <!-- Assim que o usuario escolher a quantidade de parcelas ira chamar essa função-->
    <script>
    function handleParcelasChange() {

        // aqui não tem muita magia não, ele está pegando as demais variavel da pagina de valores e recebendo a quantidade de parcelamento, e fazendo a conta 
        // e devolver o resultado para aquele campo de input
        var valorTotal = <?php echo $valorTotal; ?>;
        var valorDesconto = <?php echo $valorDESCONTO; ?>;
        var quantidadeParcelas = document.getElementById("quantidadeParcelas").value;
        var valorParcelado = (valorTotal - valorDesconto) / quantidadeParcelas;

        document.getElementById("valorParceladoInput").value = valorParcelado.toFixed(2);
    }
    </script>
</form>
<a href="../index.html">
    <button type="button" class="button">
        <span class="button__text">Voltar</span>

    </button>
</a>
</div>
</body>

</html>