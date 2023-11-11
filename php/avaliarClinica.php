<?php
include('../php/conecta.php');
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $rating = $_POST["rating"];
try{
    // Prepara a declaração SQL
    $stmt = $conn->prepare("INSERT INTO tb_clinica (vl_nota) VALUES (:rating)");

    // Substitui os parâmetros e executa a consulta
    $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
    $stmt->execute();

    echo json_encode(["success" => true]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
} finally {
    // Fecha a conexão com o banco de dados
    unset($conn);
}
} else {
echo json_encode(["success" => false, "error" => "Método não permitido"]);
}
?>