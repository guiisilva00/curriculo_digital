<?php
require_once("config/conexao.php");
require_once("config/crud.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (!$id) {
    header("Location: listar.php");
    exit;
}

$curriculo = read($pdo, "dados_pessoais", "id = $id");
if (!$curriculo) {
    die("Currículo não encontrado.");
}

$contato = read($pdo, "contatos", "dados_pessoais_id = $id");
$exp = readAll($pdo, "experiencias", "dados_pessoais_id = $id")[0] ?? [];
$form = readAll($pdo, "formacao", "dados_pessoais_id = $id")[0] ?? [];
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
        <p class="descricao-pagina">Atualize as informações do seu currículo digital.</p>

        <form action="atualizar.php" method="POST">
            <input type="hidden" name="id" value="<?= $id ?>">

            <fieldset>
                <legend>Dados Pessoais</legend>
                <div class="grade-formulario">
                    <div class="campo-formulario">
                        <label>Nome</label>
                        <input type="text" name="nome" value="<?= htmlspecialchars($curriculo['nome'] ?? '') ?>" required>
                    </div>
                    <div class="campo-formulario">
                        <label>Cargo</label>
                        <input type="text" name="cargo" value="<?= htmlspecialchars($curriculo['cargo'] ?? '') ?>" required>
                    </div>
                    <div class="campo-formulario largura-total">
                        <label>Resumo Profissional</label>
                        <textarea name="resumo" rows="5"><?= htmlspecialchars($curriculo['resumo'] ?? '') ?></textarea>
                    </div>
                    <div class="campo-formulario largura-total">
                        <label>Objetivo Profissional</label>
                        <textarea name="objetivo" rows="4"><?= htmlspecialchars($curriculo['objetivo'] ?? '') ?></textarea>
                    </div>
                    <div class="campo-formulario">
                        <label>Data de nascimento</label>
                        <input type="date" name="nascimento" value="<?= htmlspecialchars($curriculo['nascimento'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label>Cidade</label>
                        <input type="text" name="cidade" value="<?= htmlspecialchars($curriculo['cidade'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label>Estado</label>
                        <input type="text" name="estado" value="<?= htmlspecialchars($curriculo['estado'] ?? '') ?>">
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Contato</legend>
                <div class="grade-formulario">
                    <div class="campo-formulario">
                        <label>E-mail</label>
                        <input type="email" name="email" value="<?= htmlspecialchars($contato['email'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label>Telefone</label>
                        <input type="text" name="telefone" value="<?= htmlspecialchars($contato['telefone'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label>LinkedIn</label>
                        <input type="url" name="linkedin" value="<?= htmlspecialchars($contato['linkedin'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label>GitHub</label>
                        <input type="url" name="github" value="<?= htmlspecialchars($contato['github'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario largura-total">
                        <label>Site Pessoal</label>
                        <input type="url" name="site_pessoal" value="<?= htmlspecialchars($contato['site_pessoal'] ?? '') ?>">
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Experiência Profissional</legend>
                <div class="grade-formulario">
                    <div class="campo-formulario">
                        <label>Empresa</label>
                        <input type="text" name="empresa" value="<?= htmlspecialchars($exp['empresa'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label>Função</label>
                        <input type="text" name="funcao" value="<?= htmlspecialchars($exp['funcao'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label>Período de Início</label>
                        <input type="date" name="exp_inicio" value="<?= htmlspecialchars($exp['periodo_inicio'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label>Período de Fim</label>
                        <input type="date" name="exp_fim" value="<?= htmlspecialchars($exp['periodo_fim'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario largura-total" style="flex-direction: row; align-items: center; gap: 10px;">
                        <input type="checkbox" name="trabalho_atual" value="1" id="trabalho_atual" <?= !empty($exp['trabalho_atual']) ? 'checked' : '' ?>>
                        <label for="trabalho_atual" style="margin-bottom: 0;">Trabalho Atual</label>
                    </div>
                    <div class="campo-formulario largura-total">
                        <label>Descrição da Experiência</label>
                        <textarea name="exp_descricao" rows="4"><?= htmlspecialchars($exp['descricao'] ?? '') ?></textarea>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Formação Acadêmica</legend>
                <div class="grade-formulario">
                    <div class="campo-formulario">
                        <label>Instituição</label>
                        <input type="text" name="instituicao" value="<?= htmlspecialchars($form['instituicao'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label>Curso</label>
                        <input type="text" name="curso" value="<?= htmlspecialchars($form['curso'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label>Período de Início</label>
                        <input type="date" name="formacao_inicio" value="<?= htmlspecialchars($form['periodo_inicio'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label>Período de Fim</label>
                        <input type="date" name="formacao_fim" value="<?= htmlspecialchars($form['periodo_fim'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario largura-total" style="flex-direction: row; align-items: center; gap: 10px;">
                        <input type="checkbox" name="cursando" value="1" id="cursando" <?= !empty($form['cursando']) ? 'checked' : '' ?>>
                        <label for="cursando" style="margin-bottom: 0;">Cursando atualmente</label>
                    </div>
                    <div class="campo-formulario largura-total">
                        <label>Descrição</label>
                        <textarea name="formacao_descricao" rows="4"><?= htmlspecialchars($form['descricao'] ?? '') ?></textarea>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Projetos</legend>
                <div class="grade-formulario">
                    <div class="campo-formulario">
                        <label>Nome do Projeto</label>
                        <input type="text" name="projeto_nome" value="<?= htmlspecialchars($proj['nome'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label>Tecnologias</label>
                        <input type="text" name="projeto_tecnologias" value="<?= htmlspecialchars($proj['tecnologias'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario">
                        <label>Link do Projeto</label>
                        <input type="url" name="projeto_link" value="<?= htmlspecialchars($proj['link'] ?? '') ?>">
                    </div>
                    <div class="campo-formulario largura-total">
                        <label>Descrição</label>
                        <textarea name="projeto_descricao" rows="4"><?= htmlspecialchars($proj['descricao'] ?? '') ?></textarea>
                    </div>
                </div>
            </fieldset>

            <div class="grupo-botoes" style="justify-content: flex-start; margin-top: 20px;">
                <button type="submit" class="botao">Atualizar Currículo</button>
                <a href="listar.php" class="botao botao-cancelar">Cancelar</a>
            </div>
        </form>
    </section>
</main>

<footer role="contentinfo">
    <p class="footer-text">Desenvolvido por <strong>Guilherme Silva</strong> &copy; 2026</p>
</footer>
</body>
</html>
