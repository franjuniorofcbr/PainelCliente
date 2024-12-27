<?php

class Service {
    private static $baseUrl;

    public static function init() {
        self::$baseUrl = getenv('PAINELCLIENT_BASE_URL') ?: "https://api.painelcliente.com";
    }

    private static function validateOptions($options) {
        if (!isset($options['body']) || !is_array($options['body'])) {
            throw new InvalidArgumentException("The 'body' field is required and must be an array.");
        }
        if (!isset($options['body']['secret']) || empty($options['body']['secret'])) {
            throw new InvalidArgumentException("The 'secret' field is required and cannot be empty.");
        }
    }

    private static function handleResponse($response) {
        $decoded = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new RuntimeException("Invalid JSON response: " . json_last_error_msg());
        }
        return $decoded;
    }

    public static function request($endpoint, $options) {
        self::validateOptions($options);

        $url = self::$baseUrl . $endpoint;
        $headers = [
            "Content-Type: application/json",
        ];

        $body = json_encode($options['body'], JSON_THROW_ON_ERROR);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new RuntimeException("cURL error: $error");
        }

        curl_close($ch);

        return self::handleResponse($response);
    }

    public static function getProfile($token, $secret) {
        return self::request("/profile/{$token}", [
            "body" => ["secret" => $secret]
        ]);
    }

    public static function getBouquets($token, $secret) {
        return self::request("/bouquets/{$token}", [
            "body" => ["secret" => $secret]
        ]);
    }

    public static function createClient($token, $secret, $data) {
        $body = array_merge(["secret" => $secret], $data);
        return self::request("/create_client/{$token}", [
            "body" => $body
        ]);
    }

    public static function updateClient($token, $secret, $data) {
        $body = array_merge(["secret" => $secret], $data);
        return self::request("/update_client/{$token}", [
            "body" => $body
        ]);
    }

    public static function renewClient($token, $secret, $username, $month) {
        return self::request("/renew_client/{$token}", [
            "body" => [
                "secret" => $secret,
                "username" => $username,
                "month" => $month
            ]
        ]);
    }

    public static function blockClient($token, $secret, $username, $status) {
        return self::request("/block_client/{$token}", [
            "body" => [
                "secret" => $secret,
                "username" => $username,
                "status" => $status
            ]
        ]);
    }
}

Service::init();

// Exemplo de uso:
try {
    $profile = Service::getProfile("YOUR_TOKEN", "YOUR_SECRET_KEY");
    print_r($profile);

    $bouquets = Service::getBouquets("YOUR_TOKEN", "YOUR_SECRET_KEY");
    print_r($bouquets);

    $newClient = Service::createClient("YOUR_TOKEN", "YOUR_SECRET_KEY", [
        "username" => "novo_cliente",
        "password" => "senha123",
        "idbouquet" => [1, 2, 3, 4],
        "month" => 12,
        "connections" => 2,
        "notes" => "Cliente VIP"
    ]);
    print_r($newClient);

    $updateClient = Service::updateClient("YOUR_TOKEN", "YOUR_SECRET_KEY", [
        "username" => "cliente_existente",
        "password" => "nova_senha",
        "idbouquet" => [1, 2],
        "notes" => "Atualizado para plano básico"
    ]);
    print_r($updateClient);

    $renewClient = Service::renewClient("YOUR_TOKEN", "YOUR_SECRET_KEY", "cliente_existente", 6);
    print_r($renewClient);

    $blockClient = Service::blockClient("YOUR_TOKEN", "YOUR_SECRET_KEY", "cliente_existente", true);
    print_r($blockClient);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>
