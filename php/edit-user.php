<?php
include_once('conecta.php');
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$email = $_POST['email'];
$id = $_GET['id'];

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
try {
	$dados = array_map('trim', $dados);
	// validar campos
	if (empty($_POST['nome'])) {
		echo "<p style='color: red;'>Insira um nome!</p>";
	}else{
		$alterar = $conn->prepare("UPDATE tb_usuario SET nm_nome = :nome, nm_sobrenome = :sobrenome, nm_email = :email WHERE id = :id");
		$alterar->bindParam(':nome', $nome);
        $alterar->bindParam(':sobrenome', $sobrenome);
		$alterar->bindParam(':email', $email);
		$alterar->bindValue(':id', $id);
		$alterar->execute();
		echo '<meta http-equiv="refresh" content="1">';
		echo "<p style='color:green;'> Informações alteradads com sucesso!</p>";
	}
} catch (PDOException $e) {
	echo "Erro! " . $e->getMessage();
}
