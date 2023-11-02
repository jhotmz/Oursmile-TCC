<?php
session_start();
    include('php/conecta.php');
    if (!isset($_SESSION['id_user'])) {
    $nivel = '1';
    }else{
    $usuario = $_SESSION['id_user'];
    $nivel = $_SESSION['nivel'];
    $stmt = $conn->prepare("SELECT * FROM tb_usuario WHERE id = '$usuario'");
    $stmt-> execute();
    $stmt = $stmt->fetch();
    $nome = $stmt['nm_nome'];
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/navbar.css">
    <style>
.section-one {
  background-image:url("img/zyro-image.png");  
  background-size: cover;
  background-position: center;
  height: 100vh;
  width: 100vw;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center; 
}

.container {
  text-align: center;
  color: white;
}

h1 {
  text-transform: uppercase;
  letter-spacing: 5px;
  font-size: 4rem;
  font-weight: 400;
}

p {
  margin: 20px 0 40px;
}

.home-button {
  color: white;
  text-decoration: none;
  border: 2px white solid;
  padding: 10px 15px;
}

.home-button:hover,
.home-button:focus {
  background: hsl(0, 100%, 100%, .2);
  outline: none;
}


.section-two {
  height: 100vh;
  width: 100vw;
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 0 auto;
}

.container-two {
  display: flex;
  padding: 50px;
  gap: 20px;
  width: 100%;
}

.content h1 {
  font-size: 2.75rem;
}

.content h1::after {
  content: '';
  display: block;
  width: 100%;
  height: 5px;
  background: #D1A370; 
}

.content p {
  font-size: 1.1rem;
  letter-spacing: 2px;
}

@media (max-width: 700px) {
  .section-two {
    height: 100%;
  }
  .container-two {
    flex-direction: column;
    height: 100%;
  }
}

.wrapper{
  margin-top: 50px;
}

.wrapper h1{

  font-size: 52px;
  margin-bottom: 60px;
  text-align: center;
}

.team{
  display: flex;
  justify-content: center;
  width: auto;
  text-align: center;
  flex-wrap: wrap;

}

.team .team_member{
  background: #fff;
  margin: 5px;
  margin-bottom: 50px;
  width: 300px;
  padding: 20px;
  line-height: 20px;
  color: #8e8b8b;  
  position: relative;
}

.team .team_member h3{
  color: #16aed7;
  font-size: 26px;
  margin-top: 50px;
}

.team .team_member p.role{
  color: #ccc;
  margin: 12px 0;
  font-size: 12px;
  text-transform: uppercase;
}

.team .team_member .team_img{
  position: absolute;
  top: -50px;
  left: 50%;
  transform: translateX(-50%);
  width: 100px;
  height: 100px;
  border-radius: 50%;
  background: #fff;
}

.team .team_member .team_img img{
  width: 100px;
  height: 100px;
  padding: 5px;
}
button {
  padding: 12.5px 30px;
  border: 0;
  border-radius: 100px;
  background-color: #2ba8fb;
  color: #ffffff;
  font-weight: Bold;
  transition: all 0.5s;
  -webkit-transition: all 0.5s;
  cursor:pointer;
}

button:hover {
  background-color: #6fc5ff;
  box-shadow: 0 0 20px #6fc5ff50;
  transform: scale(1.1);
}

button:active {
  background-color: #3d94cf;
  transition: all 0.25s;
  -webkit-transition: all 0.25s;
  box-shadow: none;
  transform: scale(0.98);
}

    </style>
  </head>
  <body>

    <link rel="icon" type="image/x-icon" href="img/logotipo.png">
<link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
<script>

console.log("bot");
</script>

<nav class="nav">
	<img class="nav__collapser" src="https://raw.githubusercontent.com/JamminCoder/grid_navbar/master/menu.svg" alt="Collapse">
	<img src="img/logo.png" alt="" id="logotipo">

	<!-- Put your collapsing content in here -->
	<div class="nav__collapsable">
		<a href="#">Home</a>
		<a href="pag/blog.php">Blog</a>
		<a href="#">Clínicas</a>
		
    <?php
if (!isset($_SESSION['id_user'])) {
?>
 <a href="pag/cadastrar-se.php">Entrar</a>
<?php
}else{
?>
<a href="pag/perfil.php">Meu perfil</a>
<?php
    if($nivel === '2'){
    ?>
<a href="pag/listar_usuarioAdm.php">Gerenciar</a>

<?php
    }
?>
<a href="#contact" onclick="window.location='php/sair.php'">Sair</a>
<?php
}
?>
		<div class="nav__cta">
		</div>
	</div>

</nav>

<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">

    <h1>Tem certeza?</h1><br>
    <button onclick="window.location='php/sair.php'">Sair</button> <button id="close">Voltar</button>
  </div>

</div>

  <section class="section-one"> 
    <div class="container">
      <h1>Oursmile</h1>
      <p>Produzir um sorriso é multiplicar a felicidade</p>
    
      <a href="#ss" class="home-button">Leia mais</a>
      
    </div> 

   </section> 
  
   <div class="wrapper" id="ss">
<br>
    <div class="team">
      <div class="team_member">
        <div class="team_img">
          <img src="https://cdn-icons-png.flaticon.com/512/3964/3964251.png" alt="Team_image">
        </div>
        <h3>Encontre clínicas</h3>
<p>Encontre clínicas e suas localizações</p>      
<?php
if (!isset($_SESSION['id_user'])) {
?>
    <button class="btn" onclick="location.href='pag/cadastrar.php'">Veja mais</button>

<?php
}else{
?>
    <button class="btn" onclick="location.href='pag/clinicas.php'">Veja mais</button>
<?php
}
?>
</div>
      <div class="team_member">
        <div class="team_img">
          <img src="img/dente-de-ouro.png" alt="Team_image">
        </div>
        <h3>Sobre doenças Bucais</h3>
    <p>Saiba os perigos das doenças bucais</p>    
    <button>
          Saiba mais
        </button>
      </div>
      <div class="team_member">
        <div class="team_img">
          <img src="img/3d.png" alt="Team_image">
          eitaaa
        </div>
        <h3>Sobre nós</h3>
        <p>Saiba sobre a equipe que fez o site</p>
        <button>
          Saiba mais
        </button>
      </div>
    </div>
  </div>
  </body>
</html>
