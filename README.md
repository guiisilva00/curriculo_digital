# Currículo Digital

Projeto desenvolvido para fins educacionais com o objetivo de revisar os conceitos de **HTML5, CSS3, PHP e MySQL**, utilizando um CRUD completo sem o uso de JavaScript.

## Objetivo

Desenvolver uma plataforma simples onde o usuário poderá:

- Criar um currículo digital completo;
- Visualizar seus currículos cadastrados com formatação profissional;
- Editar informações em múltiplas seções;
- Excluir currículos com segurança;
- Organizar experiências, formação, habilidades, idiomas, certificados e projetos de forma estruturada.

O foco principal é praticar a integração entre PHP e MySQL utilizando PDO e um CRUD genérico, com boas práticas de segurança e organização de código.

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
├── index.php
├── cadastrar.php
├── salvar.php
├── listar_curriculos.php
├── visualizar.php
├── editar.php
├── atualizar.php
├── excluir.php
│
├── script.sql
└── README.md
```

---

# Banco de Dados

O banco foi estruturado de forma normalizada para facilitar o relacionamento entre as informações do currículo.

## Tabelas

- `dados_pessoais` - Informações básicas do usuário
- `contatos` - Dados de contato (email, telefone, redes sociais)
- `experiencias` - Histórico profissional
- `formacao` - Educação e cursos
- `habilidades` - Competências técnicas
- `idiomas` - Idiomas e proficiência
- `certificados` - Certificações profissionais
- `projetos` - Portfólio de projetos

Todas as tabelas relacionadas utilizam:

```sql
ON DELETE CASCADE
```

Permitindo que, ao excluir um currículo, todos os seus registros relacionados sejam removidos automaticamente.

---

# Fluxo do Sistema

```
Página Inicial
    ↓
Novo Currículo (Cadastro com múltiplas seções)
    ↓
Salvar no banco de dados
    ↓
Listagem de Currículos (Cards com ações)
    ↓
Visualização (Currículo formatado e profissional)
    ↓
Editar (Formulário pré-preenchido)
    ↓
Atualizar no banco de dados
    ↓
Excluir (Com confirmação e cascata)
```

---

# Página Inicial

A página inicial possui um layout moderno e responsivo contendo:

- Título do sistema com tipografia clara
- Breve descrição do propósito
- Dois botões de ação principais
- Design com gradiente de fundo e glassmorphism
- Footer com informações do desenvolvedor

---

# Cadastro

O formulário é dividido em **8 seções principais** utilizando `fieldset`:

### Dados Pessoais
- Nome
- Cargo
- Resumo Profissional
- Objetivo Profissional
- Data de Nascimento
- Cidade
- Estado

### Contato
- E-mail
- Telefone
- LinkedIn
- GitHub
- Site Pessoal

### Experiência Profissional
- Empresa
- Função
- Período de Início
- Período de Fim
- Checkbox: Trabalho Atual
- Descrição da Experiência

### Formação Acadêmica
- Instituição
- Curso
- Período de Início
- Período de Fim
- Checkbox: Cursando Atualmente
- Descrição

### Habilidades
- Habilidade (texto)
- Nível (Básico, Intermediário, Avançado)

### Idiomas
- Idioma (texto)
- Nível (Básico, Intermediário, Avançado, Fluente, Nativo)

### Certificados
- Nome do Certificado
- Instituição
- Data de Conclusão
- URL do Certificado

### Projetos
- Nome do Projeto
- Tecnologias Utilizadas
- Link do Projeto
- Descrição

---

# CRUD

O projeto utiliza um **CRUD genérico baseado em PDO**, reutilizável em qualquer tabela do banco de dados.

## Métodos Disponíveis

### `create($pdo, $table, $data)`
Responsável por inserir novos registros no banco.
```php
$id = create($pdo, "dados_pessoais", [
    "nome" => "João Silva",
    "cargo" => "Desenvolvedor"
]);
```

### `read($pdo, $table, $where)`
Retorna **um único registro** com base em uma condição WHERE.
```php
$curriculo = read($pdo, "dados_pessoais", "id = 1");
```

### `readAll($pdo, $table, $where)`
Retorna **vários registros** com base em uma condição WHERE.
```php
$curriculos = readAll($pdo, "dados_pessoais");
```

### `update($pdo, $table, $data, $where)`
Atualiza um registro existente.
```php
update($pdo, "dados_pessoais", [
    "nome" => "João Pedro",
    "cargo" => "Senior Developer"
], "id = 1");
```

### `delete($pdo, $table, $where)`
Remove registros do banco.
```php
delete($pdo, "dados_pessoais", "id = 1");
```

---

# Organização do Código

O projeto foi estruturado de forma modular e reutilizável:

## Header
Não é utilizado atualmente, mas está disponível em:
```
partials/header.php
```

## Footer
Todos as páginas utilizam:
```
partials/footer.php
```

Contém informações de copyright e desenvolvedor.

---

# Layout e Design

O projeto utiliza um **design moderno e responsivo** com as seguintes características:

- **Fundo**: Gradiente linear (135deg) entre cores azuis claras (#f6f8fd → #f1f5f9)
- **Containers**: Efeito glassmorphism com:
  - Fundo translúcido (rgba com 90% opacidade)
  - Blur backdrop de 10px
  - Bordas arredondadas (border-radius: 16px)
  - Sombras leves e elegantes
  - Transições suaves ao hover
  
- **Cor Principal**: Azul (#3b82f6) para botões e destaques
- **Tipografia**: Font 'Inter' (Google Fonts) com pesos 300-700
- **Layout**: Flexbox e CSS Grid para responsividade
- **Cores Secundárias**: Cinzas (para texto e bordas)

### Componentes Principais

- **Botões**: Gradiente azul com shadow, efeito hover de elevação
- **Formulários**: Grid responsivo com 2+ colunas
- **Cards (Listagem)**: Layout em grade com efeito hover
- **Currículo (Visualização)**: Seções bem definidas com tipografia hierárquica

---

# Refatoração Semântica (v2.0)

As classes CSS foram refatoradas para nomes **descritivos e em português**, melhorando a legibilidade do código:

### Mapeamento de Classes Atualizadas

| Antes | Depois |
|-------|--------|
| `formulario` | `conteiner-formulario` |
| `title` | `titulo-pagina` |
| `text` | `descricao-pagina` |
| `botoes` | `grupo-botoes` |
| `btn` | `botao` |
| `secundario` | `botao-secundario` |
| `campo` | `campo-formulario` |
| `full` | `largura-total` |
| `form-grid` | `grade-formulario` |
| `cards-grid` | `grade-curriculos` |
| `card` | `cartao-curriculo` |
| `cv-header` | `cabecalho-curriculo` |
| `cv-name` | `nome-curriculo` |
| `cv-section` | `secao-curriculo` |
| `cv-item` | `item-curriculo` |
| `pill` | `etiqueta-destaque` |

---

# Ordem de Desenvolvimento

- [x] Estrutura do banco de dados
- [x] Organização das pastas
- [x] Página inicial
- [x] Header e Footer
- [x] Formulário de cadastro (8 seções)
- [x] Salvar currículo
- [x] Listagem dos currículos
- [x] Visualização completa com formatação profissional
- [x] Edição de informações
- [x] Exclusão com cascata
- [x] Refatoração semântica de CSS e HTML
- [x] Upload de foto (fase 2)
- [ ] Sistema de autenticação (fase 2)
- [ ] Exportação para PDF (fase 3)
- [ ] Validação Server-Side dos dados (fase 3)
- [ ] Suporte a múltiplos itens (Múltiplas experiências, cursos) (fase 4)
- [ ] Opção de Compartilhamento via Link Público (fase 4)

---

# Objetivo Final

Ao término do projeto, o usuário é capaz de:

✅ Criar um **currículo completo** com todas as informações profissionais  
✅ **Visualizar** todas as informações organizadas de forma profissional  
✅ **Editar** qualquer informação em tempo real  
✅ **Excluir** currículos com segurança  
✅ **Manter** todas as informações relacionadas através de chaves estrangeiras  
✅ Entender **boas práticas** de desenvolvimento PHP/MySQL  

---

# Observações

Este projeto possui **finalidade exclusivamente educacional**.

O foco principal é revisar e aprofundar conceitos de:

- HTML5 semântico
- CSS3 com layouts modernos
- PHP 8+ com OOP
- PDO para segurança de banco de dados
- MySQL com relacionamentos e cascata
- CRUD genérico e reutilizável
- Organização e modularização de projetos
- Refatoração de código (boas práticas)
- Sem dependência de frameworks ou JavaScript

**Princípios Aplicados:**
- Segurança contra SQL Injection (PDO com prepared statements)
- Escapamento de saída (htmlspecialchars)
- Separação de conceitos (MVC-like)
- DRY (Don't Repeat Yourself)
- Código limpo e legível

---

Desenvolvido por **Guilherme Silva** © 2026
