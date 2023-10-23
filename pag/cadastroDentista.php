<?php
session_start();
if (isset($_SESSION['id_user'])) {
  header('location:../index.php');
}else{
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Cadastrar-se</title>

<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/cadastrar.css">
	<link rel="stylesheet" href="../css/navbar.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="../js/jquery-3.6.4.js"></script>
	<script>


 $(document).ready(function(){
    $("#cadastrar").click(function(){
    	let botao = document.querySelector("#cadastrar");
    	botao.innerHTML = ' <i class="fa fa-refresh fa-spin"></i>';
  $.ajax({
    url: "../php/cadastrar-dadosDentista.php",
    type: "POST",
    data: "nome="+$("#nome").val()+"&sobrenome="+$("#sobrenome").val()+"&cpf_dentista="+$("#cpf_dentista").val()+"&senha="+$("#senha").val()+"&nivel="+$("#nivel").val()+"&cro_dentista="+$("#cro_dentista").val(),
    dataType: "html"

}).done(function(resposta) {
   window.location.href = "../index.php";
   
   setTimeout(() => {
   botao.innerHTML = "Cadastrado com sucesso!";
}, "2000");


}).fail(function(jqXHR, textStatus ) {
    console.log("Request failed: " + textStatus);
      botao.innerHTML = "Erro de cadastro!";

}).always(function() {

});
});

});

	function myFunction() {
		document.getElementById("myDropdown").classList.toggle("show");
	  }
	  
	  // Close the dropdown if the user clicks outside of it
	  window.onclick = function(event) {
		if (!event.target.matches('.dropbtn')) {
		  var dropdowns = document.getElementsByClassName("dropdown-content");
		  var i;
		  for (i = 0; i < dropdowns.length; i++) {
			var openDropdown = dropdowns[i];
			if (openDropdown.classList.contains('show')) {
			  openDropdown.classList.remove('show');
			}
		  }
		}
	  }


	  </script>
</head>
<body>
	<p id="resp"></p>
	<nav class="nav">
	<img class="nav__collapser" src="https://raw.githubusercontent.com/JamminCoder/grid_navbar/master/menu.svg" alt="Collapse">
	<img src="../img/logo.png" alt="" id="logotipo">

	<!-- Put your collapsing content in here -->
	<div class="nav__collapsable">
		<a href="">Home</a>
		<a href="#">Blog</a>
		<a href="#">Clínicas</a>
	
		<div class="nav__cta">
		</div>
	</div>

</nav><br><br>
	<section>
		
	<div class="container">
		<div class="text">

			<a href="../index.php"><img src="../img/logoHorizontal.png" alt=""></a>
		</div>

		<form>
		   <div class="form-row">
			  <div class="input-data">
				 <input type="text" required id="nome">
				 <div class="underline"></div>
				 <label for="">Nome:</label>
			  </div>

			  <div class="input-data">
				 <input type="text" required id="sobrenome">
				 <div class="underline"></div>
				 <label for="">Sobrenome:</label>
			  </div>
		   </div>

		   <div class="form-row">
			  <div class="input-data">
				 <input type="number" id="cpf_dentista" maxlength="11" required>
				 <div class="underline"></div>
				 <label for="">CPF:</label>
				 <a href="login.php" id="log">Ja tenho login</a>
			  </div>
			  
			  <div class="input-data">
				 <input type="password" required id="senha">

				 <div class="underline"></div>
				 <label for="">Senha:</label>
			  </div>

			  <div class="input-data">
				 <input type="text" required id="cro_dentista">
				 <div class="underline"></div>
				 <label for="">CRO:</label>
			  </div>

		   </div>
		   
			<input type="number" id="nivel" style="display:none;" value="4">
			
			  <div class="form-row submit-btn">
				 <div class="input-data">
					<div class="inner"></div>
					<button type="button" id="cadastrar">Cadastrar</button><br>
				 </div>
			  </div>
		</form>
		</div>

	</section>

</body>
</html>
<?php }?>