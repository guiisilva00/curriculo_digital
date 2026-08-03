<?php
require_once("config/conexao.php");
require_once("config/crud.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Processamento do upload da foto de perfil
    $foto_caminho = null;
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
        $extensao = strtolower(pathinfo($_FILES['foto_perfil']['name'], PATHINFO_EXTENSION));
        $extensoes_permitidas = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        if (in_array($extensao, $extensoes_permitidas)) {
            $nome_arquivo = uniqid('foto_') . '.' . $extensao;
            $destino = 'uploads/' . $nome_arquivo;
            if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $destino)) {
                $foto_caminho = $destino;
            }
        }
    }

    // 1. Inserir Dados Pessoais
    $dados_pessoais_id = create($pdo, "dados_pessoais", [
        "nome" => $_POST["nome"] ?? '',
        "cargo" => $_POST["cargo"] ?? '',
        "resumo" => $_POST["resumo"] ?? '',
        "objetivo" => $_POST["objetivo"] ?? '',
        "nascimento" => !empty($_POST["nascimento"]) ? $_POST["nascimento"] : null,
        "cidade" => $_POST["cidade"] ?? '',
        "estado" => $_POST["estado"] ?? '',
        "foto_perfil" => $foto_caminho
    ]);

    // 2. Inserir Contatos
    create($pdo, "contatos", [
        "dados_pessoais_id" => $dados_pessoais_id,
        "email" => $_POST["email"] ?? '',
        "telefone" => $_POST["telefone"] ?? '',
        "linkedin" => $_POST["linkedin"] ?? '',
        "github" => $_POST["github"] ?? '',
        "site_pessoal" => $_POST["site_pessoal"] ?? ''
    ]);

    // Redireciona para o painel do currículo após salvar
    header("Location: painel.php?id=" . $dados_pessoais_id . "&sucesso=1");
    exit;
}
?>
