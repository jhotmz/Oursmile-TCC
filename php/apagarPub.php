<?php

include('conecta.php');
$id = $_POST['id'];
try{
	$deletar = $conn->prepare("DELETE FROM tb_blog WHERE id_post = '$id'");
	$deletar->execute();
	header("location: ../pag/listar_blogAdm.php");
	}catch(PDOException $e){
		echo "Error".$e->getMessage();
}

?>