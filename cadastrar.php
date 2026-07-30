<?php
$id = create($pdo, "dados_pessoais", [

    "nome" => $_POST["nome"],
    "cargo" => $_POST["cargo"],
    "resumo" => $_POST["resumo"],
    "objetivo" => $_POST["objetivo"],
    "cidade" => $_POST["cidade"],
    "estado" => $_POST["estado"]

]);

create($pdo, "contatos", [

    "dados_pessoais_id" => $id,
    "email" => $_POST["email"],
    "telefone" => $_POST["telefone"],
    "linkedin" => $_POST["linkedin"],
    "github" => $_POST["github"],
    "site_pessoal" => $_POST["site"]

]);