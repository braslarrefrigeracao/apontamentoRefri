<?php 
function fazerPedido($pedido) {
    $url = "https://localhost/apirest/";

    $username = 'jonas';
    $password = 'maluco1';

    // Codifica as credenciais em Base64
    $credentials = base64_encode("$username:$password");

    // Inicializa a sessão cURL
    $ch = curl_init();

    

    // Configura as opções do cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true); // Define a requisição como POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('pedido' => $pedido))); // Define os dados do POST
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Basic ' . $credentials,
        'Content-Type: application/x-www-form-urlencoded'
    ));
    // Ignora a verificação do certificado SSL (uso somente em desenvolvimento)
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    // Executa a requisição
    $response = curl_exec($ch);

    // Verifica se houve erros na execução
    if(curl_errno($ch)) {
        echo 'Erro no cURL: ' . curl_error($ch);
    } else {
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_code == 200) {
            // Converte a resposta para JSON
            $dados = json_decode($response, true);
            return $dados;
        } else {
            echo "Erro na requisição: HTTP Status Code {$http_code}";
        }
    }

    // Fecha a sessão cURL
    curl_close($ch);
}

// Exemplo de uso da função
$resultado = fazerPedido('12345');
print_r($resultado);
?>
