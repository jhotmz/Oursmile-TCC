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

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="../js/jquery-3.6.4.js"></script>
	<script src="../js/dropdwn.js"></script>
	<script>


 $(document).ready(function(){
    $("#entrar").click(function(){
    	let botao = document.querySelector("#entrar");
		var aviso = document.querySelector("#aviso");
    	botao.innerHTML = ' <i class="fa fa-refresh fa-spin"></i>';
  $.ajax({
    url: "../php/logar.php",
    type: "POST",
    data: "email="+$("#email").val()+"&senha="+$("#senha").val(),
    dataType: "html"

}).done(function(resposta) {
	setTimeout(() => {
aviso.innerHTML = resposta;
botao.innerHTML = "Entrar";
}, "2000");

}).fail(function(jqXHR, textStatus) {
    console.log("Request failed: " + textStatus);
	


}).always(function() {
    console.log("completou");


});
});
});


    function remove(){
		var buttonX = document.querySelector(".error__close");
		var aviso = document.querySelector(".error");
		aviso.style.display =  "none";
	}
    window.addEventListener('click', function(){
        remove();
    });



	
	  </script>
	  <style>
		.error {
  font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  width: 320px;
  padding: 12px;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: start;
  background: #EF665B;
  border-radius: 8px;
  box-shadow: 0px 0px 5px -3px #111;
}

.error__icon {
  width: 20px;
  height: 20px;
  transform: translateY(-2px);
  margin-right: 8px;
  display:block;
}

.error__icon path {
  fill: #fff;
}

.error__title {
  font-weight: 500;
  font-size: 14px;
  color: #fff;
}

.error__close {
  width: 20px;
  height: 20px;
  cursor: pointer;
  margin-left: auto;
}

.error__close path {
  fill: #fff;
}
	  </style>
</head>
<body>
	<p id="p"></p>
	<?php include("navbars.php");?><br><br><br><br><br><br><br><br><br>
<br>
	<section>
		
	<div class="containerForm">
	
		<div class="text">

			<a href="../index.php"><center><img src="../img/logoHorizontal.png" alt="" style="width:35rem;"></center></a>
		</div>

		<form>
	<p id="aviso"></p>
		   <div class="form-row">
			
			  <div class="input-data">
				 <input type="text" required id="email">
				 <div class="underline"></div>
				 <label for="">Email:</label>
				 <a href="cadastrar.php" id="log" style="font-size:0.8rem; text-decoration:underline;">Não sou cadastrado ainda</a>
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
			 <a href="esqueceuAsenha.php" style="font-size:0.8rem; text-decoration:underline;"> Esqueci a senha</a>

		</form>
		</div>

	</section>
	<footer id="newsletter">
    <div class="container">
      <div class="row">
       
        <div class="col-lg-6 offset-lg-3" style="opacity:0">
          <form id="search" action="#" method="GET">
            <div class="row">
              <div class="col-lg-6 col-sm-6">
                <fieldset>
                  <input type="address" name="address" class="email" placeholder="Email Address..." autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-6 col-sm-6">
                <fieldset>
                  <button type="submit" class="main-button">Subscribe Now <i class="fa fa-angle-right"></i></button>
                </fieldset>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3">
          <div class="footer-widget">
            <h4>Contact Us</h4>
            <p>Rio de Janeiro - RJ, 22795-008, Brazil</p>
            <p><a href="#">010-020-0340</a></p>
            <p><a href="#">info@company.co</a></p>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="footer-widget">
            <h4>About Us</h4>
            <ul>
              <li><a href="#">Home</a></li>
              <li><a href="#">Services</a></li>
              <li><a href="#">About</a></li>
              <li><a href="#">Testimonials</a></li>
              <li><a href="#">Pricing</a></li>
            </ul>
            <ul>
              <li><a href="#">About</a></li>
              <li><a href="#">Testimonials</a></li>
              <li><a href="#">Pricing</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="footer-widget">
            <h4>Useful Links</h4>
            <ul>
              <li><a href="#">Free Apps</a></li>
              <li><a href="#">App Engine</a></li>
              <li><a href="#">Programming</a></li>
              <li><a href="#">Development</a></li>
              <li><a href="#">App News</a></li>
            </ul>
            <ul>
              <li><a href="#">App Dev Team</a></li>
              <li><a href="#">Digital Web</a></li>
              <li><a href="#">Normal Apps</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="footer-widget">
            <h4>SocialVision</h4>
            <div class="logo">
           <img src="../img/logoBrancoEquipe.png">
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
          </div>
        </div>
      
      </div>
    </div>

</footer>
</body>
</html>