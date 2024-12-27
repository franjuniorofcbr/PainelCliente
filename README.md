# PainelCliente PHP SDK 🚀

[![PHP Version](https://img.shields.io/badge/php-%3E%3D7.4-blue)](https://www.php.net/releases/)
[![License](https://img.shields.io/badge/license-MIT-green)](LICENSE)
[![Contributions](https://img.shields.io/badge/contributions-welcome-orange)](#contributing)

## Descrição

O **PainelCliente PHP SDK** é uma solução prática e eficiente para integrar-se à API do PainelCliente. Este SDK abstrai a complexidade das chamadas HTTP e oferece funções dedicadas para gerenciar perfis, clientes, planos (bouquets), e muito mais.

## Funcionalidades 🌟

- **Obter Perfil do Revendedor**
- **Gerenciamento de Planos (Bouquets)**
- **Criação, Atualização e Renovação de Clientes**
- **Bloqueio e Desbloqueio de Clientes**
- **Facilidade de Configuração e Uso**

## Instalação 📦

1. Clone este repositório ou faça o download dos arquivos:

```bash
git clone https://github.com/franjuniorofcbr/PainelCliente.git
```

2. Inclua os arquivos do SDK no seu projeto.

## Uso 🔧

### Configuração Inicial

Certifique-se de definir as variáveis sensíveis, como `baseUrl`, `token`, e `secret`, no ambiente do seu servidor ou diretamente no código.

### Exemplos de Uso 📝

#### Obter Perfil do Revendedor

```php
require_once 'Service.php';

try {
    $profile = Service::getProfile("YOUR_TOKEN", "YOUR_SECRET_KEY");
    print_r($profile);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
```

#### Criar Cliente

```php
try {
    $newClient = Service::createClient("YOUR_TOKEN", "YOUR_SECRET_KEY", [
        "username" => "novo_cliente",
        "password" => "senha123",
        "idbouquet" => [1, 2, 3, 4],
        "month" => 12,
        "connections" => 2,
        "notes" => "Cliente VIP"
    ]);
    print_r($newClient);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
```

#### Renovar Cliente

```php
try {
    $renewClient = Service::renewClient("YOUR_TOKEN", "YOUR_SECRET_KEY", "cliente_existente", 6);
    print_r($renewClient);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
```

## Requisitos 📋

- PHP >= 7.4
- Extensão cURL habilitada

## Endpoints Suportados 🌐

### Geral
- **Obter Perfil do Revendedor**: `/profile/{TOKEN}`
- **Obter Planos (Bouquets)**: `/bouquets/{TOKEN}`

### Clientes
- **Criar Cliente**: `/create_client/{TOKEN}`
- **Atualizar Cliente**: `/update_client/{TOKEN}`
- **Renovar Cliente**: `/renew_client/{TOKEN}`
- **Bloquear Cliente**: `/block_client/{TOKEN}`

## Contribuindo 🤝

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues ou enviar pull requests.

1. Faça um fork do repositório.
2. Crie uma branch para sua funcionalidade (`git checkout -b feature/nova-funcionalidade`).
3. Envie suas alterações (`git push origin feature/nova-funcionalidade`).
4. Abra um Pull Request.

## Contato 📬

- **Desenvolvedor**: [Francisco Junior](https://github.com/franjuniorofcbr)
- **E-mail**: francisco.junior@harpiadev.org

---

## Licença ⚖️

Este projeto está licenciado sob a [MIT License](LICENSE).

---

Feito com ❤️ por [Francisco Junior](https://github.com/franjuniorofcbr)

