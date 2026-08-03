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

            <fieldset>
                <legend>Experiência Profissional</legend>
                <div class="grade-formulario">
                    <div class="campo-formulario">
                        <label for="empresa">Empresa</label>
                        <input id="empresa" type="text" name="empresa" value="<?= htmlspecialchars($exp['empresa'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label for="funcao">Função</label>
                        <input id="funcao" type="text" name="funcao" value="<?= htmlspecialchars($exp['funcao'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label for="exp_inicio">Período de Início</label>
                        <input id="exp_inicio" type="date" name="exp_inicio" value="<?= htmlspecialchars($exp['periodo_inicio'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label for="exp_fim">Período de Fim</label>
                        <input id="exp_fim" type="date" name="exp_fim" value="<?= htmlspecialchars($exp['periodo_fim'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario largura-total" style="flex-direction: row; align-items: center; gap: 10px;">
                        <input type="checkbox" name="trabalho_atual" value="1" id="trabalho_atual" <?= !empty($exp['trabalho_atual']) ? 'checked' : '' ?>>
                        <label for="trabalho_atual" style="margin-bottom: 0;">Trabalho Atual</label>
                    </div>
                    <div class="campo-formulario largura-total">
                        <label for="exp_descricao">Descrição da Experiência</label>
                        <textarea id="exp_descricao" name="exp_descricao" rows="4"><?= htmlspecialchars($exp['descricao'] ?? '') ?></textarea>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Formação Acadêmica</legend>
                <div class="grade-formulario">
                    <div class="campo-formulario">
                        <label for="instituicao">Instituição</label>
                        <input id="instituicao" type="text" name="instituicao" value="<?= htmlspecialchars($form['instituicao'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label for="curso">Curso</label>
                        <input id="curso" type="text" name="curso" value="<?= htmlspecialchars($form['curso'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label for="formacao_inicio">Período de Início</label>
                        <input id="formacao_inicio" type="date" name="formacao_inicio" value="<?= htmlspecialchars($form['periodo_inicio'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label for="formacao_fim">Período de Fim</label>
                        <input id="formacao_fim" type="date" name="formacao_fim" value="<?= htmlspecialchars($form['periodo_fim'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario largura-total" style="flex-direction: row; align-items: center; gap: 10px;">
                        <input type="checkbox" name="cursando" value="1" id="cursando" <?= !empty($form['cursando']) ? 'checked' : '' ?>>
                        <label for="cursando" style="margin-bottom: 0;">Cursando atualmente</label>
                    </div>
                    <div class="campo-formulario largura-total">
                        <label for="formacao_descricao">Descrição</label>
                        <textarea id="formacao_descricao" name="formacao_descricao" rows="4"><?= htmlspecialchars($form['descricao'] ?? '') ?></textarea>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Habilidades</legend>
                <div class="grade-formulario">
                    <div class="campo-formulario">
                        <label for="habilidade">Habilidade</label>
                        <input id="habilidade" type="text" name="habilidade" value="<?= htmlspecialchars($hab['habilidade'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label for="habilidade_nivel">Nível</label>
                        <?php $nivel_hab = $hab['nivel'] ?? 'Intermediário'; ?>
                        <select id="habilidade_nivel" name="habilidade_nivel">
                            <option value="Básico" <?= $nivel_hab == 'Básico' ? 'selected' : '' ?>>Básico</option>
                            <option value="Intermediário" <?= $nivel_hab == 'Intermediário' ? 'selected' : '' ?>>Intermediário</option>
                            <option value="Avançado" <?= $nivel_hab == 'Avançado' ? 'selected' : '' ?>>Avançado</option>
                        </select>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Idiomas</legend>
                <div class="grade-formulario">
                    <div class="campo-formulario">
                        <label for="idioma">Idioma</label>
                        <input id="idioma" type="text" name="idioma" value="<?= htmlspecialchars($idio['idioma'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label for="idioma_nivel">Nível</label>
                        <?php $nivel_idio = $idio['nivel'] ?? 'Básico'; ?>
                        <select id="idioma_nivel" name="idioma_nivel">
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
                <div class="grade-formulario">
                    <div class="campo-formulario">
                        <label for="certificado_nome">Nome do Certificado</label>
                        <input id="certificado_nome" type="text" name="certificado_nome" value="<?= htmlspecialchars($cert['nome'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label for="certificado_instituicao">Instituição</label>
                        <input id="certificado_instituicao" type="text" name="certificado_instituicao" value="<?= htmlspecialchars($cert['instituicao'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label for="certificado_data">Data de Conclusão</label>
                        <input id="certificado_data" type="date" name="certificado_data" value="<?= htmlspecialchars($cert['data_conclusao'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label for="certificado_url">URL do Certificado</label>
                        <input id="certificado_url" type="url" name="certificado_url" value="<?= htmlspecialchars($cert['url_certificado'] ?? '') ?>">
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Projetos</legend>
                <div class="grade-formulario">
                    <div class="campo-formulario">
                        <label for="projeto_nome">Nome do Projeto</label>
                        <input id="projeto_nome" type="text" name="projeto_nome" value="<?= htmlspecialchars($proj['nome'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label for="projeto_tecnologias">Tecnologias (ex.: PHP, MySQL)</label>
                        <input id="projeto_tecnologias" type="text" name="projeto_tecnologias" value="<?= htmlspecialchars($proj['tecnologias'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label for="projeto_link">Link do Projeto</label>
                        <input id="projeto_link" type="url" name="projeto_link" value="<?= htmlspecialchars($proj['link'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario largura-total">
                        <label for="projeto_descricao">Descrição</label>
                        <textarea id="projeto_descricao" name="projeto_descricao" rows="4"><?= htmlspecialchars($proj['descricao'] ?? '') ?></textarea>
                    </div>
                </div>
            </fieldset>

            <div class="grupo-botoes" style="justify-content: flex-start; margin-top: 20px;">
                <button type="submit" class="botao">Salvar Alterações</button>
                <a href="listar_curriculos.php" class="botao botao-secundario">Cancelar / Voltar</a>
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
