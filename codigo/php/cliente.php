<html>

<head>
    <title>Cliente</title>
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

    .ultimo-registro {
        width: 500px;
        height: 500px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        border: 2px solid #fdfdfd;
        border-radius: 15px;
        align-items: flex-end;
        overflow:hidden;
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

    .buttonn {
        position: relative;
        background-color: #868991;
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

    p {
        padding: 5px;
        font-family: Playfair;
        border-radius: 10px;
    }

    .linha-superior {
        border-top: 2px solid #FFFF;
        padding-top: 10px;
    }

    .linha-inferior {
        margin-left: -65%;
        text-align: center;
        width: 227%;
        border-bottom: 2px solid #FFFF;
        padding-bottom: 6px;
    }
    </style>
</head>

<body>
    <?php
    /* Outro arquivo responsável por fazer a ligação com o banco de dados */
    include "teste.php";

    /* Recebe os elementos que foram digitados no HTML via POST e armazena em outras variáveis que serão adicionadas no banco de dados. */
    $cliente = $_POST['cliente'];
    $descricao = $_POST['descricao'];
    $compra = $_POST['compra'];
    $cep = $_POST['cep'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $celular = $_POST['celular'];
    $telefone = $_POST['telefone'];

    // Inserindo registros nas tabelas
    $sql_Cliente = 'INSERT INTO TB_Cliente(cliente, descricao, modelo_de_compra) VALUES (\'' . $cliente . '\', \'' . $descricao . '\', \'' . $compra . '\')';
    $result_Cliente = mysqli_query($_con, $sql_Cliente);

    if ($result_Cliente) {
        $id_cliente = mysqli_insert_id($_con);

        $sql_Contato = 'INSERT INTO TB_Contato(TB_Cliente_Id_cliente, telefone, email, celular) VALUES (' . $id_cliente . ', \'' . $telefone . '\', \'' . $email . '\', \'' . $celular . '\')';
        $result_Contato = mysqli_query($_con, $sql_Contato);

        $sql_Endereco = 'INSERT INTO TB_Endereco(TB_Cliente_Id_cliente, endereco, cep) VALUES (' . $id_cliente . ', \'' . $endereco . '\', \'' . $cep . '\')';
        $result_Endereco = mysqli_query($_con, $sql_Endereco);

        if ($result_Contato && $result_Endereco) {
           // echo "Novo registro criado com sucesso.";

            // Recuperando o último registro
            $sql = "SELECT c.cliente, co.telefone, co.celular, e.endereco, co.email, e.cep, c.descricao, c.modelo_de_compra
                    FROM TB_Cliente c
                    JOIN TB_Contato co ON c.Id_cliente = co.TB_Cliente_Id_cliente
                    JOIN TB_Endereco e ON c.Id_cliente = e.TB_Cliente_Id_cliente
                    WHERE c.Id_cliente = " . $id_cliente;

            $result = mysqli_query($_con, $sql);

            if (mysqli_num_rows($result) > 0) {
                // Exibir os dados do último registro
                $row = mysqli_fetch_assoc($result);
                echo "<div class='ultimo-registro'>";//criação de uma div apenas porquestão de aparecia 
                echo "<h2>Último registro:</h2>";//titulo para mostrar na tela 
                echo "<p class='linha-superior linha-inferior'>Nome: " . $row["cliente"] . "</p>";
                echo "<p class='linha-inferior'><strong>Telefone:</strong> " . $row["telefone"] . "</p>";
                echo "<p class='linha-inferior'><strong>Celular:</strong> " . $row["celular"] . "</p>";
                echo "<p class='linha-inferior'><strong>Endereço:</strong> " . $row["endereco"] . "</p>";
                echo "<p class='linha-inferior'><strong>Email:</strong> " . $row["email"] . "</p>";
                echo "<p class='linha-inferior'><strong>CEP:</strong> " . $row["cep"] . "</p>";
                echo "<p class='linha-inferior'><strong>Descrição:</strong> " . $row["descricao"] . "</p>";
                echo "<p class='linha-inferior'>Meio de Compra: " . $row["modelo_de_compra"] . "</p>";
                echo "<a href='../index.html'>";
                echo "<button type='button' class='button'>";
                echo "<span class='button__text'>Voltar</span>";
                echo "</button>";
                echo "</a>";
                echo "<a href='../HTML/cliente.html'>";
                echo "<button type='button' class='buttonn'>";
                echo "<span class='button__text'>Adicionar</span>";
                echo "</button>";
                echo "</a>";
                echo "</div>";
            }
        } else {
            echo "Erro ao inserir registro: " . mysqli_error($_con);
        }
    } else {
        echo "Erro ao inserir registro: " . mysqli_error($_con);
    }
    
    
    ?>
</body>

</html>