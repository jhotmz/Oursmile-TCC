<?php
include('conecta.php');
$id = $_POST['id'];
try{
	$deletar = $conn->prepare("DELETE FROM tb_clinica WHERE id = '$id'");
	$deletar->execute();
	header("location: ../pag/listar_ClinicaAdm.php");
	}catch(PDOException $e){
		echo "Error".$e->getMessage();
}

?>