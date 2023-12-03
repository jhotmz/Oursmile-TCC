<?php
require('conecta.php');

session_start();

if (isset($_POST['cadastrar'])) {
    $_SESSION['msg'] = '';

    // Verifica se o campo nome_categoria não está em branco
    if (!empty($_POST['nome_categoria'])) {
        try {
            // Verifica se a categoria já existe no banco de dados
            $stmt_check = $conn->prepare("SELECT COUNT(*) FROM tb_categoria WHERE nm_categoria = :categoria");
            $stmt_check->execute(array(':categoria' => $_POST['nome_categoria']));
            $count = $stmt_check->fetchColumn();

            if ($count == 0) {
                // A categoria não existe, então podemos inseri-la
                $stmt_insert = $conn->prepare("INSERT INTO tb_categoria (nm_categoria) VALUES(:categoria)");
                $stmt_insert->execute(array(':categoria' => $_POST['nome_categoria']));

                echo "<p>Categoria cadastrada com sucesso.</p>";
            } else {
                echo "<p>Essa categoria já existe!.</p>";
            }
        } catch (PDOException $e) {
            echo "<p>Erro ao cadastrar.</p>" . $e->getMessage();
        }
    } else {
        echo "<p>O campo categoria não pode estar em branco.</p>";
    }
}
?>
