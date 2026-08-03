<?php
require_once("config/conexao.php");
require_once("config/crud.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Processar upload de foto se enviado
    $foto_perfil = null;
    if (!empty($_FILES["foto_perfil"]["name"])) {
        $arquivo = $_FILES["foto_perfil"];
        $nome_arquivo = $arquivo["name"];
        $tipo_arquivo = $arquivo["type"];
        $tamanho_arquivo = $arquivo["size"];
        $temp_arquivo = $arquivo["tmp_name"];
        
        // Validações
        $tipos_permitidos = ["image/jpeg", "image/png", "image/webp"];
        $tamanho_maximo = 2 * 1024 * 1024; // 2MB
        
        if (in_array($tipo_arquivo, $tipos_permitidos) && $tamanho_arquivo <= $tamanho_maximo) {
            // Criar diretório se não existir
            if (!file_exists("uploads/fotos")) {
                mkdir("uploads/fotos", 0755, true);
            }
            
            // Gerar nome único para o arquivo
            $extensao = pathinfo($nome_arquivo, PATHINFO_EXTENSION);
            $nome_unico = "foto_" . time() . "." . $extensao;
            $caminho_destino = "uploads/fotos/" . $nome_unico;
            
            // Mover arquivo
            if (move_uploaded_file($temp_arquivo, $caminho_destino)) {
                $foto_perfil = $caminho_destino;
            }
        }
    }
    
    // 1. Inserir Dados Pessoais
    $dados_pessoais_id = create($pdo, "dados_pessoais", [
        "nome" => $_POST["nome"] ?? '',
        "cargo" => $_POST["cargo"] ?? '',
        "resumo" => $_POST["resumo"] ?? '',
        "objetivo" => $_POST["objetivo"] ?? '',
        "nascimento" => !empty($_POST["nascimento"]) ? $_POST["nascimento"] : null,
        "cidade" => $_POST["cidade"] ?? '',
        "estado" => $_POST["estado"] ?? '',
        "foto_perfil" => $foto_perfil
    ]);

    // 2. Inserir Contatos
    create($pdo, "contatos", [
        "dados_pessoais_id" => $dados_pessoais_id,
        "email" => $_POST["email"] ?? '',
        "telefone" => $_POST["telefone"] ?? '',
        "linkedin" => $_POST["linkedin"] ?? '',
        "github" => $_POST["github"] ?? '',
        "site_pessoal" => $_POST["site_pessoal"] ?? ''
    ]);

    // 3. Inserir Experiência Profissional (apenas se preenchida)
    if (!empty($_POST["empresa"])) {
        create($pdo, "experiencias", [
            "dados_pessoais_id" => $dados_pessoais_id,
            "empresa" => $_POST["empresa"],
            "funcao" => $_POST["funcao"] ?? '',
            "periodo_inicio" => !empty($_POST["exp_inicio"]) ? $_POST["exp_inicio"] : null,
            "periodo_fim" => !empty($_POST["exp_fim"]) ? $_POST["exp_fim"] : null,
            "trabalho_atual" => isset($_POST["trabalho_atual"]) ? 1 : 0,
            "descricao" => $_POST["exp_descricao"] ?? ''
        ]);
    }

    // 4. Inserir Formação (apenas se preenchida)
    if (!empty($_POST["instituicao"])) {
        create($pdo, "formacao", [
            "dados_pessoais_id" => $dados_pessoais_id,
            "instituicao" => $_POST["instituicao"],
            "curso" => $_POST["curso"] ?? '',
            "periodo_inicio" => !empty($_POST["formacao_inicio"]) ? $_POST["formacao_inicio"] : null,
            "periodo_fim" => !empty($_POST["formacao_fim"]) ? $_POST["formacao_fim"] : null,
            "cursando" => isset($_POST["cursando"]) ? 1 : 0,
            "descricao" => $_POST["formacao_descricao"] ?? ''
        ]);
    }

    // 5. Inserir Habilidades (apenas se preenchida)
    if (!empty($_POST["habilidade"])) {
        create($pdo, "habilidades", [
            "dados_pessoais_id" => $dados_pessoais_id,
            "habilidade" => $_POST["habilidade"],
            "nivel" => $_POST["habilidade_nivel"] ?? 'Intermediário'
        ]);
    }

    // 6. Inserir Idiomas (apenas se preenchida)
    if (!empty($_POST["idioma"])) {
        create($pdo, "idiomas", [
            "dados_pessoais_id" => $dados_pessoais_id,
            "idioma" => $_POST["idioma"],
            "nivel" => $_POST["idioma_nivel"] ?? 'Básico'
        ]);
    }

    // 7. Inserir Certificados (apenas se preenchida)
    if (!empty($_POST["certificado_nome"])) {
        create($pdo, "certificados", [
            "dados_pessoais_id" => $dados_pessoais_id,
            "nome" => $_POST["certificado_nome"],
            "instituicao" => $_POST["certificado_instituicao"] ?? '',
            "data_conclusao" => !empty($_POST["certificado_data"]) ? $_POST["certificado_data"] : null,
            "url_certificado" => $_POST["certificado_url"] ?? ''
        ]);
    }

    // 8. Inserir Projetos (apenas se preenchida)
    if (!empty($_POST["projeto_nome"])) {
        create($pdo, "projetos", [
            "dados_pessoais_id" => $dados_pessoais_id,
            "nome" => $_POST["projeto_nome"],
            "descricao" => $_POST["projeto_descricao"] ?? '',
            "tecnologias" => $_POST["projeto_tecnologias"] ?? '',
            "link" => $_POST["projeto_link"] ?? ''
        ]);
    }

    // Redireciona após salvar
    header("Location: listar_curriculos.php?sucesso=1");
    exit;
}
?>
