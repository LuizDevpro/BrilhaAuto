# BrilhaAuto

Sistema web para gerenciamento de agendamentos de lavagens automotivas desenvolvido com Laravel.

## Sobre o Projeto

O BrilhaAuto foi desenvolvido com o objetivo de digitalizar o processo de agendamento de serviços automotivos, permitindo que clientes realizem solicitações de forma simples e que administradores tenham controle completo sobre o gerenciamento dos atendimentos.

O projeto também foi utilizado como forma de aprofundar conhecimentos em desenvolvimento web full stack utilizando Laravel.

## Funcionalidades

* Cadastro e autenticação de usuários
* Controle de acesso baseado em permissões
* Níveis de usuário: Cliente, Administrador e SysAdmin
* Criação e gerenciamento de agendamentos
* Atualização de status dos serviços
* Painel administrativo
* Validação e tratamento de dados
* Interface responsiva

## Tecnologias Utilizadas

* PHP 8
* Laravel
* MySQL
* Tailwind CSS
* JavaScript
* Vite

## Instalação

Clone o repositório:

```bash
git clone https://github.com/seu-usuario/BrilhaAuto.git
```

Acesse a pasta do projeto:

```bash
cd BrilhaAuto
```

Instale as dependências:

```bash
composer install
npm install
```

Crie o arquivo de ambiente:

```bash
cp .env.example .env
```

Gere a chave da aplicação:

```bash
php artisan key:generate
```

Configure as informações do banco de dados no arquivo `.env` e execute:

```bash
php artisan migrate --seed
```

Inicie o servidor:

```bash
php artisan serve
npm run dev
```

## Estrutura de Permissões

| Perfil        | Permissões                                               |
| ------------- | -------------------------------------------------------- |
| Cliente       | Realizar e acompanhar agendamentos                       |
| Administrador | Gerenciar agendamentos e atualizar status                |
| SysAdmin      | Controle total do sistema e gerenciamento administrativo |

## Objetivos do Projeto

Este projeto foi desenvolvido para praticar conceitos como:

* Arquitetura MVC
* Autenticação e autorização
* Relacionamentos entre tabelas
* Regras de negócio
* Tratamento e validação de dados
* Desenvolvimento de painéis administrativos

## Demonstração

Link da aplicação: **Em breve**

## Autor

Desenvolvido por Luiz Antonio.
