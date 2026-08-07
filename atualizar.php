<?php
require_once("config/conexao.php");
require_once("config/crud.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["id"])) {
    $id = intval($_POST["id"]);

    $curriculo_atual = read($pdo, "dados_pessoais", "id = $id");
    $foto_caminho = $curriculo_atual['foto_perfil'] ?? null;

    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
        $extensao = strtolower(pathinfo($_FILES['foto_perfil']['name'], PATHINFO_EXTENSION));
        if (in_array($extensao, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
            $destino = 'uploads/' . uniqid('foto_') . '.' . $extensao;
            if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $destino)) {
                if (!empty($curriculo_atual['foto_perfil']) && file_exists($curriculo_atual['foto_perfil'])) {
                    @unlink($curriculo_atual['foto_perfil']);
                }
                $foto_caminho = $destino;
            }
        }
    }

    update($pdo, "dados_pessoais", [
        "nome"        => $_POST["nome"] ?? '',
        "cargo"       => $_POST["cargo"] ?? '',
        "resumo"      => $_POST["resumo"] ?? '',
        "objetivo"    => $_POST["objetivo"] ?? '',
        "nascimento"  => !empty($_POST["nascimento"]) ? $_POST["nascimento"] : null,
        "cidade"      => $_POST["cidade"] ?? '',
        "estado"      => $_POST["estado"] ?? '',
        "foto_perfil" => $foto_caminho
    ], "id = $id");

    update($pdo, "contatos", [
        "email"       => $_POST["email"] ?? '',
        "telefone"    => $_POST["telefone"] ?? '',
        "linkedin"    => $_POST["linkedin"] ?? '',
        "github"      => $_POST["github"] ?? '',
        "site_pessoal" => $_POST["site_pessoal"] ?? ''
    ], "dados_pessoais_id = $id");

    header("Location: painel.php?id=$id&sucesso=1");
    exit;
}

header("Location: listar_curriculos.php");
exit;
?>