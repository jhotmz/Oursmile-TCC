<?php
try {
    require('conecta.php');
    $stmt = $conn->prepare('INSERT INTO tb_dentista (nm_dentista, nm_sobrenome, nm_cro, ds_senha, nr_cpf, id_nivel) VALUES(:nome, :sobrenome, :cro, :password, :cpf, :nivel)');
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->execute(array(
        ':nome' => $_POST['nome'],
        ':sobrenome' => $_POST['sobrenome'],
        ':cro' => $_POST['cro_dentista'],
        ':password' => $_POST['senha'],
        ':cpf' => $_POST['cpf_dentista'],
        ':nivel' => $_POST['nivel']
    ));

    echo "funciona";
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
