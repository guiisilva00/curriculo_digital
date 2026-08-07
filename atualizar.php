<?php
require_once("config/conexao.php");
require_once("config/crud.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST["id"] ?? 0);
    if (!$id) {
        header("Location: listar.php");
        exit;
    }

    update($pdo, "dados_pessoais", [
        "nome"       => trim($_POST["nome"] ?? ''),
        "cargo"      => trim($_POST["cargo"] ?? ''),
        "resumo"     => trim($_POST["resumo"] ?? ''),
        "objetivo"   => trim($_POST["objetivo"] ?? ''),
        "nascimento" => !empty($_POST["nascimento"]) ? $_POST["nascimento"] : null,
        "cidade"     => trim($_POST["cidade"] ?? ''),
        "estado"     => trim($_POST["estado"] ?? '')
    ], "id = $id");

    update($pdo, "contatos", [
        "email"        => trim($_POST["email"] ?? ''),
        "telefone"     => trim($_POST["telefone"] ?? ''),
        "linkedin"     => trim($_POST["linkedin"] ?? ''),
        "github"       => trim($_POST["github"] ?? ''),
        "site_pessoal" => trim($_POST["site_pessoal"] ?? '')
    ], "dados_pessoais_id = $id");

    delete($pdo, "experiencias", "dados_pessoais_id = $id");
    if (!empty(trim($_POST["empresa"] ?? ''))) {
        create($pdo, "experiencias", [
            "dados_pessoais_id" => $id,
            "empresa"           => trim($_POST["empresa"]),
            "funcao"            => trim($_POST["funcao"] ?? ''),
            "periodo_inicio"    => !empty($_POST["exp_inicio"]) ? $_POST["exp_inicio"] : null,
            "periodo_fim"       => !empty($_POST["exp_fim"]) ? $_POST["exp_fim"] : null,
            "trabalho_atual"    => isset($_POST["trabalho_atual"]) ? 1 : 0,
            "descricao"         => trim($_POST["exp_descricao"] ?? '')
        ]);
    }

    delete($pdo, "formacao", "dados_pessoais_id = $id");
    if (!empty(trim($_POST["instituicao"] ?? ''))) {
        create($pdo, "formacao", [
            "dados_pessoais_id" => $id,
            "instituicao"       => trim($_POST["instituicao"]),
            "curso"             => trim($_POST["curso"] ?? ''),
            "periodo_inicio"    => !empty($_POST["formacao_inicio"]) ? $_POST["formacao_inicio"] : null,
            "periodo_fim"       => !empty($_POST["formacao_fim"]) ? $_POST["formacao_fim"] : null,
            "cursando"          => isset($_POST["cursando"]) ? 1 : 0,
            "descricao"         => trim($_POST["formacao_descricao"] ?? '')
        ]);
    }

    delete($pdo, "projetos", "dados_pessoais_id = $id");
    if (!empty(trim($_POST["projeto_nome"] ?? ''))) {
        create($pdo, "projetos", [
            "dados_pessoais_id" => $id,
            "nome"              => trim($_POST["projeto_nome"]),
            "descricao"         => trim($_POST["projeto_descricao"] ?? ''),
            "tecnologias"       => trim($_POST["projeto_tecnologias"] ?? ''),
            "link"              => trim($_POST["projeto_link"] ?? '')
        ]);
    }

    header("Location: listar.php?sucesso=1");
    exit;
}

header("Location: listar.php");
exit;
