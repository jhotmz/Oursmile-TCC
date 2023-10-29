<?php
require('conecta.php');

$id = $_POST['id'];
$nivel = '3';

try{
$update = $conn->prepare("UPDATE tb_dentista SET id_nivel = :nivel WHERE id_dentista = :id");
$update->bindValue(':id', $id);
$update->bindValue(':nivel', $nivel);
$update->execute();
header("location: ../pag/pagina-validacao.php");
}catch(PDOException $e){
    echo "error ".$e->getMessage();
}
?>
