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

    <section class="container formulario">

        <h1 class="title">Editar Currículo</h1>

        <p class="text">
            Atualize as informações do seu currículo digital.
        </p>

        <form action="atualizar.php" method="POST">
            <input type="hidden" name="id" value="<?= $id ?>">

            <fieldset>
                <legend>Dados Pessoais</legend>
                <div class="form-grid">
                    <div class="campo">
                        <label>Nome</label>
                        <input type="text" name="nome" value="<?= htmlspecialchars($curriculo['nome'] ?? '') ?>" required>
                    </div>
                    <div class="campo">
                        <label>Cargo</label>
                        <input type="text" name="cargo" value="<?= htmlspecialchars($curriculo['cargo'] ?? '') ?>" required>
                    </div>
                    <div class="campo full">
                        <label>Resumo Profissional</label>
                        <textarea name="resumo" rows="5"><?= htmlspecialchars($curriculo['resumo'] ?? '') ?></textarea>
                    </div>
                    <div class="campo full">
                        <label>Objetivo Profissional</label>
                        <textarea name="objetivo" rows="4"><?= htmlspecialchars($curriculo['objetivo'] ?? '') ?></textarea>
                    </div>
                    <div class="campo">
                        <label>Data de nascimento</label>
                        <input type="date" name="nascimento" value="<?= htmlspecialchars($curriculo['nascimento'] ?? '') ?>">
                    </div>
                    <div class="campo">
                        <label>Cidade</label>
                        <input type="text" name="cidade" value="<?= htmlspecialchars($curriculo['cidade'] ?? '') ?>">
                    </div>
                    <div class="campo">
                        <label>Estado</label>
                        <input type="text" name="estado" value="<?= htmlspecialchars($curriculo['estado'] ?? '') ?>">
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Contato</legend>
                <div class="form-grid">
                    <div class="campo">
                        <label>E-mail</label>
                        <input type="email" name="email" value="<?= htmlspecialchars($contato['email'] ?? '') ?>">
                    </div>
                    <div class="campo">
                        <label>Telefone</label>
                        <input type="text" name="telefone" value="<?= htmlspecialchars($contato['telefone'] ?? '') ?>">
                    </div>
                    <div class="campo">
                        <label>LinkedIn</label>
                        <input type="url" name="linkedin" value="<?= htmlspecialchars($contato['linkedin'] ?? '') ?>">
                    </div>
                    <div class="campo">
                        <label>GitHub</label>
                        <input type="url" name="github" value="<?= htmlspecialchars($contato['github'] ?? '') ?>">
                    </div>
                    <div class="campo full">
                        <label>Site Pessoal</label>
                        <input type="url" name="site_pessoal" value="<?= htmlspecialchars($contato['site_pessoal'] ?? '') ?>">
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Experiência Profissional</legend>
                <div class="form-grid">
                    <div class="campo">
                        <label>Empresa</label>
                        <input type="text" name="empresa" value="<?= htmlspecialchars($exp['empresa'] ?? '') ?>">
                    </div>
                    <div class="campo">
                        <label>Função</label>
                        <input type="text" name="funcao" value="<?= htmlspecialchars($exp['funcao'] ?? '') ?>">
                    </div>
                    <div class="campo">
                        <label>Período de Início</label>
                        <input type="date" name="exp_inicio" value="<?= htmlspecialchars($exp['periodo_inicio'] ?? '') ?>">
                    </div>
                    <div class="campo">
                        <label>Período de Fim</label>
                        <input type="date" name="exp_fim" value="<?= htmlspecialchars($exp['periodo_fim'] ?? '') ?>">
                    </div>
                    <div class="campo full" style="flex-direction: row; align-items: center; gap: 10px;">
                        <input type="checkbox" name="trabalho_atual" value="1" id="trabalho_atual" <?= !empty($exp['trabalho_atual']) ? 'checked' : '' ?>>
                        <label for="trabalho_atual" style="margin-bottom: 0;">Trabalho Atual</label>
                    </div>
                    <div class="campo full">
                        <label>Descrição da Experiência</label>
                        <textarea name="exp_descricao" rows="4"><?= htmlspecialchars($exp['descricao'] ?? '') ?></textarea>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Formação Acadêmica</legend>
                <div class="form-grid">
                    <div class="campo">
                        <label>Instituição</label>
                        <input type="text" name="instituicao" value="<?= htmlspecialchars($form['instituicao'] ?? '') ?>">
                    </div>
                    <div class="campo">
                        <label>Curso</label>
                        <input type="text" name="curso" value="<?= htmlspecialchars($form['curso'] ?? '') ?>">
                    </div>
                    <div class="campo">
                        <label>Período de Início</label>
                        <input type="date" name="formacao_inicio" value="<?= htmlspecialchars($form['periodo_inicio'] ?? '') ?>">
                    </div>
                    <div class="campo">
                        <label>Período de Fim</label>
                        <input type="date" name="formacao_fim" value="<?= htmlspecialchars($form['periodo_fim'] ?? '') ?>">
                    </div>
                    <div class="campo full" style="flex-direction: row; align-items: center; gap: 10px;">
                        <input type="checkbox" name="cursando" value="1" id="cursando" <?= !empty($form['cursando']) ? 'checked' : '' ?>>
                        <label for="cursando" style="margin-bottom: 0;">Cursando atualmente</label>
                    </div>
                    <div class="campo full">
                        <label>Descrição</label>
                        <textarea name="formacao_descricao" rows="4"><?= htmlspecialchars($form['descricao'] ?? '') ?></textarea>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Habilidades</legend>
                <div class="form-grid">
                    <div class="campo">
                        <label>Habilidade</label>
                        <input type="text" name="habilidade" value="<?= htmlspecialchars($hab['habilidade'] ?? '') ?>">
                    </div>
                    <div class="campo">
                        <label>Nível</label>
                        <?php $nivel_hab = $hab['nivel'] ?? 'Intermediário'; ?>
                        <select name="habilidade_nivel">
                            <option value="Básico" <?= $nivel_hab == 'Básico' ? 'selected' : '' ?>>Básico</option>
                            <option value="Intermediário" <?= $nivel_hab == 'Intermediário' ? 'selected' : '' ?>>Intermediário</option>
                            <option value="Avançado" <?= $nivel_hab == 'Avançado' ? 'selected' : '' ?>>Avançado</option>
                        </select>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Idiomas</legend>
                <div class="form-grid">
                    <div class="campo">
                        <label>Idioma</label>
                        <input type="text" name="idioma" value="<?= htmlspecialchars($idio['idioma'] ?? '') ?>">
                    </div>
                    <div class="campo">
                        <label>Nível</label>
                        <?php $nivel_idio = $idio['nivel'] ?? 'Básico'; ?>
                        <select name="idioma_nivel">
                            <option value="Básico" <?= $nivel_idio == 'Básico' ? 'selected' : '' ?>>Básico</option>
                            <option value="Intermediário" <?= $nivel_idio == 'Intermediário' ? 'selected' : '' ?>>Intermediário</option>
                            <option value="Avançado" <?= $nivel_idio == 'Avançado' ? 'selected' : '' ?>>Avançado</option>
                            <option value="Fluente" <?= $nivel_idio == 'Fluente' ? 'selected' : '' ?>>Fluente</option>
                            <option value="Nativo" <?= $nivel_idio == 'Nativo' ? 'selected' : '' ?>>Nativo</option>
                        </select>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Certificados</legend>
                <div class="form-grid">
                    <div class="campo">
                        <label>Nome do Certificado</label>
                        <input type="text" name="certificado_nome" value="<?= htmlspecialchars($cert['nome'] ?? '') ?>">
                    </div>
                    <div class="campo">
                        <label>Instituição</label>
                        <input type="text" name="certificado_instituicao" value="<?= htmlspecialchars($cert['instituicao'] ?? '') ?>">
                    </div>
                    <div class="campo">
                        <label>Data de Conclusão</label>
                        <input type="date" name="certificado_data" value="<?= htmlspecialchars($cert['data_conclusao'] ?? '') ?>">
                    </div>
                    <div class="campo">
                        <label>URL do Certificado</label>
                        <input type="url" name="certificado_url" value="<?= htmlspecialchars($cert['url_certificado'] ?? '') ?>">
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Projetos</legend>
                <div class="form-grid">
                    <div class="campo">
                        <label>Nome do Projeto</label>
                        <input type="text" name="projeto_nome" value="<?= htmlspecialchars($proj['nome'] ?? '') ?>">
                    </div>
                    <div class="campo">
                        <label>Tecnologias (ex: PHP, MySQL)</label>
                        <input type="text" name="projeto_tecnologias" value="<?= htmlspecialchars($proj['tecnologias'] ?? '') ?>">
                    </div>
                    <div class="campo">
                        <label>Link do Projeto</label>
                        <input type="url" name="projeto_link" value="<?= htmlspecialchars($proj['link'] ?? '') ?>">
                    </div>
                    <div class="campo full">
                        <label>Descrição</label>
                        <textarea name="projeto_descricao" rows="4"><?= htmlspecialchars($proj['descricao'] ?? '') ?></textarea>
                    </div>
                </div>
            </fieldset>

            <div class="botoes" style="justify-content: flex-start; margin-top: 20px;">
                <button type="submit" class="btn">Atualizar Currículo</button>
                <a href="listar_curriculos.php" class="btn secundario" style="padding: 15px 30px; border-radius: 8px; text-decoration: none; color: white;">Cancelar / Voltar</a>
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
