<?php
    include('conecta.php');
    $stmt = $conn->prepare("SELECT * FROM tb_usuario WHERE nm_email = '".$_POST['email']."' and ds_senha = '".$_POST['senha']."'");
    $stmt-> execute();
   
    if($stmt->rowCount()!=0){ 
    	session_start();
         $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['nivel'] = $result['id_nivel'];
        $_SESSION['id_user'] = $result['id'];
        
        echo "<meta http-equiv='refresh' content='0'>";
    }


    $stmt2 = $conn->prepare("SELECT * FROM tb_dentista WHERE nr_cpf = '".$_POST['email']."' and ds_senha = '".$_POST['senha']."'");
    $stmt2-> execute();
   
    if($stmt2->rowCount()!=0){ 
    	session_start();
         $result = $stmt2->fetch(PDO::FETCH_ASSOC);
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['nivel'] = $result['id_nivel'];
        $_SESSION['id_user'] = $result['id_dentista'];
        
        echo "<meta http-equiv='refresh' content='0'>";
    }


?>