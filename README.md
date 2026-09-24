# Sistema de Clínica/Consultório

Trabalho 1 - Desenvolvimento Web Servidor - UTFPR

## Integrantes
- Breno Gonzalez Vieira
- Matheus de Lima Santos

## Sobre o projeto
Sistema de gestão de clínica/consultório com cadastro de pacientes, profissionais e agendamento de consultas. Com autenticação via sessão

## Tecnologias
- PHP 8+
- MySQL (PDO)
- Bootstrap 5 (via CDN)

## Como instalar
1. Instale o XAMPP
2. Copie a pasta "trabalho1-desenvolvimento-web-servidor" para C:\xampp\htdocs
3. Inicie o Apache e o MySQL no XAMPP
4. Acesse http://localhost/phpmyadmin e importe o arquivo database/schema.sql
5. Acesse http://localhost/trabalho1-desenvolvimento-web-servidor/


## Login
- E-mail: admin@gmail.com
- Senha: 123456

## Particularidadess
- O sistema usa Bootstrap pela internet (CDN), então precisa de conexão para a página fica com o visual correto
- O CPF é salvo apenas com números, os pontos e o traço são removidos


## Problemas conhecidos
- Não há limite de tamanho validado nos campos de texto

## Distribuição de tarefas
- Breno: (estrutura inicial, README, conexão com o banco de dados (config.php), tabelas do banco (schema.sql), models (a parte que salva e busca os dados no banco))
- Matheus: (login e o logout do sistema, controllers (a parte que recebe os dados dos formulários e confere se estão certos), telas (views) com Bootstrap,)
