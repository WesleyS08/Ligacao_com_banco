<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se a requisição é do tipo POST

    // Recupera os dados do formulário
    $valordosItens = $_POST['valordosItens'] ?? '';
    $valorFrete = $_POST['valorFrete'] ?? '';
    $valorCompleto = $_POST['valorCompleto'] ?? '';
    $pagamento = $_POST['pagamento'] ?? '';
    $shipping = $_POST['shipping'] ?? '';
    $parcelas = $_POST['parcelas'] ?? '';
    $valorParcelado = $_POST['valorParcelado'] ?? '';
    $descricao = $_POST['descricao'] ?? '';

    // Processa os dados como necessário
    // ...

    // Exemplo de exibição dos dados recebidos
    echo "Valor dos Itens: $valordosItens<br>";
    echo "Valor do Frete: $valorFrete<br>";
    echo "Valor Total: $valorCompleto<br>";
    echo "Meio de Pagamento: $pagamento<br>";
    echo "Forma de Entrega: $shipping<br>";
    echo "Quantidade de Parcelas: $parcelas<br>";
    echo "Valor Parcelado: $valorParcelado<br>";
    echo "Descrição: $descricao<br>";
}
?>
