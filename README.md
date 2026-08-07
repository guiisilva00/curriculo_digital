# Currículo Digital

Projeto educacional para revisar **HTML5, CSS3, PHP e MySQL** com um CRUD completo, sem JavaScript.

## Objetivo

Plataforma simples para:

- Criar um currículo digital completo
- Visualizar currículos com formatação profissional
- Editar informações em múltiplas seções
- Excluir currículos com segurança (ON DELETE CASCADE)

## Tecnologias

- HTML5 / CSS3
- PHP 8+
- MySQL + PDO
- XAMPP

## Estrutura do Projeto

```
curriculo-digital/
├── config/
│   ├── conexao.php
│   └── crud.php
├── css/
│   └── style.css
├── index.php
├── cadastrar.php
├── salvar.php
├── editar.php
├── atualizar.php
├── visualizar.php
├── listar.php
├── excluir.php
├── script.sql
└── README.md
```

## Instalação

1. Clone o repositório na pasta `htdocs` do XAMPP
2. Importe o banco de dados:

```bash
mysql -u root < script.sql
```

3. Configure a conexão em `config/conexao.php` (ou copie `.env.example` para referência)
4. Acesse `http://localhost/curriculo_digital/`

## Banco de Dados

5 tabelas normalizadas com `ON DELETE CASCADE`:

| Tabela | Descrição |
|--------|-----------|
| `dados_pessoais` | Nome, cargo, resumo, objetivo, localização |
| `contatos` | Email, telefone, LinkedIn, GitHub, site |
| `experiencias` | Histórico profissional |
| `formacao` | Educação e cursos |
| `projetos` | Portfólio de projetos |

## Fluxo do Sistema

```
index.php → cadastrar.php → salvar.php → listar.php
                ↓                              ↓
         visualizar.php ← editar.php ← atualizar.php
                ↓
           excluir.php
```

## CRUD Genérico

Funções em `config/crud.php`:

```php
create($pdo, $table, $data)           // INSERT
read($pdo, $table, $where)            // SELECT one
readAll($pdo, $table, $where)         // SELECT all
update($pdo, $table, $data, $where)   // UPDATE
delete($pdo, $table, $where)          // DELETE
```

Exemplo de uso:

```php
$id = create($pdo, "dados_pessoais", [
    "nome"  => trim($_POST["nome"] ?? ''),
    "cargo" => trim($_POST["cargo"] ?? '')
]);
```

## Seções do Formulário

1. **Dados Pessoais** — nome, cargo, resumo, objetivo, nascimento, cidade, estado
2. **Contato** — email, telefone, LinkedIn, GitHub, site pessoal
3. **Experiência Profissional** — empresa, função, período, descrição
4. **Formação Acadêmica** — instituição, curso, período, descrição
5. **Projetos** — nome, tecnologias, link, descrição

## Validação

- **Frontend:** atributo `required` nos campos obrigatórios
- **Backend:** `empty()` e `trim()` nos campos essenciais

## Design

- Gradiente e glassmorphism (padrão Sync)
- Classes CSS (`titulo-pagina`, `cartao-curriculo`, etc.)
- Footer inline em todas as páginas
- Responsivo com CSS Grid e Flexbox

## Fases Futuras

| Fase | Recurso |
|------|---------|
| 2 | Upload de foto, exportação PDF (`exportar_pdf.php`) |
| 3 | Múltiplos itens por seção, habilidades, idiomas, certificados |
| 4 | Autenticação de usuário, link público de compartilhamento |

## Princípios Aplicados

- PDO com prepared statements (SQL Injection)
- `htmlspecialchars()` na saída (XSS)
- POST-redirect-GET após salvar/atualizar/excluir
- Código procedural simples e legível
- Sem frameworks, sem JavaScript

---

Desenvolvido por **Guilherme Silva** © 2026
