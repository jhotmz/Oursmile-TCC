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
  <title>Oursmile</title>
</head>

<style>
*{
    margin:0;
}
#menu {
	background: #0099CC;
	background: linear-gradient(to bottom,  #12D9E8,  #19BAFF);
	color: #FFF;
	height: 45px;
	padding-left: 18px;
	border-radius: 0px;
}
#menu ul, #menu li {
	margin: 0 auto;
	padding: 0;
	list-style: none;
}
#menu ul {
	width: 100%;
}
#menu li {
	float: right;
	display: inline;
	padding-right:1rem;
}
#menu a {
	display: block;
	line-height: 45px;
	padding: 0 14px;
	text-decoration: none;
	color: #FFFFFF;
	font-size: 16px;
}
#menu a.dropdown-arrow:after {
	content: "\23F7";
	margin-left: 5px;
}
#menu li a:hover {
	color: #0099CC;
	background: #F2F2F2;
}
#menu input {
	display: none;
	margin: 0;
	padding: 0;
	height: 45px;
	width: 100%;
	opacity: 0;
	cursor: pointer;
}
#menu label {
	display: none;
	line-height: 45px;
	text-align: center;
	position: absolute;
	left: 35px
}
#menu label:before {
	font-size: 1.6em;
	content: "\2261"; 
	margin-left: 20px;
}
#menu ul.sub-menus{
	height: auto;
	overflow: hidden;
	width: 170px;
	background: #444444;
	position: absolute;
	z-index: 99;
	display: none;
}
#menu ul.sub-menus li {
	display: block;
	width: 100%;
}
#menu ul.sub-menus a {
	color: #FFFFFF;
	font-size: 16px;
}
#menu li:hover ul.sub-menus {
	display: block;
}
#menu ul.sub-menus a:hover{
	background: #F2F2F2;
	color: #444444;
}
@media screen and (max-width: 800px){
	#menu {position:relative}
	#menu ul {background:#111;position:absolute;top:100%;right:0;left:0;z-index:3;height:auto;display:none;}
	#menu ul.sub-menus {width:100%;position:static;}
	#menu ul.sub-menus a {padding-left:30px;}
	#menu li {display:block;float:none;width:auto;}
	#menu input, #menu label {position:absolute;top:0;left:0;display:block}
	#menu input {z-index:4}
	#menu input:checked + label {color:white}
	#menu input:checked + label:before {content:"\00d7"}
	#menu input:checked ~ ul {display:block}
}
#main-one{
    width:100%;
    height:100vh;
    background-color:white;
}
#main-two{
    width:100%;
    height:100vh;
    background-color:white;
}
.form-pre{
    background-color:white;
    width:30rem;
    height:15rem;
    float:right;
  margin:10rem 10rem;
 display:block;
 box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
 border-radius:2rem;
}
.form{
    display:inline-block;
    align-items: center;
    justify-content: center;
    padding:0rem 10rem;
    
}
.cadastro{
    color: #ffffff;
    background-color: #33aae6;
    font-size: 15px;
    border: 1px solid transparent;
    border-radius: 10px;
    padding: 10px 15px;
    letter-spacing: 1px;
    cursor: pointer;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
}
.cadastro:hover {
    color: #ffffff;
    background-color: #6dc0e9;
}

@media (max-width: 600px)
{
  .form-pre
   {
    display:none;
}
#main-one{
	background-image:url("../img/ww.png");
}
}

</style>
<body>
  <!-- NAV -->
<nav id='menu'>
    <input type='checkbox' id='responsive-menu' onclick='updatemenu()'><label></label>
    <ul>
      <li><a href='#'>Sobre nós</a></li>
      <li><a href='#'>Clínicas e profissionais</a></li>
      <li><a href='blog.php'>Blog</a></li>
      <li><a href='../index.php'>Home</a></li>
    </ul>
  </nav>



<div class="box-container">

  <aside class="aside">
    <div class="button-perfil">


      <button id="myBtn2" class="button">Editar informações</button>
      <button id="myBtn" class="button">Editar senha</button>
    </div>
  </aside>
  <!-- MODAL ALTERAR SENHA -->
<?php
include('../modal/alterarSenha.php');
include('../modal/alterarDados.php');
?>
<h1 class="legendaA">Seu perfil</h1><br>
  <header class="perfil-header">

    <img class="img-perfil" src="<?php echo $ds_foto;?>">
    
       <?php echo $nm_nome; ?>
      <?php echo $nm_email; ?> 
  </header>

  <section class="container-perfil">

    
  </section>
<br><br>
  <section class="fav">
  <h1 class="legenda">Locais salvos</h1>
    <div class="clinica-salva">

    <div class="card">
  <img src="../img/retangulo.png" alt="Avatar" style="width:100%">
  <div class="container">
    <h4><b>Sorridents</b></h4> 
    <p></p> 
  </div>
</div>&nbsp;&nbsp;&nbsp;

<div class="card">
  <img src="../img/retangulo.png" alt="Avatar" style="width:100%">
  <div class="container">
    <h4><b>Odontomyle</b></h4> 
    <p></p> 
  </div>
</div>&nbsp;&nbsp;&nbsp;

<div class="card">
  <img src="../img/retangulo.png" alt="Avatar" style="width:100%">
  <div class="container">
    <h4><b>OdontoCompany</b></h4> 
    <p></p> 
  </div>
</div>

    </div>
<h1 class="legenda">Matérias salvas</h1>
    <div class="post-salvo">
    <?php

    // Consulta para buscar as publicações favoritadas pelo usuário
    $query = "SELECT * FROM tb_blog JOIN tb_favorito ON tb_blog.id_post = tb_favorito.pub_id WHERE tb_favorito.user_id = :usuario_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':usuario_id', $_SESSION['id_user']);
    $stmt->execute();
    
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
    }
        ?>

          </div>
        </div>
      </div>
    </div>
    
    </div>
  </section>
  </div> 
</body>
</main>
</body>
</html>