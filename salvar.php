<?php
require_once("config/conexao.php");
require_once("config/crud.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $foto_perfil = null;
    if (!empty($_FILES["foto_perfil"]["name"])) {
        $arquivo = $_FILES["foto_perfil"];
        $tipos_permitidos = ["image/jpeg", "image/png", "image/webp"];
        if (in_array($arquivo["type"], $tipos_permitidos) && $arquivo["size"] <= 2 * 1024 * 1024) {
            if (!file_exists("uploads/fotos")) mkdir("uploads/fotos", 0755, true);
            $nome_unico = "foto_" . time() . "." . pathinfo($arquivo["name"], PATHINFO_EXTENSION);
            $destino = "uploads/fotos/" . $nome_unico;
            if (move_uploaded_file($arquivo["tmp_name"], $destino)) $foto_perfil = $destino;
        }
    }

    $dados_pessoais_id = create($pdo, "dados_pessoais", [
        "nome"        => $_POST["nome"] ?? '',
        "cargo"       => $_POST["cargo"] ?? '',
        "resumo"      => $_POST["resumo"] ?? '',
        "objetivo"    => $_POST["objetivo"] ?? '',
        "nascimento"  => !empty($_POST["nascimento"]) ? $_POST["nascimento"] : null,
        "cidade"      => $_POST["cidade"] ?? '',
        "estado"      => $_POST["estado"] ?? '',
        "foto_perfil" => $foto_perfil
    ]);

    create($pdo, "contatos", [
        "dados_pessoais_id" => $dados_pessoais_id,
        "email"             => $_POST["email"] ?? '',
        "telefone"          => $_POST["telefone"] ?? '',
        "linkedin"          => $_POST["linkedin"] ?? '',
        "github"            => $_POST["github"] ?? '',
        "site_pessoal"      => $_POST["site_pessoal"] ?? ''
    ]);

    if (!empty($_POST["empresa"])) {
        create($pdo, "experiencias", [
            "dados_pessoais_id" => $dados_pessoais_id,
            "empresa"           => $_POST["empresa"],
            "funcao"            => $_POST["funcao"] ?? '',
            "periodo_inicio"    => !empty($_POST["exp_inicio"]) ? $_POST["exp_inicio"] : null,
            "periodo_fim"       => !empty($_POST["exp_fim"]) ? $_POST["exp_fim"] : null,
            "trabalho_atual"    => isset($_POST["trabalho_atual"]) ? 1 : 0,
            "descricao"         => $_POST["exp_descricao"] ?? ''
        ]);
    }

    if (!empty($_POST["instituicao"])) {
        create($pdo, "formacao", [
            "dados_pessoais_id" => $dados_pessoais_id,
            "instituicao"       => $_POST["instituicao"],
            "curso"             => $_POST["curso"] ?? '',
            "periodo_inicio"    => !empty($_POST["formacao_inicio"]) ? $_POST["formacao_inicio"] : null,
            "periodo_fim"       => !empty($_POST["formacao_fim"]) ? $_POST["formacao_fim"] : null,
            "cursando"          => isset($_POST["cursando"]) ? 1 : 0,
            "descricao"         => $_POST["formacao_descricao"] ?? ''
        ]);
    }

    if (!empty($_POST["habilidade"])) {
        create($pdo, "habilidades", [
            "dados_pessoais_id" => $dados_pessoais_id,
            "habilidade"        => $_POST["habilidade"],
            "nivel"             => $_POST["habilidade_nivel"] ?? 'Intermediário'
        ]);
    }

    if (!empty($_POST["idioma"])) {
        create($pdo, "idiomas", [
            "dados_pessoais_id" => $dados_pessoais_id,
            "idioma"            => $_POST["idioma"],
            "nivel"             => $_POST["idioma_nivel"] ?? 'Básico'
        ]);
    }

    if (!empty($_POST["certificado_nome"])) {
        create($pdo, "certificados", [
            "dados_pessoais_id" => $dados_pessoais_id,
            "nome"              => $_POST["certificado_nome"],
            "instituicao"       => $_POST["certificado_instituicao"] ?? '',
            "data_conclusao"    => !empty($_POST["certificado_data"]) ? $_POST["certificado_data"] : null,
            "url_certificado"   => $_POST["certificado_url"] ?? ''
        ]);
    }

    if (!empty($_POST["projeto_nome"])) {
        create($pdo, "projetos", [
            "dados_pessoais_id" => $dados_pessoais_id,
            "nome"              => $_POST["projeto_nome"],
            "descricao"         => $_POST["projeto_descricao"] ?? '',
            "tecnologias"       => $_POST["projeto_tecnologias"] ?? '',
            "link"              => $_POST["projeto_link"] ?? ''
        ]);
    }

    header("Location: listar_curriculos.php?sucesso=1");
    exit;
}
?>
