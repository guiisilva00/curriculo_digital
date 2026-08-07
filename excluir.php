<?php
require_once("config/conexao.php");
require_once("config/crud.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $curriculo = read($pdo, "dados_pessoais", "id = $id");
    if ($curriculo && !empty($curriculo['foto_perfil']) && file_exists($curriculo['foto_perfil'])) {
        @unlink($curriculo['foto_perfil']);
    }
    delete($pdo, "dados_pessoais", "id = $id");
    header("Location: listar_curriculos.php?sucesso=excluido");
    exit;
}

header("Location: listar_curriculos.php");
exit;
?>
