<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar</title>
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
        background-image: url(../imagens/fundos/774.jpg);
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

    h1 {
        color: #000000;
        font-family: Playfair;
        margin-block-end: -12px;
        background-color: #ffffff;
        border-radius: 10px;
        border: 2px solid #e66565;
        text-align: center;
    }

    p {
        color: #000000;
        font-family: Playfair;
        margin-block-end: -12px;
        background-color: #9fdce7;
        border-radius: 10px;
        border: 2px solid #65b2e6;
        text-align: center;
    }
    </style>
    <?php

//de lei como todos os outros, arquivo para conectar o arquivo ao banco de dados
include "teste.php";


// verifica se a variavel "$cliente_digitado" do arquivo pedidos.html foi enviada de maneira certa pois com base nela 
// que iremos apagar o usuario certo (eu espero que seja o certo)
if (isset($_POST['cliente_digitado'])) {

    // usamos o mesmo nome de variavel apenas para manter um padrão, mas poderia ser outro antes do "= _post"
    $cliente_digitado = $_POST['cliente_digitado'];

    // apos a declaração do cliente, sabemos o nome dele mas não o id e nessa marte onde iremos descobrir isso 
    
    // vai preparar uma consulta no banco de dados para obter o restante das informaçoes 
    $query = "SELECT Id_cliente FROM TB_Cliente WHERE cliente = ?";
    $stmt = mysqli_prepare($_con, $query);

    // vai vincular os paramentros a consulta que queremos, ou seja vai buscar o id referente ao cliente que foi selecionado
    mysqli_stmt_bind_param($stmt, "s", $cliente_digitado);
    
    // essa linha vai realmente executar a consulta 
    mysqli_stmt_execute($stmt);

    // Apos o termino da consulta, vai vincular o resultado, ou seja nesse ponto já termos o nome do cliente e o id dele, com isso conseguimos ver qualquer informaçao dele
    mysqli_stmt_bind_result($stmt, $id_cliente);
    
    // ver se tem mais alguma consulta a ser feita 
    mysqli_stmt_fetch($stmt);
    
    // caso não tenha ele vai fechar a consulta 
    mysqli_stmt_close($stmt);



    if ($id_cliente) {
        
        //com a posibilidade do usuario ter clicado errado colocamos um btn de confimação caso ele confirme, iremos  continuar a deletar as informaçoes 
        if (isset($_POST['confirmacao']) && $_POST['confirmacao'] === 'confirmado') {
            
            mysqli_begin_transaction($_con);


            //apesar de ter como apagar todas as informaçoes de um cliente ignorando a questão das fk esse jeito não funcionou muito para mim, então bora de maneira manual
            try {
                // Excluir contatos associados ao cliente na tabela contato
                $query = "DELETE FROM TB_Contato WHERE TB_Cliente_Id_cliente = ?";
                $stmt = mysqli_prepare($_con, $query);
                mysqli_stmt_bind_param($stmt, "i", $id_cliente);
                mysqli_stmt_execute($stmt);

                // Excluir endereço associado ao cliente na tabela endereco
                $query = "DELETE FROM TB_Endereco WHERE TB_Cliente_Id_cliente = ?";
                $stmt = mysqli_prepare($_con, $query);
                mysqli_stmt_bind_param($stmt, "i", $id_cliente);
                mysqli_stmt_execute($stmt);

                // Excluir cliente realemte
                $query = "DELETE FROM TB_Cliente WHERE Id_cliente = ?";
                $stmt = mysqli_prepare($_con, $query);
                mysqli_stmt_bind_param($stmt, "i", $id_cliente);
                mysqli_stmt_execute($stmt);

                // Confirmar a transação
                mysqli_commit($_con);

                echo "Exclusão realizada com sucesso.";
                echo "<a href='../index.html'>";
                echo "<button type='button' class='button'>";
                echo "<span class='button__text'>Voltar</span>";
                echo "</button>";
                echo "</a>";
            } catch (Exception $e) {
                // Ocorreu um erro, desfazer a transação
                mysqli_rollback($_con);
                echo "Ocorreu um erro ao excluir o cliente: " . $e->getMessage();
                echo "<a href='../index.html'>";
                echo "<button type='button' class='button'>";
                echo "<span class='button__text'>Voltar</span>";
                echo "</button>";
                echo "</a>";
            }
        } else {

            // Exibir botão de confirmação que foi citado anteriomente
            if (isset($_POST['cliente_digitado'])) {
                $cliente_digitado = $_POST['cliente_digitado'];
            
                // Obter informações do cliente antes de deletar ele, para confirmar que é o certo 
                $query = "SELECT c.id_cliente, c.cliente, co.telefone, co.celular, e.endereco, co.email, e.cep, c.descricao, c.modelo_de_compra
                            FROM tb_cliente c
                            JOIN tb_contato co ON c.id_cliente = co.TB_Cliente_Id_cliente
                            JOIN tb_endereco e ON c.id_cliente = e.TB_Cliente_Id_cliente 
                            WHERE c.cliente = ?";
            
                $stmt = mysqli_prepare($_con, $query);
                mysqli_stmt_bind_param($stmt, "s", $cliente_digitado);
                mysqli_stmt_execute($stmt);
            
                $result = mysqli_stmt_get_result($stmt);
                $cliente_antigo = mysqli_fetch_assoc($result);
            
                if ($cliente_antigo) {
                    $id_cliente = $cliente_antigo['id_cliente'];
                    $nome_antigo = $cliente_antigo['cliente'];
                    $email_antigo = $cliente_antigo['email'];
                    $telefone_antigo = $cliente_antigo['telefone'];
                    $celular_antigo = $cliente_antigo['celular'];
                    $endereco_antigo = $cliente_antigo['endereco'];
                    $cep_antigo = $cliente_antigo['cep'];
            echo "<div class='container'>";
                    echo "<h1>Informações do Cliente</h1>";
                    echo "<p>ID do Cliente: " . $id_cliente . "</p>";
                    echo "<p>Nome: " . $nome_antigo . "</p>";
                    echo "<p>Email: " . $email_antigo . "</p>";
                    echo "<p>Telefone: " . $telefone_antigo . "</p>";
                    echo "<p>Celular: " . $celular_antigo . "</p>";
                    echo "<p>Endereço: " . $endereco_antigo . "</p>";
                    echo "<p>CEP: " . $cep_antigo . "</p>";
            
                    echo "<h1>Exclusão de Cliente</h1>";
                    echo "<p>Deseja realmente excluir o cliente?</p>";
                    echo '<form action="../PHP/deletarcliente.php" method="POST">';
                    echo '<input type="hidden" name="cliente_digitado" value="' . $cliente_digitado . '">';
                    echo '<input type="hidden" name="confirmacao" value="confirmado">';
                    echo '  <button type="submit" class="btn btn-primary"> Confirmar </button>';
                    echo '</form>';
                    echo '<form action="../php/pedidos.php" method="GET">';
                    echo '<button type="submit" class="button">';
                    echo'<span class="button__text">Cancelar</span>';

                    echo'</button>';
                    echo '</form>';
                }
            }
    } 
}
    }

?>

    </div>