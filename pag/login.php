<?php
session_start();
if (isset($_SESSION['id_user'])) {
  header('location:../index.php');
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Logar-se</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/cadastrar.css">
	<link rel="stylesheet" href="../css/navbar.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="../js/jquery-3.6.4.js"></script>
	<script src="../js/dropdwn.js"></script>
	<script>


 $(document).ready(function(){
    $("#entrar").click(function(){
    	let botao = document.querySelector("#entrar");
    	botao.innerHTML = ' <i class="fa fa-refresh fa-spin"></i>';
  $.ajax({
    url: "../php/logar.php",
    type: "POST",
    data: "email="+$("#email").val()+"&senha="+$("#senha").val(),
    dataType: "html"

}).done(function(resposta) {
	setTimeout(() => {
botao.innerHTML = resposta;
}, "2000");

}).fail(function(jqXHR, textStatus ) {
    console.log("Request failed: " + textStatus);


}).always(function() {
    console.log("completou");

});
});

});




	
	  </script>
</head>
<body>
	<p id="p"></p>
	<nav class="nav">
	<img class="nav__collapser" src="https://raw.githubusercontent.com/JamminCoder/grid_navbar/master/menu.svg" alt="Collapse">
	<img src="../img/logo.png" alt="" id="logotipo">

	<!-- Put your collapsing content in here -->
	<div class="nav__collapsable">
		<a href="#">Home</a>
		<a href="#">Blog</a>
		<a href="#">Clínicas</a>

		

		<div class="nav__cta">

		</div>
	</div>

</nav>
<br>
	<section>
		
	<div class="container">
		<div class="text">

			<a href="../index.php"><img src="../img/logoHorizontal.png" alt=""></a>
		</div>

		<form>
		   <div class="form-row">
			  <div class="input-data">
				 <input type="text" required id="email">
				 <div class="underline"></div>
				 <label for="">Email:</label>
				 <a href="cadastrar.php" id="log">Não sou cadastrado ainda</a>
			  </div>

			  <div class="input-data">
				 <input type="password" required id="senha">
				 <div class="underline"></div>
				 <label for="">Senha:</label>
				 
			  </div>
		   </div>

		   <div class="form-row">
		   </div>
			<input type="number" id="nivel" style="display:none;">
			
			  <div class="form-row submit-btn">
				 <div class="input-data">
					<div class="inner"></div>
					<button type="button" id="entrar">Entrar</button><br>
				 </div>
			  </div>

		</form>
		</div>

	</section>

</body>
</html>