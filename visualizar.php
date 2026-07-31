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
$experiencias = readAll($pdo, "experiencias", "dados_pessoais_id = $id");
$formacoes = readAll($pdo, "formacao", "dados_pessoais_id = $id");
$habilidades = readAll($pdo, "habilidades", "dados_pessoais_id = $id");
$idiomas = readAll($pdo, "idiomas", "dados_pessoais_id = $id");
$certificados = readAll($pdo, "certificados", "dados_pessoais_id = $id");
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
            <a href="listar_curriculos.php" class="botao botao-secundario" style="padding: 10px 20px; border-radius: 8px;">&larr; Voltar para Lista</a>
            <div style="display: flex; gap: 10px;">
                <a href="editar.php?id=<?= $curriculo['id'] ?>" class="botao" style="background: #f59e0b; box-shadow: none; padding: 10px 20px; border-radius: 8px;">Editar</a>
                <a href="index.php" class="botao botao-secundario" style="padding: 10px 20px; border-radius: 8px;">Tela Inicial</a>
            </div>
        </nav>

        <!-- Cabeçalho do CV -->
        <header class="cabecalho-curriculo">
            <h1 class="nome-curriculo"><?= htmlspecialchars($curriculo['nome']) ?></h1>
            <p class="cargo-curriculo"><?= htmlspecialchars($curriculo['cargo']) ?></p>
            
            <address class="contatos-curriculo">
                <?= htmlspecialchars($curriculo['cidade'] . ' - ' . $curriculo['estado']) ?><br>
                <?php if($contato): ?>
                    <?php if(!empty($contato['email'])): ?> 📧 <?= htmlspecialchars($contato['email']) ?> | <?php endif; ?>
                    <?php if(!empty($contato['telefone'])): ?> 📱 <?= htmlspecialchars($contato['telefone']) ?> | <?php endif; ?>
                    <?php if(!empty($contato['linkedin'])): ?> <a href="<?= htmlspecialchars($contato['linkedin']) ?>" target="_blank" rel="noopener noreferrer">LinkedIn</a> | <?php endif; ?>
                    <?php if(!empty($contato['github'])): ?> <a href="<?= htmlspecialchars($contato['github']) ?>" target="_blank" rel="noopener noreferrer">GitHub</a> | <?php endif; ?>
                    <?php if(!empty($contato['site_pessoal'])): ?> <a href="<?= htmlspecialchars($contato['site_pessoal']) ?>" target="_blank" rel="noopener noreferrer">Site Pessoal</a> <?php endif; ?>
                <?php endif; ?>
            </address>
        </header>

        <!-- Resumo -->
        <?php if(!empty($curriculo['resumo'])): ?>
            <section class="secao-curriculo">
                <h2 class="titulo-secao">Resumo Profissional</h2>
                <div class="descricao-item"><?= nl2br(htmlspecialchars($curriculo['resumo'])) ?></div>
            </section>
        <?php endif; ?>

        <?php if(!empty($curriculo['objetivo'])): ?>
            <section class="secao-curriculo">
                <h2 class="titulo-secao">Objetivo Profissional</h2>
                <div class="descricao-item"><?= nl2br(htmlspecialchars($curriculo['objetivo'])) ?></div>
            </section>
        <?php endif; ?>

        <!-- Experiências -->
        <?php if(!empty($experiencias)): ?>
            <section class="secao-curriculo">
                <h2 class="titulo-secao">Experiência Profissional</h2>
                <?php foreach($experiencias as $exp): ?>
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
                        <?php if(!empty($exp['descricao'])): ?>
                            <div class="descricao-item"><?= nl2br(htmlspecialchars($exp['descricao'])) ?></div>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>

        <!-- Formação -->
        <?php if(!empty($formacoes)): ?>
            <section class="secao-curriculo">
                <h2 class="titulo-secao">Formação Acadêmica</h2>
                <?php foreach($formacoes as $form): ?>
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
                        <?php if(!empty($form['descricao'])): ?>
                            <div class="descricao-item"><?= nl2br(htmlspecialchars($form['descricao'])) ?></div>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>

        <div class="grade-duas-colunas">
            <!-- Habilidades -->
            <?php if(!empty($habilidades)): ?>
                <section class="secao-curriculo">
                    <h2 class="titulo-secao">Habilidades</h2>
                    <div>
                        <?php foreach($habilidades as $hab): ?>
                            <span class="etiqueta-destaque"><?= htmlspecialchars($hab['habilidade']) ?> (<?= htmlspecialchars($hab['nivel']) ?>)</span>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>

            <!-- Idiomas -->
            <?php if(!empty($idiomas)): ?>
                <section class="secao-curriculo">
                    <h2 class="titulo-secao">Idiomas</h2>
                    <div>
                        <?php foreach($idiomas as $idioma): ?>
                            <span class="etiqueta-destaque"><?= htmlspecialchars($idioma['idioma']) ?> - <?= htmlspecialchars($idioma['nivel']) ?></span>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>
        </div>

        <!-- Projetos -->
        <?php if(!empty($projetos)): ?>
            <section class="secao-curriculo">
                <h2 class="titulo-secao">Projetos</h2>
                <?php foreach($projetos as $proj): ?>
                    <article class="item-curriculo">
                        <div class="cabecalho-item">
                            <h3 class="titulo-item"><?= htmlspecialchars($proj['nome']) ?></h3>
                            <?php if(!empty($proj['link'])): ?>
                                <a href="<?= htmlspecialchars($proj['link']) ?>" target="_blank" rel="noopener noreferrer" style="color: #3b82f6; text-decoration: none; font-size: 0.9rem;">Ver Projeto &nearr;</a>
                            <?php endif; ?>
                        </div>
                        <?php if(!empty($proj['tecnologias'])): ?>
                            <div class="subtitulo-item" style="font-size: 0.9rem; color: #64748b;">Tecnologias: <?= htmlspecialchars($proj['tecnologias']) ?></div>
                        <?php endif; ?>
                        <?php if(!empty($proj['descricao'])): ?>
                            <div class="descricao-item"><?= nl2br(htmlspecialchars($proj['descricao'])) ?></div>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>

        <!-- Certificados -->
        <?php if(!empty($certificados)): ?>
            <section class="secao-curriculo">
                <h2 class="titulo-secao">Certificados</h2>
                <?php foreach($certificados as $cert): ?>
                    <article class="item-curriculo">
                        <div class="cabecalho-item">
                            <h3 class="titulo-item"><?= htmlspecialchars($cert['nome']) ?></h3>
                            <span class="data-item"><?= $cert['data_conclusao'] ? date('d/m/Y', strtotime($cert['data_conclusao'])) : '' ?></span>
                        </div>
                        <div class="subtitulo-item"><?= htmlspecialchars($cert['instituicao']) ?></div>
                        <?php if(!empty($cert['url_certificado'])): ?>
                            <a href="<?= htmlspecialchars($cert['url_certificado']) ?>" target="_blank" rel="noopener noreferrer" style="color: #3b82f6; text-decoration: none; font-size: 0.9rem; display: inline-block; margin-top: 5px;">Ver Certificado &nearr;</a>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>

    </section>
</main>

<?php 
if(file_exists("partials/footer.php")){
    require_once("partials/footer.php"); 
}
?>
</body>
</html>
