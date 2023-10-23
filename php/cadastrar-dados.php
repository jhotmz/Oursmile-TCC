<?php
try {
    require('conecta.php');
    $stmt = $conn->prepare('INSERT INTO tb_usuario(nm_nome, nm_sobrenome, nm_email, ds_senha, nm_local, id_nivel) VALUES(:nome, :sobrenome, :email, :password, :endereco, :nivel)');
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->execute(array(
        ':nome' => $_POST['nome'],
        ':sobrenome' => $_POST['sobrenome'],
        ':email' => $_POST['email'],
        ':password' => $_POST['senha'],
        ':endereco' => $_POST['endereco'],
        ':nivel' => $_POST['nivel']
    ));

    echo "funciona";
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
