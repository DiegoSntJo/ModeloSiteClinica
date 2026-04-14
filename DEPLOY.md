# Deploy na InfinityFree

## Secrets do GitHub Actions

Crie estes secrets no repositorio:

- `FTP_SERVER`: host FTP da InfinityFree.
- `FTP_USERNAME`: usuario FTP.
- `FTP_PASSWORD`: senha FTP.

## Primeiro deploy

O workflow envia o projeto para `/htdocs/` e nao sobrescreve `config/database.local.php`.

Depois do primeiro deploy, crie manualmente no servidor o arquivo `config/database.local.php` com base em `config/database.local.example.php` e preencha as credenciais reais do MySQL da InfinityFree.

## Banco de dados

O projeto usa duas conexoes configuraveis:

- `auth`: login e cadastro.
- `appointments`: agendamentos.

Se voce usar um unico banco na InfinityFree, pode apontar as duas secoes para a mesma base.