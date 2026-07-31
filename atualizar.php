<?php
require_once("config/conexao.php");
require_once("config/crud.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["id"])) {
    $id = intval($_POST["id"]);

    // 1. Atualizar Dados Pessoais
    update($pdo, "dados_pessoais", [
        "nome" => $_POST["nome"] ?? '',
        "cargo" => $_POST["cargo"] ?? '',
        "resumo" => $_POST["resumo"] ?? '',
        "objetivo" => $_POST["objetivo"] ?? '',
        "nascimento" => !empty($_POST["nascimento"]) ? $_POST["nascimento"] : null,
        "cidade" => $_POST["cidade"] ?? '',
        "estado" => $_POST["estado"] ?? ''
    ], "id = $id");

    // 2. Atualizar Contatos
    update($pdo, "contatos", [
        "email" => $_POST["email"] ?? '',
        "telefone" => $_POST["telefone"] ?? '',
        "linkedin" => $_POST["linkedin"] ?? '',
        "github" => $_POST["github"] ?? '',
        "site_pessoal" => $_POST["site_pessoal"] ?? ''
    ], "dados_pessoais_id = $id");

    // Para as tabelas filhas opcionais, a estratégia mais segura para um CRUD simples
    // é limpar os registros antigos deste usuário e inserir os novos, caso tenham sido preenchidos.
    // Isso evita problemas de dar UPDATE em algo que não existia antes.

    // 3. Experiência
    delete($pdo, "experiencias", "dados_pessoais_id = $id");
    if (!empty($_POST["empresa"])) {
        create($pdo, "experiencias", [
            "dados_pessoais_id" => $id,
            "empresa" => $_POST["empresa"],
            "funcao" => $_POST["funcao"] ?? '',
            "periodo_inicio" => !empty($_POST["exp_inicio"]) ? $_POST["exp_inicio"] : null,
            "periodo_fim" => !empty($_POST["exp_fim"]) ? $_POST["exp_fim"] : null,
            "trabalho_atual" => isset($_POST["trabalho_atual"]) ? 1 : 0,
            "descricao" => $_POST["exp_descricao"] ?? ''
        ]);
    }

    // 4. Formação
    delete($pdo, "formacao", "dados_pessoais_id = $id");
    if (!empty($_POST["instituicao"])) {
        create($pdo, "formacao", [
            "dados_pessoais_id" => $id,
            "instituicao" => $_POST["instituicao"],
            "curso" => $_POST["curso"] ?? '',
            "periodo_inicio" => !empty($_POST["formacao_inicio"]) ? $_POST["formacao_inicio"] : null,
            "periodo_fim" => !empty($_POST["formacao_fim"]) ? $_POST["formacao_fim"] : null,
            "cursando" => isset($_POST["cursando"]) ? 1 : 0,
            "descricao" => $_POST["formacao_descricao"] ?? ''
        ]);
    }

    // 5. Habilidades
    delete($pdo, "habilidades", "dados_pessoais_id = $id");
    if (!empty($_POST["habilidade"])) {
        create($pdo, "habilidades", [
            "dados_pessoais_id" => $id,
            "habilidade" => $_POST["habilidade"],
            "nivel" => $_POST["habilidade_nivel"] ?? 'Intermediário'
        ]);
    }

    // 6. Idiomas
    delete($pdo, "idiomas", "dados_pessoais_id = $id");
    if (!empty($_POST["idioma"])) {
        create($pdo, "idiomas", [
            "dados_pessoais_id" => $id,
            "idioma" => $_POST["idioma"],
            "nivel" => $_POST["idioma_nivel"] ?? 'Básico'
        ]);
    }

    // 7. Certificados
    delete($pdo, "certificados", "dados_pessoais_id = $id");
    if (!empty($_POST["certificado_nome"])) {
        create($pdo, "certificados", [
            "dados_pessoais_id" => $id,
            "nome" => $_POST["certificado_nome"],
            "instituicao" => $_POST["certificado_instituicao"] ?? '',
            "data_conclusao" => !empty($_POST["certificado_data"]) ? $_POST["certificado_data"] : null,
            "url_certificado" => $_POST["certificado_url"] ?? ''
        ]);
    }

    // 8. Projetos
    delete($pdo, "projetos", "dados_pessoais_id = $id");
    if (!empty($_POST["projeto_nome"])) {
        create($pdo, "projetos", [
            "dados_pessoais_id" => $id,
            "nome" => $_POST["projeto_nome"],
            "descricao" => $_POST["projeto_descricao"] ?? '',
            "tecnologias" => $_POST["projeto_tecnologias"] ?? '',
            "link" => $_POST["projeto_link"] ?? ''
        ]);
    }

    // Redireciona de volta para a lista com mensagem de sucesso
    header("Location: listar_curriculos.php?sucesso=atualizado");
    exit;
}

header("Location: listar_curriculos.php");
exit;
?>