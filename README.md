````markdown
# Currículo Digital

Projeto desenvolvido para fins educacionais com o objetivo de revisar os conceitos de **HTML5, CSS3, PHP e MySQL**, utilizando um CRUD completo sem o uso de JavaScript.

## Objetivo

Desenvolver uma plataforma simples onde o usuário poderá:

- Criar um currículo digital;
- Visualizar seus currículos cadastrados;
- Editar informações;
- Excluir currículos;
- Organizar experiências, formação, habilidades e demais informações profissionais.

O foco principal é praticar a integração entre PHP e MySQL utilizando PDO e um CRUD genérico.

---

# Tecnologias

- HTML5
- CSS3
- PHP 8+
- MySQL
- PDO
- XAMPP

---

# Estrutura do Projeto

```
curriculo-digital/
│
├── config/
│   ├── conexao.php
│   └── crud.php
│
├── css/
│   └── style.css
│
├── partials/
│   ├── header.php
│   └── footer.php
│
├── uploads/
│   └── fotos/
│
├── index.php
├── cadastrar.php
├── salvar.php
├── listar_curriculos.php
├── visualizar.php
├── editar.php
├── atualizar.php
├── excluir.php
│
└── README.md
```

---

# Banco de Dados

O banco foi estruturado de forma normalizada para facilitar o relacionamento entre as informações do currículo.

## Tabelas

- dados_pessoais
- contatos
- experiencias
- formacao
- habilidades
- idiomas
- certificados
- projetos

Todas as tabelas relacionadas utilizam:

```sql
ON DELETE CASCADE
```

permitindo que, ao excluir um currículo, todos os seus registros relacionados sejam removidos automaticamente.

---

# Fluxo do Sistema

```
Index

↓

Novo Currículo

↓

Cadastro

↓

Salvar

↓

Listagem

↓

Visualização

↓

Editar

↓

Atualizar

↓

Excluir
```

---

# Página Inicial

A página inicial possui um layout simples contendo:

- Nome do sistema;
- Breve descrição;
- Botão para cadastrar um novo currículo;
- Botão para visualizar currículos cadastrados.

---

# Cadastro

O formulário será dividido em seções utilizando `fieldset`.

## Dados Pessoais

- Nome
- Cargo
- Resumo
- Objetivo
- Data de nascimento
- Cidade
- Estado

## Contato

- Email
- Telefone
- LinkedIn
- GitHub
- Site Pessoal

## Futuras Seções

- Experiência
- Formação
- Habilidades
- Idiomas
- Certificados
- Projetos

---

# CRUD

O projeto utilizará um CRUD genérico baseado em PDO.

## Métodos disponíveis

### Create

```php
create()
```

Responsável por inserir registros no banco.

---

### Read

```php
read()
```

Retorna apenas um registro.

---

### ReadAll

```php
readAll()
```

Retorna vários registros.

---

### Update

```php
update()
```

Atualiza um registro existente.

---

### Delete

```php
delete()
```

Remove registros.

---

# Organização do Código

Foi adotada uma estrutura modular utilizando arquivos reutilizáveis.

## Header

Todas as páginas utilizarão:

```
partials/header.php
```

---

## Footer

Todas as páginas utilizarão:

```
partials/footer.php
```

Foi identificado durante o desenvolvimento que o footer estava sendo renderizado duas vezes devido ao arquivo parcial possuir uma tag `<footer>` sendo envolvida por outra `<footer>` na página principal.

A solução foi manter apenas um único elemento `<footer>`.

---

# Layout

O projeto utiliza um design simples e moderno.

Características:

- Fundo cinza claro;
- Containers brancos;
- Cantos arredondados;
- Sombras leves;
- Azul como cor principal;
- Layout centralizado utilizando Flexbox;
- Formulários organizados com CSS Grid.

---

# Organização dos Formulários

Cada grupo de informações ficará separado por `fieldset`.

Exemplo:

```
Dados Pessoais

Contato

Experiência

Formação
```

Dentro de cada seção os campos serão organizados utilizando Grid com duas colunas.

---

# Upload de Foto

A implementação do upload ficará para uma etapa futura.

Inicialmente o sistema será desenvolvido sem upload para facilitar os testes do CRUD.

Posteriormente será criada a pasta:

```
uploads/fotos/
```

para armazenar as imagens de perfil.

---

# Ordem de Desenvolvimento

- [x] Estrutura do banco de dados
- [x] Organização das pastas
- [x] Página inicial
- [x] Header
- [x] Footer
- [x] Início do formulário de cadastro
- [ ] Salvar currículo
- [ ] Listagem dos currículos
- [ ] Visualização completa
- [ ] Edição
- [ ] Exclusão
- [ ] Upload de foto
- [ ] Habilidades
- [ ] Idiomas
- [ ] Projetos
- [ ] Certificados

---

# Objetivo Final

Ao término do projeto o usuário será capaz de:

- Criar um currículo completo;
- Visualizar todas as informações organizadas em uma página;
- Editar qualquer informação;
- Excluir currículos;
- Manter todas as informações relacionadas através de chaves estrangeiras.

---

# Observações

Este projeto possui finalidade exclusivamente educacional.

O foco principal é revisar conceitos de:

- HTML5
- CSS3
- PHP
- PDO
- MySQL
- CRUD
- Relacionamentos entre tabelas
- Organização de projetos PHP

sem utilizar JavaScript, priorizando o desenvolvimento no lado do servidor.

---

Desenvolvido por **Guilherme Silva** © 2026
````
