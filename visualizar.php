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
    <style>
        .cv-header { text-align: center; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 2px solid #e2e8f0; }
        .cv-name { font-size: 2.5rem; font-weight: 700; color: #0f172a; margin-bottom: 10px; }
        .cv-cargo { font-size: 1.5rem; color: #3b82f6; font-weight: 600; margin-bottom: 15px; }
        .cv-contact { font-size: 0.95rem; color: #64748b; line-height: 1.8; }
        .cv-contact a { color: #3b82f6; text-decoration: none; }
        .cv-contact a:hover { text-decoration: underline; }
        
        .cv-section { margin-bottom: 30px; }
        .cv-section-title { font-size: 1.5rem; color: #1e293b; border-bottom: 2px solid #cbd5e1; padding-bottom: 5px; margin-bottom: 20px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }
        
        .cv-item { margin-bottom: 20px; }
        .cv-item-header { display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 5px; }
        .cv-item-title { font-weight: 600; font-size: 1.2rem; color: #0f172a; }
        .cv-item-subtitle { color: #3b82f6; font-weight: 500; }
        .cv-item-date { font-size: 0.9rem; color: #64748b; font-style: italic; }
        .cv-item-desc { color: #475569; line-height: 1.6; margin-top: 10px; }
        
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .pill { display: inline-block; background: #e0f2fe; color: #0369a1; padding: 5px 15px; border-radius: 20px; font-size: 0.9rem; font-weight: 500; margin-right: 10px; margin-bottom: 10px; }
        
        .action-bar { display: flex; justify-content: space-between; margin-bottom: 20px; }
    </style>
</head>
<body>
<main>
    <section class="container" style="max-width: 900px; text-align: left; padding: 40px;">
        
        <div class="action-bar">
            <a href="listar_curriculos.php" class="btn secundario" style="padding: 10px 20px; border-radius: 8px;">&larr; Voltar para Lista</a>
            <div style="display: flex; gap: 10px;">
                <a href="editar.php?id=<?= $curriculo['id'] ?>" class="btn" style="background: #f59e0b; box-shadow: none; padding: 10px 20px; border-radius: 8px;">Editar</a>
                <a href="index.php" class="btn secundario" style="padding: 10px 20px; border-radius: 8px;">Tela Inicial</a>
            </div>
        </div>

        <!-- Cabeçalho do CV -->
        <div class="cv-header">
            <div class="cv-name"><?= htmlspecialchars($curriculo['nome']) ?></div>
            <div class="cv-cargo"><?= htmlspecialchars($curriculo['cargo']) ?></div>
            
            <div class="cv-contact">
                <?= htmlspecialchars($curriculo['cidade'] . ' - ' . $curriculo['estado']) ?><br>
                <?php if($contato): ?>
                    <?php if(!empty($contato['email'])): ?> 📧 <?= htmlspecialchars($contato['email']) ?> | <?php endif; ?>
                    <?php if(!empty($contato['telefone'])): ?> 📱 <?= htmlspecialchars($contato['telefone']) ?> | <?php endif; ?>
                    <?php if(!empty($contato['linkedin'])): ?> <a href="<?= htmlspecialchars($contato['linkedin']) ?>" target="_blank">LinkedIn</a> | <?php endif; ?>
                    <?php if(!empty($contato['github'])): ?> <a href="<?= htmlspecialchars($contato['github']) ?>" target="_blank">GitHub</a> | <?php endif; ?>
                    <?php if(!empty($contato['site_pessoal'])): ?> <a href="<?= htmlspecialchars($contato['site_pessoal']) ?>" target="_blank">Site Pessoal</a> <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Resumo -->
        <?php if(!empty($curriculo['resumo'])): ?>
            <div class="cv-section">
                <div class="cv-section-title">Resumo Profissional</div>
                <div class="cv-item-desc"><?= nl2br(htmlspecialchars($curriculo['resumo'])) ?></div>
            </div>
        <?php endif; ?>

        <!-- Experiências -->
        <?php if(!empty($experiencias)): ?>
            <div class="cv-section">
                <div class="cv-section-title">Experiência Profissional</div>
                <?php foreach($experiencias as $exp): ?>
                    <div class="cv-item">
                        <div class="cv-item-header">
                            <span class="cv-item-title"><?= htmlspecialchars($exp['funcao']) ?></span>
                            <span class="cv-item-date">
                                <?= $exp['periodo_inicio'] ? date('m/Y', strtotime($exp['periodo_inicio'])) : '' ?> 
                                - 
                                <?= $exp['trabalho_atual'] ? 'O momento' : ($exp['periodo_fim'] ? date('m/Y', strtotime($exp['periodo_fim'])) : '') ?>
                            </span>
                        </div>
                        <div class="cv-item-subtitle"><?= htmlspecialchars($exp['empresa']) ?></div>
                        <?php if(!empty($exp['descricao'])): ?>
                            <div class="cv-item-desc"><?= nl2br(htmlspecialchars($exp['descricao'])) ?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Formação -->
        <?php if(!empty($formacoes)): ?>
            <div class="cv-section">
                <div class="cv-section-title">Formação Acadêmica</div>
                <?php foreach($formacoes as $form): ?>
                    <div class="cv-item">
                        <div class="cv-item-header">
                            <span class="cv-item-title"><?= htmlspecialchars($form['curso']) ?></span>
                            <span class="cv-item-date">
                                <?= $form['periodo_inicio'] ? date('Y', strtotime($form['periodo_inicio'])) : '' ?> 
                                - 
                                <?= $form['cursando'] ? 'Cursando' : ($form['periodo_fim'] ? date('Y', strtotime($form['periodo_fim'])) : '') ?>
                            </span>
                        </div>
                        <div class="cv-item-subtitle"><?= htmlspecialchars($form['instituicao']) ?></div>
                        <?php if(!empty($form['descricao'])): ?>
                            <div class="cv-item-desc"><?= nl2br(htmlspecialchars($form['descricao'])) ?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="grid-2">
            <!-- Habilidades -->
            <?php if(!empty($habilidades)): ?>
                <div class="cv-section">
                    <div class="cv-section-title">Habilidades</div>
                    <div>
                        <?php foreach($habilidades as $hab): ?>
                            <span class="pill"><?= htmlspecialchars($hab['habilidade']) ?> (<?= htmlspecialchars($hab['nivel']) ?>)</span>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Idiomas -->
            <?php if(!empty($idiomas)): ?>
                <div class="cv-section">
                    <div class="cv-section-title">Idiomas</div>
                    <div>
                        <?php foreach($idiomas as $idioma): ?>
                            <span class="pill"><?= htmlspecialchars($idioma['idioma']) ?> - <?= htmlspecialchars($idioma['nivel']) ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Projetos -->
        <?php if(!empty($projetos)): ?>
            <div class="cv-section">
                <div class="cv-section-title">Projetos</div>
                <?php foreach($projetos as $proj): ?>
                    <div class="cv-item">
                        <div class="cv-item-header">
                            <span class="cv-item-title"><?= htmlspecialchars($proj['nome']) ?></span>
                            <?php if(!empty($proj['link'])): ?>
                                <a href="<?= htmlspecialchars($proj['link']) ?>" target="_blank" style="color: #3b82f6; text-decoration: none; font-size: 0.9rem;">Ver Projeto &nearr;</a>
                            <?php endif; ?>
                        </div>
                        <?php if(!empty($proj['tecnologias'])): ?>
                            <div class="cv-item-subtitle" style="font-size: 0.9rem; color: #64748b;">Tecnologias: <?= htmlspecialchars($proj['tecnologias']) ?></div>
                        <?php endif; ?>
                        <?php if(!empty($proj['descricao'])): ?>
                            <div class="cv-item-desc"><?= nl2br(htmlspecialchars($proj['descricao'])) ?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Certificados -->
        <?php if(!empty($certificados)): ?>
            <div class="cv-section">
                <div class="cv-section-title">Certificados</div>
                <?php foreach($certificados as $cert): ?>
                    <div class="cv-item">
                        <div class="cv-item-header">
                            <span class="cv-item-title"><?= htmlspecialchars($cert['nome']) ?></span>
                            <span class="cv-item-date"><?= $cert['data_conclusao'] ? date('d/m/Y', strtotime($cert['data_conclusao'])) : '' ?></span>
                        </div>
                        <div class="cv-item-subtitle"><?= htmlspecialchars($cert['instituicao']) ?></div>
                        <?php if(!empty($cert['url_certificado'])): ?>
                            <a href="<?= htmlspecialchars($cert['url_certificado']) ?>" target="_blank" style="color: #3b82f6; text-decoration: none; font-size: 0.9rem; display: inline-block; margin-top: 5px;">Ver Certificado &nearr;</a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
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
