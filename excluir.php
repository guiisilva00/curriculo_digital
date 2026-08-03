<?php
require_once("config/conexao.php");
require_once("config/crud.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Buscar o registro para excluir a imagem física da pasta uploads se existir
    $curriculo = read($pdo, "dados_pessoais", "id = $id");
    if ($curriculo && !empty($curriculo['foto_perfil']) && file_exists($curriculo['foto_perfil'])) {
        @unlink($curriculo['foto_perfil']);
    }

    // Devido ao ON DELETE CASCADE no banco de dados, ao deletar de dados_pessoais,
    // todas as outras informações (contatos, experiências, etc) também serão deletadas.
    delete($pdo, "dados_pessoais", "id = $id");
    
    header("Location: listar_curriculos.php?sucesso=excluido");
    exit;
}

header("Location: listar_curriculos.php");
exit;
?>
