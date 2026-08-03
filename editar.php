<?php
require_once("config/conexao.php");
require_once("config/crud.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (!$id) {
    header("Location: listar_curriculos.php");
    exit;
}

$curriculo = read($pdo, "dados_pessoais", "id = $id");
if (!$curriculo) {
    die("Currículo não encontrado.");
}

$contato = read($pdo, "contatos", "dados_pessoais_id = $id");
$exp = readAll($pdo, "experiencias", "dados_pessoais_id = $id")[0] ?? [];
$form = readAll($pdo, "formacao", "dados_pessoais_id = $id")[0] ?? [];
$hab = readAll($pdo, "habilidades", "dados_pessoais_id = $id")[0] ?? [];
$idio = readAll($pdo, "idiomas", "dados_pessoais_id = $id")[0] ?? [];
$cert = readAll($pdo, "certificados", "dados_pessoais_id = $id")[0] ?? [];
$proj = readAll($pdo, "projetos", "dados_pessoais_id = $id")[0] ?? [];

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plataforma - Editar currículo</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<main>

    <section class="conteiner-app conteiner-formulario">

        <h1 class="titulo-pagina">Editar Currículo</h1>

        <p class="descricao-pagina">
            Atualize as informações do seu currículo digital.
        </p>

        <form action="atualizar.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>">

            <fieldset>
                <legend>Dados Pessoais</legend>
                <div class="grade-formulario">
                    <div class="campo-formulario">
                        <label for="nome">Nome</label>
                        <input id="nome" type="text" name="nome" value="<?= htmlspecialchars($curriculo['nome'] ?? '') ?>" required>
                    </div>
                    <div class="campo-formulario">
                        <label for="cargo">Cargo</label>
                        <input id="cargo" type="text" name="cargo" value="<?= htmlspecialchars($curriculo['cargo'] ?? '') ?>" required>
                    </div>
                    <div class="campo-formulario largura-total">
                        <label for="foto_perfil">Foto de Perfil</label>
                        <?php if (!empty($curriculo['foto_perfil']) && file_exists($curriculo['foto_perfil'])): ?>
                            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                                <img src="<?= htmlspecialchars($curriculo['foto_perfil']) ?>" alt="Foto atual" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 2px solid var(--fern);">
                                <span style="font-size: 0.85rem; color: var(--hunter-green);">Foto atual carregada. Selecione um novo arquivo apenas se desejar alterá-la.</span>
                            </div>
                        <?php endif; ?>
                        <input id="foto_perfil" type="file" name="foto_perfil" accept="image/*">
                    </div>
                    <div class="campo-formulario largura-total">
                        <label for="resumo">Resumo Profissional</label>
                        <textarea id="resumo" name="resumo" rows="5"><?= htmlspecialchars($curriculo['resumo'] ?? '') ?></textarea>
                    </div>
                    <div class="campo-formulario largura-total">
                        <label for="objetivo">Objetivo Profissional</label>
                        <textarea id="objetivo" name="objetivo" rows="4"><?= htmlspecialchars($curriculo['objetivo'] ?? '') ?></textarea>
                    </div>
                    <div class="campo-formulario">
                        <label for="nascimento">Data de nascimento</label>
                        <input id="nascimento" type="date" name="nascimento" value="<?= htmlspecialchars($curriculo['nascimento'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label for="cidade">Cidade</label>
                        <input id="cidade" type="text" name="cidade" value="<?= htmlspecialchars($curriculo['cidade'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label for="estado">Estado</label>
                        <input id="estado" type="text" name="estado" value="<?= htmlspecialchars($curriculo['estado'] ?? '') ?>">
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Contato</legend>
                <div class="grade-formulario">
                    <div class="campo-formulario">
                        <label for="email">E-mail</label>
                        <input id="email" type="email" name="email" value="<?= htmlspecialchars($contato['email'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label for="telefone">Telefone</label>
                        <input id="telefone" type="tel" name="telefone" value="<?= htmlspecialchars($contato['telefone'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label for="linkedin">LinkedIn</label>
                        <input id="linkedin" type="url" name="linkedin" value="<?= htmlspecialchars($contato['linkedin'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label for="github">GitHub</label>
                        <input id="github" type="url" name="github" value="<?= htmlspecialchars($contato['github'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario largura-total">
                        <label for="site_pessoal">Site Pessoal</label>
                        <input id="site_pessoal" type="url" name="site_pessoal" value="<?= htmlspecialchars($contato['site_pessoal'] ?? '') ?>">
                    </div>
                </div>
            </fieldset>

            <div class="grupo-botoes" style="justify-content: flex-start; margin-top: 20px;">
                <button type="submit" class="botao">Salvar Alterações</button>
                <a href="painel.php?id=<?= $id ?>" class="botao botao-secundario">Cancelar / Voltar</a>
            </div>

        </form>

    </section>

</main>

<?php
if(file_exists("partials/footer.php")){
    require_once("partials/footer.php");
}
?>
</body>
</html>
