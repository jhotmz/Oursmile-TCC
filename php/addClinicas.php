<?php
try {
        require('conecta.php');
        $arquivo = $_FILES['fotoClinica']['tmp_name'];
        $dir = '../imgClinica/';
        $_FILES['fotoClinica']['name'] = "img" . uniqid() . $_FILES['fotoClinica']['name'];
        $file = $_FILES['fotoClinica']['name'];
        $destino = $dir . $file;
        $extensao = $_FILES['fotoClinica'];
        $extensoes_permitidas = array('.jpg', '.png');

        if (!move_uploaded_file($arquivo, $destino)){
            echo "<p style='color: red;'>Insira uma imagem!</p>";
        }elseif( ($extensao['type'] != 'image/png') AND ($extensao['type'] != 'image/jpeg') ){
            echo "<p style='color:red;'>Os formatos de imagem aceitos são PNG e JPEG!</p>";
        }else{
        $stmt = $conn->prepare('INSERT INTO tb_clinica (ds_img, nm_clinica, nr_cro, nm_dentista, nr_telefone, nm_endereco, nr_zap, hr_abri, hr_fecha, nm_email, nm_tratamentos) VALUES(:fotoClinica, :clinica, :cro, :nomeDentista, :telefone, :endereco, :zap, :hrAbre, :hrFecha, :email, :tratamentos)');
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->execute(array(
            ':fotoClinica' => $destino,
            ':clinica' => $_POST['clinica'],
            ':cro' => $_POST['cro'],
            ':nomeDentista' => $_POST['nomeDentista'],
            ':telefone' => $_POST['telefone'],
            ':endereco' => $_POST['endereco'],
            ':zap' => $_POST['zap'],
            ':hrAbre' => $_POST['horaEntrada'],
            ':hrFecha' => $_POST['horaSaida'],
            ':email' => $_POST['email'],
            ':tratamentos' => $_POST['tratamentos']
            
        ));
        echo  '<p class="success">Clínica cadastrada</p>';
        
 }}catch(PDOException $e){
    echo  '<p class="danger">Erro ao cadastrar clínica</p>';
    }
?>