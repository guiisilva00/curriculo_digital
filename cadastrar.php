<?php
require_once("config/crud.php");
require_once("config/conexao.php");
// $id = create($pdo, "dados_pessoais", [

//     "nome" => $_POST["nome"],
//     "cargo" => $_POST["cargo"],
//     "resumo" => $_POST["resumo"],
//     "objetivo" => $_POST["objetivo"],
//     "cidade" => $_POST["cidade"],
//     "estado" => $_POST["estado"]

// ]);

// create($pdo, "contatos", [

//     "dados_pessoais_id" => $id,
//     "email" => $_POST["email"],
//     "telefone" => $_POST["telefone"],
//     "linkedin" => $_POST["linkedin"],
//     "github" => $_POST["github"],
//     "site_pessoal" => $_POST["site"]

// ]);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plataforma - Cadastro de currículo</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<main>

    <section class="conteiner-app conteiner-formulario">

        <h1 class="titulo-pagina">Novo Currículo</h1>

        <p class="descricao-pagina">
            Preencha os campos abaixo para criar seu currículo digital.
        </p>

        <form action="salvar.php" method="POST">


            <fieldset>

                <legend>Dados Pessoais</legend>

                <div class="grade-formulario">

                    <div class="campo-formulario">
                        <label>Nome</label>
                        <input type="text" name="nome" required>
                    </div>

                    <div class="campo-formulario">
                        <label>Cargo</label>
                        <input type="text" name="cargo" required>
                    </div>

                    <div class="campo-formulario largura-total">
                        <label>Resumo Profissional</label>
                        <textarea name="resumo" rows="5"></textarea>
                    </div>

                    <div class="campo-formulario largura-total">
                        <label>Objetivo Profissional</label>
                        <textarea name="objetivo" rows="4"></textarea>
                    </div>

                    <div class="campo-formulario">
                        <label>Data de nascimento</label>
                        <input type="date" name="nascimento">
                    </div>

                    <div class="campo-formulario">
                        <label>Cidade</label>
                        <input type="text" name="cidade">
                    </div>

                    <div class="campo-formulario">
                        <label>Estado</label>
                        <input type="text" name="estado">
                    </div>

                </div>

            </fieldset>

            <fieldset>

                <legend>Contato</legend>

                <div class="grade-formulario">

                    <div class="campo-formulario">
                        <label>E-mail</label>
                        <input type="email" name="email">
                    </div>

                    <div class="campo-formulario">
                        <label>Telefone</label>
                        <input type="text" name="telefone">
                    </div>

                    <div class="campo-formulario">
                        <label>LinkedIn</label>
                        <input type="url" name="linkedin">
                    </div>

                    <div class="campo-formulario">
                        <label>GitHub</label>
                        <input type="url" name="github">
                    </div>

                    <div class="campo-formulario largura-total">
                        <label>Site Pessoal</label>
                        <input type="url" name="site_pessoal">
                    </div>

                </div>

            </fieldset>

            <fieldset>
                <legend>Experiência Profissional</legend>
                <div class="grade-formulario">
                    <div class="campo-formulario">
                        <label>Empresa</label>
                        <input type="text" name="empresa">
                    </div>
                    <div class="campo-formulario">
                        <label>Função</label>
                        <input type="text" name="funcao">
                    </div>
                    <div class="campo-formulario">
                        <label>Período de Início</label>
                        <input type="date" name="exp_inicio">
                    </div>
                    <div class="campo-formulario">
                        <label>Período de Fim</label>
                        <input type="date" name="exp_fim">
                    </div>
                    <div class="campo-formulario largura-total" style="flex-direction: row; align-items: center; gap: 10px;">
                        <input type="checkbox" name="trabalho_atual" value="1" id="trabalho_atual">
                        <label for="trabalho_atual" style="margin-bottom: 0;">Trabalho Atual</label>
                    </div>
                    <div class="campo-formulario largura-total">
                        <label>Descrição da Experiência</label>
                        <textarea name="exp_descricao" rows="4"></textarea>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Formação Acadêmica</legend>
                <div class="grade-formulario">
                    <div class="campo-formulario">
                        <label>Instituição</label>
                        <input type="text" name="instituicao">
                    </div>
                    <div class="campo-formulario">
                        <label>Curso</label>
                        <input type="text" name="curso">
                    </div>
                    <div class="campo-formulario">
                        <label>Período de Início</label>
                        <input type="date" name="formacao_inicio">
                    </div>
                    <div class="campo-formulario">
                        <label>Período de Fim</label>
                        <input type="date" name="formacao_fim">
                    </div>
                    <div class="campo-formulario largura-total" style="flex-direction: row; align-items: center; gap: 10px;">
                        <input type="checkbox" name="cursando" value="1" id="cursando">
                        <label for="cursando" style="margin-bottom: 0;">Cursando atualmente</label>
                    </div>
                    <div class="campo-formulario largura-total">
                        <label>Descrição</label>
                        <textarea name="formacao_descricao" rows="4"></textarea>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Habilidades</legend>
                <div class="grade-formulario">
                    <div class="campo-formulario">
                        <label>Habilidade</label>
                        <input type="text" name="habilidade">
                    </div>
                    <div class="campo-formulario">
                        <label>Nível</label>
                        <select name="habilidade_nivel">
                            <option value="Básico">Básico</option>
                            <option value="Intermediário" selected>Intermediário</option>
                            <option value="Avançado">Avançado</option>
                        </select>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Idiomas</legend>
                <div class="grade-formulario">
                    <div class="campo-formulario">
                        <label>Idioma</label>
                        <input type="text" name="idioma">
                    </div>
                    <div class="campo-formulario">
                        <label>Nível</label>
                        <select name="idioma_nivel">
                            <option value="Básico" selected>Básico</option>
                            <option value="Intermediário">Intermediário</option>
                            <option value="Avançado">Avançado</option>
                            <option value="Fluente">Fluente</option>
                            <option value="Nativo">Nativo</option>
                        </select>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Certificados</legend>
                <div class="grade-formulario">
                    <div class="campo-formulario">
                        <label>Nome do Certificado</label>
                        <input type="text" name="certificado_nome">
                    </div>
                    <div class="campo-formulario">
                        <label>Instituição</label>
                        <input type="text" name="certificado_instituicao">
                    </div>
                    <div class="campo-formulario">
                        <label>Data de Conclusão</label>
                        <input type="date" name="certificado_data">
                    </div>
                    <div class="campo-formulario">
                        <label>URL do Certificado</label>
                        <input type="url" name="certificado_url">
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Projetos</legend>
                <div class="grade-formulario">
                    <div class="campo-formulario">
                        <label>Nome do Projeto</label>
                        <input type="text" name="projeto_nome">
                    </div>
                    <div class="campo-formulario">
                        <label>Tecnologias (ex: PHP, MySQL)</label>
                        <input type="text" name="projeto_tecnologias">
                    </div>
                    <div class="campo-formulario">
                        <label>Link do Projeto</label>
                        <input type="url" name="projeto_link">
                    </div>
                    <div class="campo-formulario largura-total">
                        <label>Descrição</label>
                        <textarea name="projeto_descricao" rows="4"></textarea>
                    </div>
                </div>
            </fieldset>

            <div class="grupo-botoes" style="justify-content: flex-start; margin-top: 20px;">
                <button type="submit" class="botao">Salvar Currículo</button>
                <a href="index.php" class="botao botao-secundario" style="padding: 15px 30px; border-radius: 8px; text-decoration: none; color: white;">Cancelar / Voltar</a>
            </div>

        </form>

    </section>

</main>

<?php
require_once("partials/footer.php");
?>
</body>

</html>

