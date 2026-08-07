<?php
require_once("config/conexao.php");
require_once("config/crud.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id   = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';

    if (!$id || !$tipo) {
        header("Location: listar_curriculos.php");
        exit;
    }

    $tabela = '';
    $dados  = ["dados_pessoais_id" => $id];

    switch ($tipo) {
        case 'experiencia':
            $tabela             = 'experiencias';
            $dados['empresa']        = $_POST['empresa'] ?? '';
            $dados['funcao']         = $_POST['funcao'] ?? '';
            $dados['periodo_inicio'] = !empty($_POST['exp_inicio']) ? $_POST['exp_inicio'] : null;
            $dados['periodo_fim']    = !empty($_POST['exp_fim']) ? $_POST['exp_fim'] : null;
            $dados['trabalho_atual'] = isset($_POST['trabalho_atual']) ? 1 : 0;
            $dados['descricao']      = $_POST['exp_descricao'] ?? '';
            break;

        case 'formacao':
            $tabela             = 'formacao';
            $dados['instituicao']    = $_POST['instituicao'] ?? '';
            $dados['curso']          = $_POST['curso'] ?? '';
            $dados['periodo_inicio'] = !empty($_POST['formacao_inicio']) ? $_POST['formacao_inicio'] : null;
            $dados['periodo_fim']    = !empty($_POST['formacao_fim']) ? $_POST['formacao_fim'] : null;
            $dados['cursando']       = isset($_POST['cursando']) ? 1 : 0;
            $dados['descricao']      = $_POST['formacao_descricao'] ?? '';
            break;

        case 'habilidade':
            $tabela         = 'habilidades';
            $dados['habilidade'] = $_POST['habilidade'] ?? '';
            $dados['nivel']      = $_POST['habilidade_nivel'] ?? 'Intermediário';
            break;

        case 'idioma':
            $tabela      = 'idiomas';
            $dados['idioma'] = $_POST['idioma'] ?? '';
            $dados['nivel']  = $_POST['idioma_nivel'] ?? 'Básico';
            break;

        case 'certificado':
            $tabela               = 'certificados';
            $dados['nome']            = $_POST['certificado_nome'] ?? '';
            $dados['instituicao']     = $_POST['certificado_instituicao'] ?? '';
            $dados['data_conclusao']  = !empty($_POST['certificado_data']) ? $_POST['certificado_data'] : null;
            $dados['url_certificado'] = $_POST['certificado_url'] ?? '';
            break;

        case 'projeto':
            $tabela             = 'projetos';
            $dados['nome']          = $_POST['projeto_nome'] ?? '';
            $dados['tecnologias']   = $_POST['projeto_tecnologias'] ?? '';
            $dados['link']          = $_POST['projeto_link'] ?? '';
            $dados['descricao']     = $_POST['projeto_descricao'] ?? '';
            break;

        default:
            die("Tipo inválido.");
    }

    if ($tabela) create($pdo, $tabela, $dados);

    header("Location: painel.php?id=" . $id . "&sucesso=1");
    exit;
}
?>
