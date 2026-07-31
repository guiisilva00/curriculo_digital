<?php
require_once("config/crud.php");
require_once("config/conexao.php");
// $id = create($pdo, "dados_pessoais", [

//     "nome" => $_POST["nome"],
//     "cargo" => $_POST["cargo"],
//     "resumo" => $_POST["resumo"],
//     "objetivo" => $_POST["objetivo"],
//     "cidade" => $_POST["cidade"],
//     "estado" => $_POST["estado"]

// ]);

// create($pdo, "contatos", [

//     "dados_pessoais_id" => $id,
//     "email" => $_POST["email"],
//     "telefone" => $_POST["telefone"],
//     "linkedin" => $_POST["linkedin"],
//     "github" => $_POST["github"],
//     "site_pessoal" => $_POST["site"]

// ]);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plataforma - Cadastro de currículo</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<main>

    <section class="container formulario">

        <h1 class="title">Novo Currículo</h1>

        <p class="text">
            Preencha os campos abaixo para criar seu currículo digital.
        </p>

        <form action="salvar.php" method="POST">


            <fieldset>

                <legend>Dados Pessoais</legend>

                <div class="form-grid">

                    <div class="campo">
                        <label>Nome</label>
                        <input type="text" name="nome" required>
                    </div>

                    <div class="campo">
                        <label>Cargo</label>
                        <input type="text" name="cargo" required>
                    </div>

                    <div class="campo full">
                        <label>Resumo Profissional</label>
                        <textarea name="resumo" rows="5"></textarea>
                    </div>

                    <div class="campo full">
                        <label>Objetivo Profissional</label>
                        <textarea name="objetivo" rows="4"></textarea>
                    </div>

                    <div class="campo">
                        <label>Data de nascimento</label>
                        <input type="date" name="nascimento">
                    </div>

                    <div class="campo">
                        <label>Cidade</label>
                        <input type="text" name="cidade">
                    </div>

                    <div class="campo">
                        <label>Estado</label>
                        <input type="text" name="estado">
                    </div>

                </div>

            </fieldset>

            <fieldset>

                <legend>Contato</legend>

                <div class="form-grid">

                    <div class="campo">
                        <label>E-mail</label>
                        <input type="email" name="email">
                    </div>

                    <div class="campo">
                        <label>Telefone</label>
                        <input type="text" name="telefone">
                    </div>

                    <div class="campo">
                        <label>LinkedIn</label>
                        <input type="url" name="linkedin">
                    </div>

                    <div class="campo">
                        <label>GitHub</label>
                        <input type="url" name="github">
                    </div>

                    <div class="campo full">
                        <label>Site Pessoal</label>
                        <input type="url" name="site_pessoal">
                    </div>

                </div>

            </fieldset>

            <button type="submit" class="btn">

                Salvar Currículo

            </button>

        </form>

    </section>

</main>

<?php
require_once("partials/footer.php");
?>
</body>

</html>

