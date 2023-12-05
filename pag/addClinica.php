<?php
session_start();
    include('../php/conecta.php');
    if (!isset($_SESSION['id_user'])) {
    $nome = "Login";
    }else{
    $usuario = $_SESSION['id_user'];

    $stmt = $conn->prepare("SELECT * FROM tb_usuario WHERE id = '$usuario'");
    $stmt-> execute();
    $stmt = $stmt->fetch();
    $nome = $stmt['nm_nome'];
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Cadastrar clínica</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/thinline.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/cadastrar.css">
	<link rel="stylesheet" href="../css/navbar.css">
  <link rel="icon" type="image/x-icon" href="../img/logo.png">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="../js/jquery-3.6.4.js"></script>
      <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
*{
  margin: 0;
  padding: 0;
  outline: none;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}

.container{
  max-width: 800px;
  background: #fff;
  width: 800px;
  padding: 25px 40px 10px 40px;
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
}
.container .text{
  text-align: center;
  font-size: 41px;
  font-weight: 600;
  font-family: 'Poppins', sans-serif;
  background:black;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.container form{
  padding: 30px 0 0 0;
}
.container form .form-row{
  display: flex;
  margin: 32px 0;
}
form .form-row .input-data{
  width: 100%;
  height: 40px;
  margin: 0 20px;
  position: relative;
}
form .form-row .textarea{
  height: 70px;
}
.input-data input,
.textarea textarea{
  display: block;
  width: 100%;
  height: 100%;
  border: none;
  font-size: 17px;
  border-bottom: 2px solid rgba(0,0,0, 0.12);
}
.input-data input:focus ~ label, .textarea textarea:focus ~ label,
.input-data input:valid ~ label, .textarea textarea:valid ~ label{
  transform: translateY(-20px);
  font-size: 14px;
  color: #3498db;
}
.textarea textarea{
  resize: none;
  padding-top: 10px;
}
.input-data label{
  position: absolute;
  pointer-events: none;
  bottom: 10px;
  font-size: 16px;
  transition: all 0.3s ease;
}
.textarea label{
  width: 100%;
  bottom: 40px;
  background: #fff;
}
.input-data .underline{
  position: absolute;
  bottom: 0;
  height: 2px;
  width: 100%;
}
.input-data .underline:before{
  position: absolute;
  content: "";
  height: 2px;
  width: 100%;
  background: #3498db;
  transform: scaleX(0);
  transform-origin: center;
  transition: transform 0.3s ease;
}
.input-data input:focus ~ .underline:before,
.input-data input:valid ~ .underline:before,
.textarea textarea:focus ~ .underline:before,
.textarea textarea:valid ~ .underline:before{
  transform: scale(1);
}
.submit-btn .input-data{
  overflow: hidden;
  height: 45px!important;
  width: 25%!important;
}
.submit-btn .input-data .inner{
  height: 100%;
  width: 300%;
  position: absolute;
  left: -100%;
  background: -webkit-linear-gradient(right, #56d8e4, #9f01ea, #56d8e4, #9f01ea);
  transition: all 0.4s;
}
.submit-btn .input-data:hover .inner{
  left: 0;
}
.submit-btn .input-data input{
  background: none;
  border: none;
  color: #fff;
  font-size: 17px;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 1px;
  cursor: pointer;
  position: relative;
  z-index: 2;
}
@media (max-width: 700px) {
  .container .text{
    font-size: 30px;
  }
  .container form{
    padding: 10px 0 0 0;
  }
  .container form .form-row{
    display: block;
  }
  form .form-row .input-data{
    margin: 35px 0!important;
  }
  .submit-btn .input-data{
    width: 40%!important;
  }
}

.danger{
    background-color:#ec0202;
    padding:1rem;
    color:#fff;
}
.error{
  
  font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  width: 320px;
  padding: 12px;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: start;
  background: #47C300 ;
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

      </style>
</head>
<body>
	
	<nav class="nav">
	<img class="nav__collapser" src="https://raw.githubusercontent.com/JamminCoder/grid_navbar/master/menu.svg" alt="Collapse">
	<img src="../img/logo.png" alt="" id="logotipo">

	<!-- Put your collapsing content in here -->
	<div class="nav__collapsable">
		<a href="">Home</a>
		<a href="#">Blog</a>
		<a href="clinicas.php">Clínicas</a>

		<div class="nav__cta">

		</div>
	</div>

</nav>
	<section>
		

    <div class="container">
      <div class="text">
         Adicione sua clínica
      </div>
      <p id="respo"></p>
      <form id="formulario" enctype="multipart/form-data">
      <input type="file" name="fotoClinica" id="fotoClinica">
      <p id="resposta"></p>
         <div class="form-row">

            <div class="input-data">
               <input type="text"  id="clinica" required name="clinica">
               <div class="underline"></div>
               <label for="">Nome da clínica:</label>
            </div>
            <div class="input-data">
               <input type="numbero" required  id="cro" name="cro">
               <div class="underline"></div>
               <label for="">Cro:</label>
            </div>
         </div>
         <div class="form-row">
            <div class="input-data">
               <input type="text" required id="nomeDentista" name="nomeDentista">
               <div class="underline"></div>
               <label for="">Nome do(a) dentista:</label>
            </div>
            <div class="input-data">
            <input type="text" id="telefone" name="telefone" required onkeypress="mask(this, mphone);" onblur="mask(this, mphone);"/>
               <div class="underline"></div>
               <label for="">Telefone:</label>
            </div>
         </div>
         <div class="form-row">
            <div class="input-data">
               <input type="text" required id="endereco" name="endereco">
               <div class="underline"></div>
               <label for="">Endereço:</label>
            </div>
            <div class="input-data">
               <input type="text" required id="zap" name="zap" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);">
               <div class="underline"></div>
               <label for="">Whatsapp:</label>
            </div>
         </div>
         <div class="form-row">
            <div class="input-data">
               <input type="time" required id="horaEntrada" name="horaEntrada">
               <div class="underline"></div>
               <label for="">Abertura:</label>
            </div>
            <div class="input-data">
               <input type="time" required id="horaSaida" name="horaSaida">
               <div class="underline"></div>
               <label for="">Fechamento:</label>
            </div>
         </div>
         <div class="form-row">
            <div class="input-data">
               <input type="text" required id="email" name="email">
               <div class="underline"></div>
               <label for="">Email:</label>
            </div>
            <div class="input-data">
               <input type="text" required id="tratamentos" name="tratamentos">
               <div class="underline"></div>
               <label for="">Tratamentos:</label>
    
            </div>
            
         </div>

         <div class="form-row">
         <div class="input-data textarea">
         <button type="submit" id="cadastrar">Cadastrar</button>

            
      </form>
      
      </div>

	</section>

<script>
// ajax para enviar dados para o php 

  $(document).ready(function () {
    $('#formulario').submit(function (event) {
      event.preventDefault(); // Impede o envio padrão do formulário
      var form_data = new FormData(this);

      $.ajax({
        url: '../php/addClinicas.php', // Arquivo PHP para processar os dados
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

function mask(o, f) {
  setTimeout(function() {
    var v = mphone(o.value);
    if (v != o.value) {
      o.value = v;
    }
  }, 1);
}

function mphone(v) {
  var r = v.replace(/\D/g, "");
  r = r.replace(/^0/, "");
  if (r.length > 10) {
    r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
  } else if (r.length > 5) {
    r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
  } else if (r.length > 2) {
    r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
  } else {
    r = r.replace(/^(\d*)/, "($1");
  }
  return r;
}
</script>


</body>
</html>
