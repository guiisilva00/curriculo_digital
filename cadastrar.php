<?php
require_once("config/crud.php");
require_once("config/conexao.php");
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

        <form action="salvar.php" method="POST" enctype="multipart/form-data">

            <fieldset>
                <legend>Dados Pessoais</legend>

                <div class="grade-formulario">

                    <div class="campo-formulario">
                        <label for="nome">Nome</label>
                        <input id="nome" type="text" name="nome" required>
                    </div>

                    <div class="campo-formulario">
                        <label for="cargo">Cargo</label>
                        <input id="cargo" type="text" name="cargo" required>
                    </div>

                    <div class="campo-formulario largura-total">
                        <label for="foto_perfil">Foto de Perfil</label>
                        <input id="foto_perfil" type="file" name="foto_perfil" accept="image/*">
                    </div>

                    <div class="campo-formulario largura-total">
                        <label for="resumo">Resumo Profissional</label>
                        <textarea id="resumo" name="resumo" rows="5"></textarea>
                    </div>

                    <div class="campo-formulario largura-total">
                        <label for="objetivo">Objetivo Profissional</label>
                        <textarea id="objetivo" name="objetivo" rows="4"></textarea>
                    </div>

                    <div class="campo-formulario">
                        <label for="nascimento">Data de nascimento</label>
                        <input id="nascimento" type="date" name="nascimento">
                    </div>

                    <div class="campo-formulario">
                        <label for="cidade">Cidade</label>
                        <input id="cidade" type="text" name="cidade">
                    </div>

                    <div class="campo-formulario">
                        <label for="estado">Estado</label>
                        <input id="estado" type="text" name="estado">
                    </div>

                </div>

            </fieldset>

            <fieldset>
                <legend>Contato</legend>

                <div class="grade-formulario">

                    <div class="campo-formulario">
                        <label for="email">E-mail</label>
                        <input id="email" type="email" name="email">
                    </div>

                    <div class="campo-formulario">
                        <label for="telefone">Telefone</label>
                        <input id="telefone" type="tel" name="telefone">
                    </div>

                    <div class="campo-formulario">
                        <label for="linkedin">LinkedIn</label>
                        <input id="linkedin" type="url" name="linkedin">
                    </div>

                    <div class="campo-formulario">
                        <label for="github">GitHub</label>
                        <input id="github" type="url" name="github">
                    </div>

                    <div class="campo-formulario largura-total">
                        <label for="site_pessoal">Site Pessoal</label>
                        <input id="site_pessoal" type="url" name="site_pessoal">
                    </div>

                </div>

            </fieldset>

            <fieldset>
                <legend>Experiência Profissional</legend>
                <div class="grade-formulario">
                    <div class="campo-formulario">
                        <label for="empresa">Empresa</label>
                        <input id="empresa" type="text" name="empresa">
                    </div>
                    <div class="campo-formulario">
                        <label for="funcao">Função</label>
                        <input id="funcao" type="text" name="funcao">
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
                        <label for="exp_descricao">Descrição da Experiência</label>
                        <textarea id="exp_descricao" name="exp_descricao" rows="4"></textarea>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Formação Acadêmica</legend>
                <div class="grade-formulario">
                    <div class="campo-formulario">
                        <label for="instituicao">Instituição</label>
                        <input id="instituicao" type="text" name="instituicao">
                    </div>
                    <div class="campo-formulario">
                        <label for="curso">Curso</label>
                        <input id="curso" type="text" name="curso">
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
                </div>
            </fieldset>

            <fieldset>
                <legend>Habilidades</legend>
                <div class="grade-formulario">
                    <div class="campo-formulario">
                        <label for="habilidade">Habilidade</label>
                        <input id="habilidade" type="text" name="habilidade">
                    </div>
                    <div class="campo-formulario">
                        <label for="habilidade_nivel">Nível</label>
                        <select id="habilidade_nivel" name="habilidade_nivel">
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
                        <label for="idioma">Idioma</label>
                        <input id="idioma" type="text" name="idioma">
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
                </div>
            </fieldset>

            <fieldset>
                <legend>Certificados</legend>
                <div class="grade-formulario">
                    <div class="campo-formulario">
                        <label for="certificado_nome">Nome do Certificado</label>
                        <input id="certificado_nome" type="text" name="certificado_nome">
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
                </div>
            </fieldset>

            <fieldset>
                <legend>Projetos</legend>
                <div class="grade-formulario">
                    <div class="campo-formulario">
                        <label for="projeto_nome">Nome do Projeto</label>
                        <input id="projeto_nome" type="text" name="projeto_nome">
                    </div>
                    <div class="campo-formulario">
                        <label for="projeto_tecnologias">Tecnologias (ex.: PHP, MySQL)</label>
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
                </div>
            </fieldset>

            <div class="grupo-botoes" style="justify-content: flex-start; margin-top: 20px;">
                <button type="submit" class="botao">Salvar Currículo</button>
                <a href="index.php" class="botao botao-secundario">Cancelar / Voltar</a>
            </div>

        </form>

    </section>

</main>

<?php
require_once("partials/footer.php");
?>
</body>

</html>
