<?php
try {
        require('conecta.php');
        $stmt = $conn->prepare('INSERT INTO tb_clinica(nm_clinica, nr_cro, nm_dentista, nr_telefone, nm_endereco, nr_zap, hr_abri, hr_fecha, nm_email, nm_tratamentos) VALUES(:clinica, :cro, :nomeDentista, :telefone, :endereco, :zap, :hrAbre, :hrFecha, :email, :tratamentos)');
       $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->execute(array(
            ':clinica' => $_POST['clinica'],
            ':cro' => $_POST['cro'],
            ':nomeDentista' => $_POST['nomeDentista'],
            ':telefone' => $_POST['telefone'],
            ':endereco' => $_POST['endereco'],
            ':zap' => $_POST['zap'],
            ':hrAbre' => $_POST['horarioA'],
            ':hrFecha' => $_POST['horarioF'],
            ':email' => $_POST['email'],
            ':tratamentos' => $_POST['tratamentos']
            
        ));
        echo  '<p class="success">Clínica cadastrada</p>';
       
 }catch (PDOException $e) {

    echo  '<p class="danger">Erro ao cadastrar clínica</p>';
    }
?>