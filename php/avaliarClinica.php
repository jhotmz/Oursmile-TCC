<?php

session_start(); // Iniciar a sessão

// Incluir o arquivo com a conexão com banco de dados
include_once 'conecta.php';
$id_clinica = $_POST['id_clinica'];
// Definir fuso horário de São Paulo
date_default_timezone_set('America/Sao_Paulo');

// Acessar o IF quando é selecionado ao menos uma estrela
if (!empty($_POST['estrela'])) {

    // Receber os dados do formulário
    $estrela = filter_input(INPUT_POST, 'estrela', FILTER_DEFAULT);
    $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_DEFAULT);
    $autor = filter_input(INPUT_POST, 'autor', FILTER_DEFAULT);

    // Criar a QUERY cadastrar no banco de dados
    $query_avaliacao = "INSERT INTO tb_avaliacao (vl_nota, ds_mensagem, dt_criacao, nm_autor, id_clinica) VALUES (:nota, :mensagem, :created, :autor, :clinica)";
    $date = date("Y-m-d H:i:s");
    // Preparar a QUERY
    $cad_avaliacao = $conn->prepare($query_avaliacao);

    // Substituir os links pelo valor
    $cad_avaliacao->bindParam(':nota', $estrela, PDO::PARAM_INT);
    $cad_avaliacao->bindParam(':mensagem', $mensagem, PDO::PARAM_STR);
    $cad_avaliacao->bindParam(':autor', $autor, PDO::PARAM_STR);
    $cad_avaliacao->bindParam(':clinica', $id_clinica, PDO::PARAM_STR);
    $cad_avaliacao->bindParam(':created', $date);

    // Acessa o IF quando cadastrar corretamente
    if ($cad_avaliacao->execute()) {
        // Criar a mensagem de erro
        echo "<p style='color: green;'>Avaliação cadastrada com sucesso!</p>";
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        // Criar a mensagem de erro
        echo "<p style='color: #f00;'>Erro: Avaliação não cadastrar!</p>";
    }
} else {
    // Criar a mensagem de erro
    echo "<p style='color: #f00;'> Necessário selecionar pelo menos 1 estrela.</p>";
}
