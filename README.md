# PainelCliente PHP SDK

## Descrição

Este é um SDK em PHP para integrar-se à API do PainelCliente. Ele oferece métodos simples para acessar os principais endpoints da API, como criação de clientes, gerenciamento de planos (bouquets), renovação de clientes, entre outros.

## Instalação

1. Clone este repositório ou faça o download dos arquivos:

```bash
git clone https://github.com/seu-usuario/painelcliente-php-sdk.git
```

2. Inclua os arquivos do SDK no seu projeto.

## Uso

### Configuração Básica

Todos os métodos da API exigem os campos `secret` e `TOKEN` para autenticação. Certifique-se de ter estas informações antes de utilizar o SDK.

### Exemplo de Uso

#### Obter Perfil do Revendedor

```php
require_once 'Service.php';

$profile = Service::Request("/profile/YOUR_TOKEN", [
    "body" => [
        "secret" => "YOUR_SECRET_KEY"
    ]
]);

print_r($profile);
```

#### Obter Bouquet

```php
$bouquets = Service::Request("/bouquets/YOUR_TOKEN", [
    "body" => [
        "secret" => "YOUR_SECRET_KEY"
    ]
]);

print_r($bouquets);
```

#### Criar Cliente

```php
$newClient = Service::Request("/create_client/YOUR_TOKEN", [
    "body" => [
        "secret" => "YOUR_SECRET_KEY",
        "username" => "novo_cliente",
        "password" => "senha123",
        "idbouquet" => [1, 2, 3, 4],
        "month" => 12,
        "connections" => 2,
        "notes" => "Cliente VIP"
    ]
]);

print_r($newClient);
```

#### Atualizar Cliente

```php
$updateClient = Service::Request("/update_client/YOUR_TOKEN", [
    "body" => [
        "secret" => "YOUR_SECRET_KEY",
        "username" => "cliente_existente",
        "password" => "nova_senha",
        "idbouquet" => [1, 2],
        "notes" => "Atualizado para plano básico"
    ]
]);

print_r($updateClient);
```

#### Renovar Cliente

```php
$renewClient = Service::Request("/renew_client/YOUR_TOKEN", [
    "body" => [
        "secret" => "YOUR_SECRET_KEY",
        "username" => "cliente_existente",
        "month" => 6
    ]
]);

print_r($renewClient);
```

#### Bloquear Cliente

```php
$blockClient = Service::Request("/block_client/YOUR_TOKEN", [
    "body" => [
        "secret" => "YOUR_SECRET_KEY",
        "username" => "cliente_existente",
        "status" => true
    ]
]);

print_r($blockClient);
```

## Endpoints Suportados

### Geral
- **Obter Perfil do Revendedor**: `/profile/{TOKEN}`
- **Obter Bouquet**: `/bouquets/{TOKEN}`

### Clientes
- **Criar Cliente**: `/create_client/{TOKEN}`
- **Atualizar Cliente**: `/update_client/{TOKEN}`
- **Renovar Cliente**: `/renew_client/{TOKEN}`
- **Bloquear Cliente**: `/block_client/{TOKEN}`
- **Deletar Cliente**: `/delete_client/{TOKEN}`

## Requisitos
- PHP >= 7.4
- Extensão cURL habilitada

## Contribuição

Sinta-se à vontade para abrir issues ou enviar pull requests para melhorias.

## Licença

Este projeto está licenciado sob a [MIT License](LICENSE).

