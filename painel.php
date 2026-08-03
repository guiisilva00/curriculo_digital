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
    <title>Painel do Currículo</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<main>
    <section class="conteiner-app">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h1 class="titulo-pagina">Painel do Currículo: <?= htmlspecialchars($curriculo['nome']) ?></h1>
            <div>
                <a href="visualizar.php?id=<?= $id ?>" class="botao">Visualizar / PDF</a>
                <a href="listar_curriculos.php" class="botao botao-secundario">Voltar</a>
            </div>
        </div>

        <?php if(isset($_GET['sucesso'])): ?>
            <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                Operação realizada com sucesso!
            </div>
        <?php endif; ?>

        <div style="display: grid; grid-template-columns: 1fr; gap: 20px;">
            
            <!-- Dados Básicos -->
            <div class="cartao-curriculo" style="background: rgba(255, 255, 255, 0.9); padding: 20px; border-radius: 16px;">
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #ddd; padding-bottom: 10px; margin-bottom: 15px;">
                    <h2 style="font-size: 1.2rem; color: var(--navy-blue);">Dados Pessoais e Contato</h2>
                    <a href="editar.php?id=<?= $id ?>" class="botao" style="padding: 5px 10px; font-size: 0.9rem;">Editar</a>
                </div>
                <p><strong>Nome:</strong> <?= htmlspecialchars($curriculo['nome']) ?></p>
                <p><strong>Cargo:</strong> <?= htmlspecialchars($curriculo['cargo']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($contato['email'] ?? 'N/A') ?></p>
            </div>

            <!-- Experiência -->
            <div class="cartao-curriculo" style="background: rgba(255, 255, 255, 0.9); padding: 20px; border-radius: 16px;">
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #ddd; padding-bottom: 10px; margin-bottom: 15px;">
                    <h2 style="font-size: 1.2rem; color: var(--navy-blue);">Experiência Profissional</h2>
                    <a href="adicionar_item.php?id=<?= $id ?>&tipo=experiencia" class="botao" style="padding: 5px 10px; font-size: 0.9rem;">+ Adicionar</a>
                </div>
                <?php if (empty($experiencias)): ?>
                    <p style="color: #666;">Nenhuma experiência cadastrada.</p>
                <?php else: ?>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <?php foreach($experiencias as $exp): ?>
                            <li style="border: 1px solid #eee; padding: 10px; border-radius: 8px; margin-bottom: 10px;">
                                <strong><?= htmlspecialchars($exp['empresa']) ?></strong> - <?= htmlspecialchars($exp['funcao']) ?>
                                <a href="excluir_item.php?id=<?= $exp['id'] ?>&tipo=experiencia&curriculo_id=<?= $id ?>" style="color: red; float: right; font-size: 0.8rem; text-decoration: none;" onclick="return confirm('Tem certeza?');">Excluir</a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <!-- Formação -->
            <div class="cartao-curriculo" style="background: rgba(255, 255, 255, 0.9); padding: 20px; border-radius: 16px;">
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #ddd; padding-bottom: 10px; margin-bottom: 15px;">
                    <h2 style="font-size: 1.2rem; color: var(--navy-blue);">Formação Acadêmica</h2>
                    <a href="adicionar_item.php?id=<?= $id ?>&tipo=formacao" class="botao" style="padding: 5px 10px; font-size: 0.9rem;">+ Adicionar</a>
                </div>
                <?php if (empty($formacoes)): ?>
                    <p style="color: #666;">Nenhuma formação cadastrada.</p>
                <?php else: ?>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <?php foreach($formacoes as $f): ?>
                            <li style="border: 1px solid #eee; padding: 10px; border-radius: 8px; margin-bottom: 10px;">
                                <strong><?= htmlspecialchars($f['instituicao']) ?></strong> - <?= htmlspecialchars($f['curso']) ?>
                                <a href="excluir_item.php?id=<?= $f['id'] ?>&tipo=formacao&curriculo_id=<?= $id ?>" style="color: red; float: right; font-size: 0.8rem; text-decoration: none;" onclick="return confirm('Tem certeza?');">Excluir</a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <!-- Habilidades -->
            <div class="cartao-curriculo" style="background: rgba(255, 255, 255, 0.9); padding: 20px; border-radius: 16px;">
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #ddd; padding-bottom: 10px; margin-bottom: 15px;">
                    <h2 style="font-size: 1.2rem; color: var(--navy-blue);">Habilidades</h2>
                    <a href="adicionar_item.php?id=<?= $id ?>&tipo=habilidade" class="botao" style="padding: 5px 10px; font-size: 0.9rem;">+ Adicionar</a>
                </div>
                <?php if (empty($habilidades)): ?>
                    <p style="color: #666;">Nenhuma habilidade cadastrada.</p>
                <?php else: ?>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <?php foreach($habilidades as $h): ?>
                            <li style="border: 1px solid #eee; padding: 10px; border-radius: 8px; margin-bottom: 10px;">
                                <strong><?= htmlspecialchars($h['habilidade']) ?></strong> (<?= htmlspecialchars($h['nivel']) ?>)
                                <a href="excluir_item.php?id=<?= $h['id'] ?>&tipo=habilidade&curriculo_id=<?= $id ?>" style="color: red; float: right; font-size: 0.8rem; text-decoration: none;" onclick="return confirm('Tem certeza?');">Excluir</a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <!-- Idiomas -->
            <div class="cartao-curriculo" style="background: rgba(255, 255, 255, 0.9); padding: 20px; border-radius: 16px;">
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #ddd; padding-bottom: 10px; margin-bottom: 15px;">
                    <h2 style="font-size: 1.2rem; color: var(--navy-blue);">Idiomas</h2>
                    <a href="adicionar_item.php?id=<?= $id ?>&tipo=idioma" class="botao" style="padding: 5px 10px; font-size: 0.9rem;">+ Adicionar</a>
                </div>
                <?php if (empty($idiomas)): ?>
                    <p style="color: #666;">Nenhum idioma cadastrado.</p>
                <?php else: ?>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <?php foreach($idiomas as $i): ?>
                            <li style="border: 1px solid #eee; padding: 10px; border-radius: 8px; margin-bottom: 10px;">
                                <strong><?= htmlspecialchars($i['idioma']) ?></strong> (<?= htmlspecialchars($i['nivel']) ?>)
                                <a href="excluir_item.php?id=<?= $i['id'] ?>&tipo=idioma&curriculo_id=<?= $id ?>" style="color: red; float: right; font-size: 0.8rem; text-decoration: none;" onclick="return confirm('Tem certeza?');">Excluir</a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <!-- Certificados -->
            <div class="cartao-curriculo" style="background: rgba(255, 255, 255, 0.9); padding: 20px; border-radius: 16px;">
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #ddd; padding-bottom: 10px; margin-bottom: 15px;">
                    <h2 style="font-size: 1.2rem; color: var(--navy-blue);">Certificados</h2>
                    <a href="adicionar_item.php?id=<?= $id ?>&tipo=certificado" class="botao" style="padding: 5px 10px; font-size: 0.9rem;">+ Adicionar</a>
                </div>
                <?php if (empty($certificados)): ?>
                    <p style="color: #666;">Nenhum certificado cadastrado.</p>
                <?php else: ?>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <?php foreach($certificados as $c): ?>
                            <li style="border: 1px solid #eee; padding: 10px; border-radius: 8px; margin-bottom: 10px;">
                                <strong><?= htmlspecialchars($c['nome']) ?></strong> - <?= htmlspecialchars($c['instituicao']) ?>
                                <a href="excluir_item.php?id=<?= $c['id'] ?>&tipo=certificado&curriculo_id=<?= $id ?>" style="color: red; float: right; font-size: 0.8rem; text-decoration: none;" onclick="return confirm('Tem certeza?');">Excluir</a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <!-- Projetos -->
            <div class="cartao-curriculo" style="background: rgba(255, 255, 255, 0.9); padding: 20px; border-radius: 16px;">
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #ddd; padding-bottom: 10px; margin-bottom: 15px;">
                    <h2 style="font-size: 1.2rem; color: var(--navy-blue);">Projetos</h2>
                    <a href="adicionar_item.php?id=<?= $id ?>&tipo=projeto" class="botao" style="padding: 5px 10px; font-size: 0.9rem;">+ Adicionar</a>
                </div>
                <?php if (empty($projetos)): ?>
                    <p style="color: #666;">Nenhum projeto cadastrado.</p>
                <?php else: ?>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <?php foreach($projetos as $p): ?>
                            <li style="border: 1px solid #eee; padding: 10px; border-radius: 8px; margin-bottom: 10px;">
                                <strong><?= htmlspecialchars($p['nome']) ?></strong> (<?= htmlspecialchars($p['tecnologias']) ?>)
                                <a href="excluir_item.php?id=<?= $p['id'] ?>&tipo=projeto&curriculo_id=<?= $id ?>" style="color: red; float: right; font-size: 0.8rem; text-decoration: none;" onclick="return confirm('Tem certeza?');">Excluir</a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>

        </div>
    </section>
</main>
<?php
if(file_exists("partials/footer.php")){
    require_once("partials/footer.php");
}
?>
</body>
</html>
