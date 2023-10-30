<?php
    include('conecta.php');
    $stmt = $conn->prepare("SELECT * FROM tb_usuario WHERE nm_email = '".$_POST['email']."' and ds_senha = '".$_POST['senha']."'" );
    $stmt-> execute();
   
    if($stmt->rowCount()!=0){ 
    	session_start();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['nivel'] = $result['id_nivel'];
        $_SESSION['id_user'] = $result['id'];
    
        echo "<meta http-equiv='refresh' content='0'>";
    }



?>