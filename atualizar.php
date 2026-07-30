<?php
update($pdo, "dados_pessoais", [

    "nome" => $_POST["nome"],
    "cargo" => $_POST["cargo"],
    "cidade" => $_POST["cidade"]

], "id = ".$_POST["id"]);