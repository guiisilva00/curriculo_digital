<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plataforma - Currículo digital</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <main>
        <section class="container">
            <h1 class="title">Currículo Digital</h1>
            <p class="text">
                Crie, organize e visualize seu currículo
                de maneira simples.
            </p>

            <div class="botoes">
                <a href="cadastrar.php" class="btn">Novo Currículo</a>
                <a href="listar_curriculos.php" class="btn secundario">Ver Currículos</a>
            </div>
        </section>

    </main>
        <?php
        require_once("partials/footer.php");
        ?>
</body>

</html>