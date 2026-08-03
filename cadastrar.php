<?php
require_once("config/crud.php");
require_once("config/conexao.php");
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

    <section class="conteiner-app conteiner-formulario">

        <h1 class="titulo-pagina">Novo Currículo</h1>

        <p class="descricao-pagina">
            Preencha os campos abaixo para criar seu currículo digital.
        </p>

        <form action="salvar.php" method="POST" enctype="multipart/form-data">

            <fieldset>
                <legend>Dados Pessoais</legend>

                <div class="grade-formulario">

                    <div class="campo-formulario">
                        <label for="nome">Nome</label>
                        <input id="nome" type="text" name="nome" required>
                    </div>

                    <div class="campo-formulario">
                        <label for="cargo">Cargo</label>
                        <input id="cargo" type="text" name="cargo" required>
                    </div>

                    <div class="campo-formulario largura-total">
                        <label for="foto_perfil">Foto de Perfil</label>
                        <input id="foto_perfil" type="file" name="foto_perfil" accept="image/*">
                    </div>

                    <div class="campo-formulario largura-total">
                        <label for="resumo">Resumo Profissional</label>
                        <textarea id="resumo" name="resumo" rows="5"></textarea>
                    </div>

                    <div class="campo-formulario largura-total">
                        <label for="objetivo">Objetivo Profissional</label>
                        <textarea id="objetivo" name="objetivo" rows="4"></textarea>
                    </div>

                    <div class="campo-formulario">
                        <label for="nascimento">Data de nascimento</label>
                        <input id="nascimento" type="date" name="nascimento">
                    </div>

                    <div class="campo-formulario">
                        <label for="cidade">Cidade</label>
                        <input id="cidade" type="text" name="cidade">
                    </div>

                    <div class="campo-formulario">
                        <label for="estado">Estado</label>
                        <input id="estado" type="text" name="estado">
                    </div>

                </div>

            </fieldset>

            <fieldset>
                <legend>Contato</legend>

                <div class="grade-formulario">

                    <div class="campo-formulario">
                        <label for="email">E-mail</label>
                        <input id="email" type="email" name="email">
                    </div>

                    <div class="campo-formulario">
                        <label for="telefone">Telefone</label>
                        <input id="telefone" type="tel" name="telefone">
                    </div>

                    <div class="campo-formulario">
                        <label for="linkedin">LinkedIn</label>
                        <input id="linkedin" type="url" name="linkedin">
                    </div>

                    <div class="campo-formulario">
                        <label for="github">GitHub</label>
                        <input id="github" type="url" name="github">
                    </div>

                    <div class="campo-formulario largura-total">
                        <label for="site_pessoal">Site Pessoal</label>
                        <input id="site_pessoal" type="url" name="site_pessoal">
                    </div>

                </div>

            </fieldset>



            <div class="grupo-botoes" style="justify-content: flex-start; margin-top: 20px;">
                <button type="submit" class="botao">Salvar Currículo</button>
                <a href="index.php" class="botao botao-secundario">Cancelar / Voltar</a>
            </div>

        </form>

    </section>

</main>

<?php
require_once("partials/footer.php");
?>
</body>

</html>
