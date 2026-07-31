<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plataforma - Currículo digital</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="pagina-inicial">
    <main>
        <section class="conteiner-app hero-inicial">
            <p class="selo-inicial">PLATAFORMA PESSOAL</p>
            <h1 class="titulo-pagina">Currículo Digital</h1>
            <p class="descricao-pagina">
                Crie, organize e visualize seu currículo
                de maneira simples.
            </p>

            <nav class="grupo-botoes" aria-label="Ações principais">
                <a href="cadastrar.php" class="botao">Novo Currículo</a>
                <a href="listar_curriculos.php" class="botao botao-secundario">Ver Currículos</a>
            </nav>
        </section>

    </main>
        <?php
        require_once("partials/footer.php");
        ?>
</body>

</html>
