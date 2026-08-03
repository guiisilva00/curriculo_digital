<?php
require_once("config/conexao.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';

if (!$id || !$tipo) {
    header("Location: listar_curriculos.php");
    exit;
}

$titulos = [
    'experiencia' => 'Experiência Profissional',
    'formacao' => 'Formação Acadêmica',
    'habilidade' => 'Habilidade',
    'idioma' => 'Idioma',
    'certificado' => 'Certificado',
    'projeto' => 'Projeto'
];

if (!array_key_exists($tipo, $titulos)) {
    die("Tipo inválido.");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar <?= $titulos[$tipo] ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<main>
    <section class="conteiner-app conteiner-formulario">
        <h1 class="titulo-pagina">Adicionar <?= $titulos[$tipo] ?></h1>
        
        <form action="salvar_item.php" method="POST">
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="hidden" name="tipo" value="<?= $tipo ?>">

            <fieldset>
                <div class="grade-formulario">
                    
                    <?php if ($tipo === 'experiencia'): ?>
                        <div class="campo-formulario">
                            <label for="empresa">Empresa</label>
                            <input id="empresa" type="text" name="empresa" required>
                        </div>
                        <div class="campo-formulario">
                            <label for="funcao">Função</label>
                            <input id="funcao" type="text" name="funcao" required>
                        </div>
                        <div class="campo-formulario">
                            <label for="exp_inicio">Período de Início</label>
                            <input id="exp_inicio" type="date" name="exp_inicio">
                        </div>
                        <div class="campo-formulario">
                            <label for="exp_fim">Período de Fim</label>
                            <input id="exp_fim" type="date" name="exp_fim">
                        </div>
                        <div class="campo-formulario largura-total" style="flex-direction: row; align-items: center; gap: 10px;">
                            <input type="checkbox" name="trabalho_atual" value="1" id="trabalho_atual">
                            <label for="trabalho_atual" style="margin-bottom: 0;">Trabalho Atual</label>
                        </div>
                        <div class="campo-formulario largura-total">
                            <label for="exp_descricao">Descrição</label>
                            <textarea id="exp_descricao" name="exp_descricao" rows="4"></textarea>
                        </div>
                    <?php endif; ?>

                    <?php if ($tipo === 'formacao'): ?>
                        <div class="campo-formulario">
                            <label for="instituicao">Instituição</label>
                            <input id="instituicao" type="text" name="instituicao" required>
                        </div>
                        <div class="campo-formulario">
                            <label for="curso">Curso</label>
                            <input id="curso" type="text" name="curso" required>
                        </div>
                        <div class="campo-formulario">
                            <label for="formacao_inicio">Período de Início</label>
                            <input id="formacao_inicio" type="date" name="formacao_inicio">
                        </div>
                        <div class="campo-formulario">
                            <label for="formacao_fim">Período de Fim</label>
                            <input id="formacao_fim" type="date" name="formacao_fim">
                        </div>
                        <div class="campo-formulario largura-total" style="flex-direction: row; align-items: center; gap: 10px;">
                            <input type="checkbox" name="cursando" value="1" id="cursando">
                            <label for="cursando" style="margin-bottom: 0;">Cursando atualmente</label>
                        </div>
                        <div class="campo-formulario largura-total">
                            <label for="formacao_descricao">Descrição</label>
                            <textarea id="formacao_descricao" name="formacao_descricao" rows="4"></textarea>
                        </div>
                    <?php endif; ?>

                    <?php if ($tipo === 'habilidade'): ?>
                        <div class="campo-formulario">
                            <label for="habilidade">Habilidade</label>
                            <input id="habilidade" type="text" name="habilidade" required>
                        </div>
                        <div class="campo-formulario">
                            <label for="habilidade_nivel">Nível</label>
                            <select id="habilidade_nivel" name="habilidade_nivel">
                                <option value="Básico">Básico</option>
                                <option value="Intermediário" selected>Intermediário</option>
                                <option value="Avançado">Avançado</option>
                            </select>
                        </div>
                    <?php endif; ?>

                    <?php if ($tipo === 'idioma'): ?>
                        <div class="campo-formulario">
                            <label for="idioma">Idioma</label>
                            <input id="idioma" type="text" name="idioma" required>
                        </div>
                        <div class="campo-formulario">
                            <label for="idioma_nivel">Nível</label>
                            <select id="idioma_nivel" name="idioma_nivel">
                                <option value="Básico" selected>Básico</option>
                                <option value="Intermediário">Intermediário</option>
                                <option value="Avançado">Avançado</option>
                                <option value="Fluente">Fluente</option>
                                <option value="Nativo">Nativo</option>
                            </select>
                        </div>
                    <?php endif; ?>

                    <?php if ($tipo === 'certificado'): ?>
                        <div class="campo-formulario">
                            <label for="certificado_nome">Nome do Certificado</label>
                            <input id="certificado_nome" type="text" name="certificado_nome" required>
                        </div>
                        <div class="campo-formulario">
                            <label for="certificado_instituicao">Instituição</label>
                            <input id="certificado_instituicao" type="text" name="certificado_instituicao">
                        </div>
                        <div class="campo-formulario">
                            <label for="certificado_data">Data de Conclusão</label>
                            <input id="certificado_data" type="date" name="certificado_data">
                        </div>
                        <div class="campo-formulario">
                            <label for="certificado_url">URL do Certificado</label>
                            <input id="certificado_url" type="url" name="certificado_url">
                        </div>
                    <?php endif; ?>

                    <?php if ($tipo === 'projeto'): ?>
                        <div class="campo-formulario">
                            <label for="projeto_nome">Nome do Projeto</label>
                            <input id="projeto_nome" type="text" name="projeto_nome" required>
                        </div>
                        <div class="campo-formulario">
                            <label for="projeto_tecnologias">Tecnologias</label>
                            <input id="projeto_tecnologias" type="text" name="projeto_tecnologias">
                        </div>
                        <div class="campo-formulario">
                            <label for="projeto_link">Link do Projeto</label>
                            <input id="projeto_link" type="url" name="projeto_link">
                        </div>
                        <div class="campo-formulario largura-total">
                            <label for="projeto_descricao">Descrição</label>
                            <textarea id="projeto_descricao" name="projeto_descricao" rows="4"></textarea>
                        </div>
                    <?php endif; ?>

                </div>
            </fieldset>

            <div class="grupo-botoes" style="justify-content: flex-start; margin-top: 20px;">
                <button type="submit" class="botao">Salvar</button>
                <a href="painel.php?id=<?= $id ?>" class="botao botao-secundario">Cancelar / Voltar</a>
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
