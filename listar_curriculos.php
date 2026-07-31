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
    <style>
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
            text-align: left;
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .card-title {
            color: #0f172a;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .card-subtitle {
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }
        .card-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            border-top: 1px solid #f1f5f9;
            padding-top: 15px;
        }
        .btn-small {
            padding: 8px 15px;
            font-size: 0.85rem;
            border-radius: 6px;
            text-decoration: none;
            text-align: center;
            color: white;
            flex: 1;
            transition: opacity 0.2s;
        }
        .btn-small:hover { opacity: 0.85; }
        .btn-ver { background: #3b82f6; }
        .btn-editar { background: #f59e0b; }
        .btn-excluir { background: #ef4444; }
    </style>
</head>
<body>
<main>
    <section class="container" style="max-width: 1000px;">
        <h1 class="title">Currículos Cadastrados</h1>
        
        <?php if(isset($_GET['sucesso'])): ?>
            <div style="background: #dcfce3; color: #166534; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-weight: 500;">
                Operação realizada com sucesso!
            </div>
        <?php endif; ?>

        <div class="botoes" style="justify-content: flex-start; margin-bottom: 30px;">
            <a href="cadastrar.php" class="btn"> + Novo Currículo</a>
            <a href="index.php" class="btn secundario"> Voltar para Início</a>
        </div>

        <?php if (empty($curriculos)): ?>
            <p class="text">Nenhum currículo cadastrado ainda.</p>
        <?php else: ?>
            <div class="cards-grid">
                <?php foreach ($curriculos as $c): ?>
                    <div class="card">
                        <div class="card-title"><?= htmlspecialchars($c['nome']) ?></div>
                        <div class="card-subtitle"><?= htmlspecialchars($c['cargo']) ?></div>
                        <p style="color: #475569; font-size: 0.85rem; margin-bottom: 10px;">
                            📍 <?= htmlspecialchars($c['cidade'] . ' - ' . $c['estado']) ?>
                        </p>
                        
                        <div class="card-actions">
                            <a href="visualizar.php?id=<?= $c['id'] ?>" class="btn-small btn-ver">Ver</a>
                            <a href="editar.php?id=<?= $c['id'] ?>" class="btn-small btn-editar">Editar</a>
                            <a href="excluir.php?id=<?= $c['id'] ?>" class="btn-small btn-excluir" onclick="return confirm('Tem certeza que deseja excluir este currículo? Esta ação não pode ser desfeita e todas as informações relacionadas serão apagadas (ON DELETE CASCADE).');">Excluir</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </section>
</main>

<?php 
// Verifica se o arquivo existe antes de incluir
if(file_exists("partials/footer.php")){
    require_once("partials/footer.php"); 
}
?>
</body>
</html>