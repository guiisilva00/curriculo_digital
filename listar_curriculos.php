<?php

$curriculo = read(
    $pdo,
    "dados_pessoais",
    "id = ".$_GET["id"]
);

$contato = read(
    $pdo,
    "contatos",
    "dados_pessoais_id = ".$_GET["id"]
);

$experiencias = readAll(
    $pdo,
    "experiencias",
    "dados_pessoais_id = ".$_GET["id"]
);

$formacoes = readAll(
    $pdo,
    "formacao",
    "dados_pessoais_id = ".$_GET["id"]
);