# Autorização com JWT em PHP

Este é um projeto de autenticação simples em PHP utilizando tokens JWT (JSON Web Tokens). Ele inclui um formulário de login, validação de usuário e senha, geração de token JWT, e um sistema de verificação de token para acesso a páginas protegidas.

## Tecnologias Utilizadas

- PHP
- MySQL (para armazenar os dados do usuário)
- JWT (JSON Web Tokens)

## Estrutura do Projeto

O projeto contém os seguintes arquivos:

1. **connection.php**: Arquivo de conexão com o banco de dados MySQL.
2. **dashboard.php**: Página protegida, acessível somente para usuários autenticados.
3. **index.php**: Página de login e formulário para autenticação do usuário.
4. **logout.php**: Script PHP para logout do usuário, invalidando o token atual.
5. **validate_token.php**: Arquivo contendo funções para validar e recuperar dados do token JWT.
6. **authorization_jwt.sql**: Arquivo SQL para criar a tabela de usuários no banco de dados.

## Configuração

1. **Banco de Dados**:
   - Importe o arquivo `authorization_jwt.sql` para criar a tabela de usuários.

2. **Conexão com o Banco de Dados**:
   - Configure as credenciais de conexão no arquivo `connection.php`.

3. **Chave Secreta JWT**:
   - A chave secreta JWT é definida no arquivo `validate_token.php`.

## Instalação

1. Clone o repositório:

   ```bash
   git clone https://github.com/darkronum/Authorization_JWT.git
