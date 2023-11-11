<?php
session_start();
include('../php/conecta.php');
if (!isset($_SESSION['id_user'])) {
  header("location: ../index.php");
} else{
  $user = $_SESSION['id_user'];
  $stmt = $conn->prepare("SELECT * FROM tb_usuario WHERE id = '$user'");
  $stmt->execute();
  $stmt = $stmt->fetch();
  extract($stmt);

  $clinica = $conn->prepare("SELECT * FROM tb_clinica");
  $clinica->execute();
  $clinica_exibir = $clinica->fetch();
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="icon" type="image/x-icon" href="img/logo_oursmile.png">
  <link rel="stylesheet" href="../css/view-blog.css">
  <link rel="stylesheet" href="../css/perfil.css">
  <link rel="stylesheet" href="../css/card.css">
  <link rel="stylesheet" href="../css/modal-senha.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <!-- FONTE POPINS -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;1,200;1,300&display=swap" rel="stylesheet">
  <!-- ICON -->
  <title>Oursmile/<?php echo $nm_nome?></title>
</head>


<body>
  <!-- NAV -->

<?php include("navbars.php");?>
<br><br><br>

<div class="box-container">
<br>
  <aside class="aside">
    <div class="button-perfil">


      <button id="myBtn2" class="buttons">Editar informações</button>
      <button id="myBtn" class="buttons">Editar senha</button>
      <label for="atualizar" class="buttons">Atualizar</label>
    </div>
  </aside>
  <h1 class="legendaA">Seu perfil</h1>

<div class="info">
  <p><span class="material-symbols-outlined" style="position:relative; top:0.3rem;">account_circle</span> <?php echo $nm_nome;?> <?php echo $nm_sobrenome;?></p>
 <p><span class="material-symbols-outlined" style="position:relative; top:0.3rem;">alternate_email</span> <?php echo $nm_email;?></p>
<p><span class="material-symbols-outlined" style="position:relative; top:0.3rem;">location_on</span><?php echo $nm_local;?></p>
</div>
   <!-- MODAL ALTERAR SENHA -->
<?php
include('../modal/alterarSenha.php');
include('../modal/alterarDados.php');
?>
<br>
  <header class="perfil-header">
    <form id="enviarFoto" enctype="multipart/form-data">
    <img class="img-perfil" src="<?php echo $ds_foto;?>">
    <input type="file" name="fotoPerfil" id="fotoPerfil" style="display:none;">
    <label class="files" for="fotoPerfil">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" height="24" fill="none" class="svg-icon"><g stroke-width="2" stroke-linecap="round" stroke="#fff" fill-rule="evenodd" clip-rule="evenodd"><path d="m4 9c0-1.10457.89543-2 2-2h2l.44721-.89443c.33879-.67757 1.03131-1.10557 1.78889-1.10557h3.5278c.7576 0 1.4501.428 1.7889 1.10557l.4472.89443h2c1.1046 0 2 .89543 2 2v8c0 1.1046-.8954 2-2 2h-12c-1.10457 0-2-.8954-2-2z"></path><path d="m15 13c0 1.6569-1.3431 3-3 3s-3-1.3431-3-3 1.3431-3 3-3 3 1.3431 3 3z"></path></g></svg>
Adicionar foto
</label>
    <p id="resposta"></p>
    <button type="submit" id="atualizar" style="display:none;">Atualizar</button>
    </form>
      
  </header>
<div class="linhaH"></div>
     
  <section class="container-perfil">

    
  </section> 
<br><br>
  <section class="fav">
  <h1 class="legenda">Locais salvos</h1>
    <div class="clinica-salva">
    <?php
    // Consulta para buscar as publicações favoritadas pelo usuário
    $query = "SELECT * FROM tb_clinica JOIN tb_favorito ON tb_clinica.id = tb_favorito.clinica_id WHERE tb_favorito.user_id = :usuario_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':usuario_id', $_SESSION['id_user']);
    $stmt->execute();
    $lines = $stmt->rowCount();
    if($lines>0){
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    ?>

    <div class="card">
    <a href="pagClinica.php?id=<?php echo $clinica_exibir['id']; ?>"><img src="<?php echo $row['ds_img'];?>" alt="Imagem relacionada a clínica" style="width:100%"></a>
  <div class="container"><br><center>
    <h4><b><?php echo $row['nm_clinica'];?></b></h4></center> 
    <p></p> 
  </div>
</div>&nbsp;&nbsp;&nbsp;
<?php
    }
  }else{
    echo "Sem clínicas favoritadas!";
  }
?>
    </div><br>
<h1 class="legenda">Matérias salvas</h1>
    <div class="post-salvo">
    <?php
    // Consulta para buscar as publicações favoritadas pelo usuário
    $query = "SELECT * FROM tb_blog JOIN tb_favorito ON tb_blog.id_post = tb_favorito.pub_id WHERE tb_favorito.user_id = :usuario_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':usuario_id', $_SESSION['id_user']);
    $stmt->execute();
    $lines = $stmt->rowCount();
    if($lines>0){
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    ?>
        <div class="blog-container">
      <div class="blog-box">
        <div class="img-file">
          <a href="view.php?id=<?php echo $row['id_post']; ?>"><img src="<?php echo $row['ds_img'];?>" alt="imagem relacionada a postagem"></a>
        </div>
        
        <div class="blog-text">
         
          <p class="blog-title"><?php echo $row['nm_postagem']; ?></p>
          <div class="blog-button">

<!-- FECHAR SESSION -->
        <?php
    }}else{
      echo "Sem publicações favoritadas!";
    }
        ?>

          </div>
        </div>
      </div>
    </div>
    
    </div>
  </section>
  </div> 
<!-- JQUERY -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

  <script>
  $(document).ready(function () {
    $('#enviarFoto').submit(function (event) {
      event.preventDefault(); // Impede o envio padrão do formulário
      var form_data = new FormData(this);

      $.ajax({
        url: '../php/fotoPerfil.php?id=<?php echo $id?>', // Arquivo PHP para processar os dados
        type: 'POST',
        data: form_data,
        contentType: false,
        processData: false,
        success: function (response) {
          console.log(response); // Exibe a resposta do servidor
          $('#resposta').html(response); // exibe resposta no html
        },
        error: function (xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    });
  });
</script>

</body>
</main>
</body>
</html>