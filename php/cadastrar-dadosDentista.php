<?php
try {
    require('conecta.php');
    $stmt = $conn->prepare('INSERT INTO tb_usuario (nm_nome, nm_sobrenome, nm_email, nr_cro, ds_senha, nr_cpf, id_nivel) VALUES(:nome, :sobrenome, :email, :cro, :password, :cpf, :nivel)');
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->execute(array(
        ':nome' => $_POST['nome'],
        ':sobrenome' => $_POST['sobrenome'],
        ':cro' => $_POST['cro_dentista'],
        ':cpf' => $_POST['cpf_dentista'],
        ':email' => $_POST['email'],
        ':password' => $_POST['senha'],
        ':nivel' => $_POST['nivel']
    ));

    echo "funciona";
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
