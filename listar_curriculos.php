<?php
require_once("config/conexao.php");
require_once("config/crud.php");

$curriculos = readAll($pdo, "dados_pessoais");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Currículos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="pagina-listagem">
<main>
    <section class="conteiner-app conteiner-listagem">
        <h1 class="titulo-pagina">Currículos Cadastrados</h1>
        
        <?php if(isset($_GET['sucesso'])): ?>
            <p class="mensagem-sucesso" role="status">
                Operação realizada com sucesso!
            </p>
        <?php endif; ?>

        <nav class="grupo-botoes acoes-listagem" aria-label="Ações da listagem">
            <a href="cadastrar.php" class="botao"> + Novo Currículo</a>
            <a href="index.php" class="botao botao-secundario"> Voltar para Início</a>
        </nav>

        <?php if (empty($curriculos)): ?>
            <p class="estado-vazio">Nenhum currículo cadastrado ainda. Crie o primeiro para começar.</p>
        <?php else: ?>
            <section class="grade-curriculos" aria-label="Currículos cadastrados">
                <?php foreach ($curriculos as $c): ?>
                    <article class="cartao-curriculo">
                        <h2 class="cartao-titulo"><?= htmlspecialchars($c['nome']) ?></h2>
                        <p class="cartao-subtitulo"><?= htmlspecialchars($c['cargo']) ?></p>
                        <p class="cartao-localizacao">
                            <span aria-hidden="true">📍</span>
                            <?= htmlspecialchars($c['cidade'] . ' - ' . $c['estado']) ?>
                        </p>
                        
                        <nav class="cartao-acoes" aria-label="Ações para <?= htmlspecialchars($c['nome']) ?>">
                            <a href="visualizar.php?id=<?= $c['id'] ?>" class="botao-pequeno botao-ver">Ver</a>
                            <a href="editar.php?id=<?= $c['id'] ?>" class="botao-pequeno botao-editar">Editar</a>
                            <a href="excluir.php?id=<?= $c['id'] ?>" class="botao-pequeno botao-excluir" onclick="return confirm('Tem certeza que deseja excluir este currículo? Esta ação não pode ser desfeita e todas as informações relacionadas serão apagadas (ON DELETE CASCADE).');">Excluir</a>
                        </nav>
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
