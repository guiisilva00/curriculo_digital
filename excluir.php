<?php
require_once("config/conexao.php");
require_once("config/crud.php");

if (isset($_GET['id'])) {
    delete($pdo, "dados_pessoais", "id = " . intval($_GET['id']));
    header("Location: listar.php?sucesso=1");
    exit;
}

header("Location: listar.php");
exit;
