<?php
/* Este documento cria a conexão com o banco de dados. Sem ele, a parte do PHP perde sua funcionalidade. */

include "teste.php";  


// Verifica se a variável "term" poderiamos usar outro nome, mas sempre se lembre se mudar de um lugar vai ter que mudar de todos está definida na requisição POST
if (isset($_POST['term'])) {

    // Obtém o valor da variável "term" e realiza a devida busca no banco de dados que nesse caso é o sql
    $term = mysqli_real_escape_string($_con, $_POST['term']);
    
    // Cria a consulta SQL para buscar clientes no banco de dados de acordo com que o usuario digitar, como estamos sugerindo os nomes conforme o usuario digita usamos a "%" antes e apos da nossa variave, pois ela serve para pegar o pedaço da palava exemplo se digitar "cic" a sugestão que aparece pode ser "bicicleta" e por ai vai, mas depende das informçoes que tem no banco de daos
    $query = "SELECT cliente FROM tb_cliente WHERE cliente LIKE '$term'";
    
    // vai buscar a palavra ou o pedaço dela no banco de dados para ser mais especifico em tb_cliente na coluna cliente, pois estamos buscando por um nome, mas tambem poderiamos usar essa logica para pesquisar um id como cpf
    $result = mysqli_query($_con, $query);
    
    // Verifica se a consulta foi executada com sucesso
    if ($result) {
        
        // Como estamos trabalhando com sugestoes pode haver mais de uma, pois como vimos anteriomente não importa em qual posiçao esteja as letras que voce digitous se tiver na palavra ela vai ser sugerida
        // e por conta disso falamos que a sugestão é um array, e caso não se lembre do primeiro semetre é uma variavel que possui multiplos valores dentro dela
        $sugestoes = array();
        
        // vai pecorrer esse array até encontrar apenas um resultado como um nome ou até o banco de dados acabar e não encontrar uma correspondencia
        while ($row = mysqli_fetch_assoc($result)) {
            $sugestoes[] = $row['cliente'];
        }
        
        // Converte o array de sugestões para o formato JSON essa parte não vou explicar pois nem eu entendi direito
        echo json_encode($sugestoes);
    }
}
?>
