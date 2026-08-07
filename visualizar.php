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
$experiencias = readAll($pdo, "experiencias", "dados_pessoais_id = $id");
$formacoes = readAll($pdo, "formacao", "dados_pessoais_id = $id");
$projetos = readAll($pdo, "projetos", "dados_pessoais_id = $id");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Currículo - <?= htmlspecialchars($curriculo['nome']) ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<main>
    <section class="conteiner-app conteiner-formulario">

        <nav class="barra-acoes" aria-label="Ações do currículo">
            <a href="listar.php" class="botao botao-secundario">&larr; Voltar para Lista</a>
            <div>
                <a href="editar.php?id=<?= $curriculo['id'] ?>" class="botao botao-alerta">Editar</a>
                <button onclick="window.print()" class="botao">Imprimir / PDF</button>
                <a href="index.php" class="botao botao-secundario">Tela Inicial</a>
            </div>
        </nav>

        <header class="cabecalho-curriculo">
            <h1 class="nome-curriculo"><?= htmlspecialchars($curriculo['nome']) ?></h1>
            <p class="cargo-curriculo"><?= htmlspecialchars($curriculo['cargo']) ?></p>

            <address class="contatos-curriculo">
                <?= htmlspecialchars($curriculo['cidade'] . ' - ' . $curriculo['estado']) ?><br>
                <?php if ($contato): ?>
                    <?php if (!empty($contato['email'])): ?> <?= htmlspecialchars($contato['email']) ?> | <?php endif; ?>
                    <?php if (!empty($contato['telefone'])): ?> <?= htmlspecialchars($contato['telefone']) ?> | <?php endif; ?>
                    <?php if (!empty($contato['linkedin'])): ?> <a href="<?= htmlspecialchars($contato['linkedin']) ?>" target="_blank" rel="noopener noreferrer">LinkedIn</a> | <?php endif; ?>
                    <?php if (!empty($contato['github'])): ?> <a href="<?= htmlspecialchars($contato['github']) ?>" target="_blank" rel="noopener noreferrer">GitHub</a> | <?php endif; ?>
                    <?php if (!empty($contato['site_pessoal'])): ?> <a href="<?= htmlspecialchars($contato['site_pessoal']) ?>" target="_blank" rel="noopener noreferrer">Site Pessoal</a> <?php endif; ?>
                <?php endif; ?>
            </address>
        </header>

        <?php if (!empty($curriculo['resumo'])): ?>
            <section class="secao-curriculo">
                <h2 class="titulo-secao">Resumo Profissional</h2>
                <div class="descricao-item"><?= nl2br(htmlspecialchars($curriculo['resumo'])) ?></div>
            </section>
        <?php endif; ?>

        <?php if (!empty($curriculo['objetivo'])): ?>
            <section class="secao-curriculo">
                <h2 class="titulo-secao">Objetivo Profissional</h2>
                <div class="descricao-item"><?= nl2br(htmlspecialchars($curriculo['objetivo'])) ?></div>
            </section>
        <?php endif; ?>

        <?php if (!empty($experiencias)): ?>
            <section class="secao-curriculo">
                <h2 class="titulo-secao">Experiência Profissional</h2>
                <?php foreach ($experiencias as $exp): ?>
                    <article class="item-curriculo">
                        <div class="cabecalho-item">
                            <h3 class="titulo-item"><?= htmlspecialchars($exp['funcao']) ?></h3>
                            <span class="data-item">
                                <?= $exp['periodo_inicio'] ? date('m/Y', strtotime($exp['periodo_inicio'])) : '' ?>
                                -
                                <?= $exp['trabalho_atual'] ? 'Atualmente' : ($exp['periodo_fim'] ? date('m/Y', strtotime($exp['periodo_fim'])) : '') ?>
                            </span>
                        </div>
                        <div class="subtitulo-item"><?= htmlspecialchars($exp['empresa']) ?></div>
                        <?php if (!empty($exp['descricao'])): ?>
                            <div class="descricao-item"><?= nl2br(htmlspecialchars($exp['descricao'])) ?></div>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>

        <?php if (!empty($formacoes)): ?>
            <section class="secao-curriculo">
                <h2 class="titulo-secao">Formação Acadêmica</h2>
                <?php foreach ($formacoes as $form): ?>
                    <article class="item-curriculo">
                        <div class="cabecalho-item">
                            <h3 class="titulo-item"><?= htmlspecialchars($form['curso']) ?></h3>
                            <span class="data-item">
                                <?= $form['periodo_inicio'] ? date('Y', strtotime($form['periodo_inicio'])) : '' ?>
                                -
                                <?= $form['cursando'] ? 'Cursando' : ($form['periodo_fim'] ? date('Y', strtotime($form['periodo_fim'])) : '') ?>
                            </span>
                        </div>
                        <div class="subtitulo-item"><?= htmlspecialchars($form['instituicao']) ?></div>
                        <?php if (!empty($form['descricao'])): ?>
                            <div class="descricao-item"><?= nl2br(htmlspecialchars($form['descricao'])) ?></div>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>

        <?php if (!empty($projetos)): ?>
            <section class="secao-curriculo">
                <h2 class="titulo-secao">Projetos</h2>
                <?php foreach ($projetos as $proj): ?>
                    <article class="item-curriculo">
                        <div class="cabecalho-item">
                            <h3 class="titulo-item"><?= htmlspecialchars($proj['nome']) ?></h3>
                            <?php if (!empty($proj['link'])): ?>
                                <a href="<?= htmlspecialchars($proj['link']) ?>" target="_blank" rel="noopener noreferrer" style="color: var(--fern); text-decoration: none; font-size: 0.9rem; font-weight: 600;">Ver Projeto &nearr;</a>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($proj['tecnologias'])): ?>
                            <div class="subtitulo-item" style="font-size: 0.9rem; color: var(--hunter-green);">Tecnologias: <?= htmlspecialchars($proj['tecnologias']) ?></div>
                        <?php endif; ?>
                        <?php if (!empty($proj['descricao'])): ?>
                            <div class="descricao-item"><?= nl2br(htmlspecialchars($proj['descricao'])) ?></div>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>

    </section>
</main>

<footer role="contentinfo">
    <p class="footer-text">Desenvolvido por <strong>Guilherme Silva</strong> &copy; 2026</p>
</footer>
</body>
</html>
