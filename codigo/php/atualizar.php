<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar</title>
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

    /* linha onde os elesmentos se encontram, cujo pode ser muda do ou apagado */
    .container {
        width: 500px;
        height: 500px;
        background-image: url(../imagens/fundos/772.jpeg);
        background-position: center;
        background-repeat: no-repeat;
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
        margin: 15px;
        border-radius: 5px;
        border: none;
    }

    .mensagem-erro {
        color: red;
        position: absolute;
        z-index: 1;
        background-color: #a1a3a7;
        border-radius: 5px;
        transition: opacity 0.5s ease-in-out;
        animation: fadeOut 5s forwards;

    }

    @keyframes fadeOut {
        0% {
            opacity: 1;
        }

        90% {
            opacity: 1;
        }

        100% {
            opacity: 0;
        }
    }

    .campo-invalido.animar-erro {
        border: 2px solid crimson;
        transition: border 0.3s ease;
        animation: animarErro 0.3s;
    }

    @keyframes animarErro {
        0% {
            transform: skew(-15deg);
        }

        25% {
            transform: skew(15deg);
        }

        50% {
            transform: skew(-15deg);
        }

        100% {
            transform: skew(15deg);
        }

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

    label {
        background-color: #9fdce7;
        border-radius: 10px;
        border: 1px solid #65b2e6;
        color: #000000;
        font-size: revert;
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

    .col-md-6 {
        margin-top: 3px;

    }

    h1 {
        color: #000000;
        font-family: Playfair;
        margin-block-end: -12px;
        background-color: #9fdce7;
        border-radius: 10px;
        border: 2px solid #65b2e6;
    }
    </style>
    
    <script>
    // Função para exibir uma mensagem de erro abaixo do campo com erro ou que o usuario digite um falor que não é aceito
    function exibirMensagemErro(mensagem, campo) {
        var mensagemErro = document.createElement("p");
        mensagemErro.classList.add("mensagem-erro");
        mensagemErro.textContent = mensagem;

        campo.parentNode.insertBefore(mensagemErro, campo.nextSibling);

        // Define um tempo para a mensagem de erro desaparecer gradualmente
        setTimeout(function() {
            mensagemErro.style.opacity = 0;
        }, 1000);

        // Adiciona a classe para animar o campo com erro
        campo.classList.add("campo-invalido", "animar-erro");
    }

    // Função para remover a mensagem de erro do campo, pois se não tivesse como remover o erro ficaria lá para sempre
    function removerMensagemErro(campo) {
        var mensagemErro = campo.parentNode.querySelector(".mensagem-erro");
        if (mensagemErro) {
            mensagemErro.remove();
        }
    }

    // Validação do campo Cliente
    function validarCampoCliente() {
        console.log('A função validarCampoCliente() foi chamada');
        var campoCliente = document.getElementById("cliente");
        var cliente = campoCliente.value;


        // caso o campo do cliente esteja vazio, vai adicionar a classe de erro naquele input 
        if (cliente.trim() === "") {
            exibirMensagemErro("Por favor, insira o nome do cliente!", campoCliente);
            campoCliente.classList.add("campo-invalido", "animar-erro");
        } else {
            removerMensagemErro(campoCliente);
            campoCliente.classList.remove("campo-invalido", "animar-erro");
        }
    }

    // Validação do campo Telefone
    function validarCampoTelefone() {
        var campoTelefone = document.getElementById("telefone");
        var telefone = campoTelefone.value;

         // esse replace serve para falar que o campo não pode receber informaçoes que não for numeros
        telefone = telefone.replace(/\D/g, "");

        if (telefone.trim() === "") {
            exibirMensagemErro("Por favor, insira o número de telefone!", campoTelefone);
            campoTelefone.classList.add("campo-invalido");
        } else {
            removerMensagemErro(campoTelefone);
            campoTelefone.classList.remove("campo-invalido");
        }

        campoTelefone.value = telefone;
    }

    // Validação do campo Celular
    function validarCampoCelular() {
        var campoCelular = document.getElementById("celular");
        var celular = campoCelular.value;

        // esse replace serve para falar que o campo não pode receber informaçoes que não for numeros
        celular = celular.replace(/\D/g, "");

        if (celular.trim() === "") {
            exibirMensagemErro("Por favor, insira o número de celular!", campoCelular);
            campoCelular.classList.add("campo-invalido");
        } else {
            removerMensagemErro(campoCelular);
            campoCelular.classList.remove("campo-invalido");
        }

        campoCelular.value = celular;
    }

    // Validação do campo CEP
    function validarCampoCEP() {
        var campoCEP = document.getElementById("cep");
        var CEP = campoCEP.value;

        // esse replace serve para falar que o campo não pode receber informaçoes que não for numeros
        CEP = CEP.replace(/\D/g, "");

        if (CEP.trim() === "") {
            exibirMensagemErro("Por favor, insira um CEP!", campoCEP);
            campoCEP.classList.add("campo-invalido");
        } else {
            removerMensagemErro(campoCEP);
            campoCEP.classList.remove("campo-invalido");
        }

        campoCEP.value = CEP;
    }

    // Validação do campo Email
    function validarCampoEmail() {
        var campoEmail = document.getElementById("email");
        var email = campoEmail.value;

        if (email.trim() === "") {
            exibirMensagemErro("Por favor, insira um email válido!", campoEmail);
            campoEmail.classList.add("campo-invalido");
        } else {
            removerMensagemErro(campoEmail);
            campoEmail.classList.remove("campo-invalido");
        }
    }

    // Validação do campo Endereço
    function validarCampoEndereco() {
        var campoEndereco = document.getElementById("endereco");
        var endereco = campoEndereco.value;

        if (endereco.trim() === "") {
            exibirMensagemErro("Por favor, insira um endereço válido!", campoEndereco);
            campoEndereco.classList.add("campo-invalido");
        } else {
            removerMensagemErro(campoEndereco);
            campoEndereco.classList.remove("campo-invalido");
        }
    }

    // Função para validar todo o formulário chamando as demais funcoes, é a mesma logica do que nas aulas de estrutura de dados
    function validarFormulario() {
        validarCampoCliente();
        validarCampoTelefone();
        validarCampoCelular();
        validarCampoEndereco();
        validarCampoEmail();
        validarCampoCEP();


        // Verifica se há algum campo inválido no formulário
        return document.querySelectorAll(".campo-invalido").length == 0;
    }
    </script>
    <?php

include "teste.php";

// Inicializar as variáveis com valores vazios, pois precisaremos de variaveis auxiliares para fazer a mudança
$nome_antigo = '';
$email_antigo = '';
$telefone_antigo = '';
$celular_antigo = '';
$endereco_antigo = '';
$cep_antigo = '';

// Verificar se foi enviado um cliente da pagina de pedidos, iremos lidar com o cliente dessa forma, para não ter que ficar fazendo um sistema de busca em todas as janelas, apenas enviamos um que já foi selecionado
if (isset($_POST['cliente_digitado'])) {

    //vai colocar o valor recebido na variavel local, de mesmo nome e como sempre é por ser mais facil
    $cliente_digitado = $_POST['cliente_digitado'];

    // Obter informações do cliente antes da atualização e apoveita para puxar as informaçoes de outras tabelas.
    $query = "SELECT c.id_cliente, c.cliente, co.telefone, co.celular, e.endereco, co.email, e.cep, c.descricao, c.modelo_de_compra
    FROM tb_cliente c
    JOIN tb_contato co ON c.id_cliente = co.TB_Cliente_Id_cliente
    JOIN tb_endereco e ON c.id_cliente = e.TB_Cliente_Id_cliente 
    WHERE c.cliente = ?";
    

    // iremos colocar o valor em uma variavel, e preparar a consulta dela ao banco de dados
    $stmt = mysqli_prepare($_con, $query);

   // passamos os paramentros da consulta 
    mysqli_stmt_bind_param($stmt, "s", $cliente_digitado);

    // execultamos a consulta de maneira certinha 
    mysqli_stmt_execute($stmt);
    

    // atribuimos o resultado que tivermos a outra variavel
    $result = mysqli_stmt_get_result($stmt);

    // e fazemos a mesma coisa novamente, mas por conta que um sera usado par a ver se as informaçoes foram realmente atualizadas ou não
    $cliente_antigo = mysqli_fetch_assoc($result);

    if ($cliente_antigo) {

        // lembra das variaveis auxiliares que definimos ali em cima, agora iremos colocar os valores nela, coisa basica
        $id_cliente = $cliente_antigo['id_cliente'];
        $nome_antigo = $cliente_antigo['cliente'];
        $email_antigo = $cliente_antigo['email'];
        $telefone_antigo = $cliente_antigo['telefone'];
        $celular_antigo = $cliente_antigo['celular'];
        $endereco_antigo = $cliente_antigo['endereco'];
        $cep_antigo = $cliente_antigo['cep'];

        // Atualização do cliente e caso o usuario não tenha mudado nada, a informaçao antiga permanece
        $nome = $_POST['cliente'] ?? $nome_antigo;
        $email = $_POST['email'] ?? $email_antigo;
        $telefone = $_POST['telefone'] ?? $telefone_antigo;
        $celular = $_POST['celular'] ?? $celular_antigo;
        $endereco = $_POST['endereco'] ?? $endereco_antigo;
        $cep = $_POST['cep'] ?? $cep_antigo;

    
        // Precisamos de 3 UPDATE diferentes pois as nossas informaçoes estão em tres tabelas diferentes, se tivesse tudo junto precisariamos apenas de mim 
    
        // atualização dos clientes 
        $query = "UPDATE TB_Cliente SET cliente = ? WHERE id_cliente = ?";
        $stmt = mysqli_prepare($_con, $query);
        mysqli_stmt_bind_param($stmt, "si", $nome, $id_cliente);
        $result = mysqli_stmt_execute($stmt);

        // Atualização dos contatos
        $query = "UPDATE TB_Contato SET email = ?, telefone = ?, celular = ? WHERE TB_Cliente_Id_cliente = ?";
        $stmt = mysqli_prepare($_con, $query);
        mysqli_stmt_bind_param($stmt, "sssi", $email, $telefone, $celular, $id_cliente);
        $result = mysqli_stmt_execute($stmt);

        // Atualização do endereço
        $query = "UPDATE TB_Endereco SET endereco = ?, CEP = ? WHERE TB_Cliente_Id_cliente = ?";
        $stmt = mysqli_prepare($_con, $query);
        mysqli_stmt_bind_param($stmt, "ssi", $endereco, $cep, $id_cliente);
        $result = mysqli_stmt_execute($stmt);


        
        if ($result) {
            // Atualização bem-sucedida
        
            // echo "Atualização realizada com sucesso.";
        } else {
            // Erro na atualização
            echo "Ocorreu um erro ao atualizar as informações.";
        }
    }
}
?>

    <div class="container">
        <h1>Atualização de Cliente</h1>

        <!--Aqui fazemos um formulario para atualizar as informaçoes, mas como não queremos ir para outra paginas, deixamos o action vazio ou seja quando o usuario clicar no btn no final as informaçoes são enviadas 
            para essa mesma pagina, para ali antes de atualizar  -->
        <form action="" method="POST" autocomplete="off" onsubmit="return validarFormulario()">

            <!-- esse input que o usuario não ver serve para amazenar o cliente que estamos mudando as informaçoes-->
            <input type="hidden" name="cliente_digitado" value="<?php echo $nome_antigo; ?>">

            <!-- os label servem apenas para falamos qual campo é qual  -->
            <label for="cliente">Nome:</label>

            <!-- Já virmos a questão do validar os campos anteriomente,a questão e o value onde ele está recebendo as informaçoes do banco de dados 
            do cliente antigo, e ao mesmo tempo é atualizado caso o usuario tenha mudado alguma coisa, atraves do ? o nome da variavel atraves do POST e  os  : 
            com o nome da variavel  -->
            <input type="text" name="cliente" id="cliente" oninput="validarCampoCliente()"
                value="<?php echo isset($_POST['cliente']) ? $_POST['cliente'] : $nome_antigo; ?>" />
            <br>
            <!--OS br é apenas para pular linha -->

            <label for="email">Email:</label>

            <input type="email" name="email" id="email" oninput="validarCampoEmail()"
                value="<?php echo isset($_POST['email']) ? $_POST['email'] : $email_antigo; ?>" />
            <br>

            <label for="telefone">Telefone:</label>
            <input type="tel" name="telefone" id="telefone" oninput="validarCampoTelefone()"
                value="<?php echo isset($_POST['telefone']) ? $_POST['telefone'] : $telefone_antigo; ?>" />
            <br>

            <label for="celular">Celular:</label>
            <input type="tel" name="celular" id="celular" oninput="validarCampoCelular()"
                value="<?php echo isset($_POST['celular']) ? $_POST['celular'] : $celular_antigo; ?>" />
            <br>

            <label for="endereco">Endereço:</label>
            <input type="text" name="endereco" id="endereco" oninput="validarCampoEndereço()"
                value="<?php echo isset($_POST['endereco']) ? $_POST['endereco'] : $endereco_antigo; ?>" />
            <br>

            <label for="cep">CEP:</label>
            <input type="text" name="cep" id="cep" oninput="validarCampoCEP()"
                value="<?php echo isset($_POST['cep']) ? $_POST['cep'] : $cep_antigo; ?>" />
            <br>

            <button type="submit" class="btn btn-primary"> Atualizar </button>
        </form>


        <form action="../php/pedidos.php" method="GET">
            <button type="submit" class="button">
                <span class="button__text">Voltar</span>

            </button>
        </form>
    </div>