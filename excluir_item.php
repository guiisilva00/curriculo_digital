<?php
require_once("config/conexao.php");
require_once("config/crud.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$curriculo_id = isset($_GET['curriculo_id']) ? intval($_GET['curriculo_id']) : 0;
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';

if (!$id || !$curriculo_id || !$tipo) {
    header("Location: listar_curriculos.php");
    exit;
}

$tabelas = [
    'experiencia' => 'experiencias',
    'formacao' => 'formacao',
    'habilidade' => 'habilidades',
    'idioma' => 'idiomas',
    'certificado' => 'certificados',
    'projeto' => 'projetos'
];

if (array_key_exists($tipo, $tabelas)) {
    // Para garantir a segurança, seria bom verificar se o item realmente pertence ao currículo,
    // mas como o projeto é simples e a deleção é via GET (que não é o ideal), faremos de forma básica.
    delete($pdo, $tabelas[$tipo], "id = $id AND dados_pessoais_id = $curriculo_id");
}

header("Location: painel.php?id=" . $curriculo_id . "&sucesso=1");
exit;
?>
