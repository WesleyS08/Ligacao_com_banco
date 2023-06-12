<html>

<head>
    <title>Produtos</title>
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
            display: flex;
            margin-top: 2%;
            overflow:hidden;
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
            margin-left: -60%;
            width: 213%;
            border-bottom: 2px solid #FFFF;
            padding-bottom: 6px;
            text-align: center;
        }

        .imagens {
            border-radius: 20px;
            height: 200px;
        width: 200px;
        }
        h2{
            margin-left: 22%;
        }
    </style>

</head>

<body>
    <?php
    include "teste.php";
    
    // Associando as informações do formulário HTML com os campos correspondentes da tabela.
 
    $produto = $_POST['produto'];
    $arquivo = $_FILES['img'];
    $valor = $_POST['valor'];
    
    // com base na nossa tabela precisamos colocar as coisas em ordem, pois se voce pesquisar um produto
    //com o valor no campo que era pra ser o nome, vai dar erro, ou seja precisamos cuidar dessa oredem para dar tudo certo
    
    $sql_Produto = "INSERT INTO tb_produto(Nome_produto, Valor_do_Produto) 
                    VALUES ('$produto', '$valor')";
    
    
    
    // iremos ver se a coneção com o banco está funcionado, por conta disso a maioria dos if vai possuir o $_con como um pareametro
    // e o nome da nossa variavel, que nesse caso é o $sql_produto, apos ver que a conecção está ok, o item foi adicionado sem problemas iremos ir para o proximo passo
    if (mysqli_query($_con, $sql_Produto)) {
        
        // Recupera o último ID inserido no banco de dados, precisamos desse id para criamos a pasta da imagem, referente ao item que foi adicionado.
        $ultimo_id = mysqli_insert_id($_con);
        
        //alem que precisamos fazer um if para ver se uma imagem foi adicionada caso o não simpleste vai pular toda essa parte  pois não tem necessidade
        if (isset($arquivo['tmp_name']) && !empty($arquivo['tmp_name'])) {
           
            // assim como falei lá em cima a imagem alem de ficar na pasta imagens/ ela vai no seu respecivo id, e para isso precisamos criar uma pasta dentro da outra
            $diretorio = "../imagens/$ultimo_id/";
            
            // para evitar erros, iremos ver se o diretorio já existe caso não iremos criar ele 
            if (!is_dir($diretorio)) {

                // Cria o diretório para armazenar as imagens e define as permissões, a parte de permissão é meio nada haver aqui, pois estamos lidando com as coisas localmente 
                mkdir($diretorio, 0755);
            }
            
            // um dilema que tem ao querer usar imagem no banco de dados, é que o nome do arquivo precisa seguir um padrão, até por questão de espaço
            // e por conta disso uma siada que tinhamos, era usar informaçoes do sistema, então iremos fazer isso nessa etapa 

            $currentDateTime = date('YmdHis');// pega a data e hora do momento do envio
            
            $extension = pathinfo($arquivo['name'], PATHINFO_EXTENSION);//vai renomear a imagem para a informação que pegamos do sistema
            
            $nome_arquivo = $currentDateTime . '.' . $extension;// e iremos renomear essa imagem, para manter um padrão assim como falen antes
            
            move_uploaded_file($arquivo['tmp_name'], $diretorio . $nome_arquivo);  // Move a imagem enviada para o diretorio que criamos antes
            
            // Atualiza o campo da imagem na consulta SQL para verificar se ela foi adicionada certinho
            $sql_atualizar = "UPDATE tb_produto SET images='$nome_arquivo' WHERE id_produto ='$ultimo_id'";
            
            // Executa a consulta SQL para atualizar o campo da imagem.
            if (mysqli_query($_con, $sql_atualizar)) {
                //echo "<br>Imagem adicionada com sucesso";
            } else {
                echo "<br>Error ao adicionar imagem: " . mysqli_error($_con);
            }
        }
        //echo "<br>Novo registro criado com sucesso";
    } else {
        echo "<br>Error: " . mysqli_error($_con);
    }


    // e assim como no cliene, queremos mostra que os itens realmernte foram adicionado com sucesso, poderiamos colocar uma simples mensagem "produto adicionado com sucesso", mas isso não tem graça nenhuma

    $sql_select = "SELECT * FROM tb_produto ORDER BY id_produto DESC LIMIT 1";// o DESC LIMIT é responsavel por limitar os itens que seram exibitos apenas para o ultimo adicionado
    $result = mysqli_query($_con, $sql_select);
    
    if ($result && mysqli_num_rows($result) > 0) {
        
        $row = mysqli_fetch_assoc($result); // verifica se há algum registro na tabela para que possa ser exibito

        // Exibe as informações do último registro
        echo "<div class='ultimo-registro'>";
        echo "<h2>Último Produto:</h2>";
        echo "<p class='linha-superior linha-inferior'>produto: " . $row["Nome_produto"] . "</p>";
        echo "<p class='linha-inferior'><strong>Valor:</strong> " . $row["Valor_do_Produto"] . "</p>";
        
        // Verifica se a imagem existe e caso ela exista ou seja se ela foi adicionada, é para ela ser exibida... na teoria
        if (!empty($row["images"])) {
            echo "<img class='imagens' src='../imagens/" . $row["id_produto"] . "/" . $row["images"] . "' alt='Imagem do Produto'>";
        }
        
        echo "<a href='../index.html'>";
        echo "<button type='button' class='button'>";
        echo "<span class='button__text'>Voltar</span>";
        echo "</button>";
        echo "</a>";
        
        echo "<a href='../HTML/produtos.html'>";
        echo "<button type='button' class='buttonn'>";
        echo "<span class='button__text'>Adicionar</span>";
        echo "</button>";
        
        echo "</a>";
        echo "</div>";
    } else {
        echo "Nenhum produto cadastrado.";
    }
    
    mysqli_close($_con); // Fechamos a coneção com o banco de dados, por  boas praticas, pois na teoria se deixaar aberto ele ficara vulnerável
    ?>
</body>

</html>