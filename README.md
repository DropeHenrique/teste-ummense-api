# Projeto de Teste no Laravel

Este é um projeto de exemplo para demonstrar como escrever testes funcionais no Laravel para ações básicas de CRUD em um controlador de usuário.

## Requisitos

- **PHP**: 7.4 ou superior
- **Composer**
- **Laravel**: 10.x
- **PHPUnit**: 9.x

## Instalação

1. **Clone o repositório:**

    ```bash
    git clone https://github.com/seu-usuario/seu-projeto.git
    cd seu-projeto
    ```

2. **Instale as dependências do Composer:**

    ```bash
    composer install
    ```

3. **Copie o arquivo `.env.example` para `.env` e configure suas variáveis de ambiente, incluindo as configurações de banco de dados:**

    ```bash
    cp .env.example .env
    ```

4. **Gere uma chave de aplicativo:**

    ```bash
    php artisan key:generate
    ```

5. **Execute as migrações do banco de dados e as sementes para criar as tabelas necessárias e adicionar dados iniciais:**

    ```bash
    php artisan migrate --seed
    ```

6. **Execute os testes para garantir que tudo está funcionando corretamente:**

    ```bash
    php artisan test
    ```

## Uso

Este projeto inclui testes funcionais básicos para as seguintes ações de usuário:

- Criar usuário
- Atualizar usuário
- Excluir usuário

Os testes estão localizados no diretório `tests/Feature` e podem ser executados usando o comando `php artisan test`.

## Personalização

Você pode personalizar os testes, as visões e o controlador de acordo com as necessidades do seu projeto. As visões estão localizadas no diretório `resources/views` e o controlador está em `app/Http/Controllers/UserController.php`.


## Contribuição

Sinta-se à vontade para contribuir com melhorias ou correções de bugs. Crie uma solicitação de recebimento (pull request) e teremos o prazer de analisá-la.

---

