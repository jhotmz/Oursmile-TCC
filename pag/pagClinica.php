<?php

session_start();

require "../php/conecta.php";
    $id = $_GET['id'];

    include('../php/conecta.php');
    if (!isset($_SESSION['id_user'])) {
    header('location: ../index.php');
    }else{
    $usuario = $_SESSION['id_user'];
    $nivel = $_SESSION['nivel'];

    // CONSULTA TABELA CLINICA
    $exibir_clinica = $conn->prepare("SELECT * FROM tb_clinica WHERE id = '$id'");
    $exibir_clinica->execute();
    $exibir = $exibir_clinica->fetch(PDO::FETCH_ASSOC);
    extract($exibir);

    //CONSULTA TABELA USUÁRIO
    $exibir_user = $conn->prepare("SELECT id, nm_nome, nm_local FROM tb_usuario WHERE id = :user");
    $exibir_user->bindParam(':user', $usuario);
    $exibir_user->execute();
    $user = $exibir_user->fetch(PDO::FETCH_ASSOC);
    $nm_nome = $user['nm_nome'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/clinica.css">
    <link rel="stylesheet" href="../css/modal-senha.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- ICONE ESTRELA -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title><?php echo $nm_clinica?></title>
    <style>
      
#map {
  height: 40rem;
  width: 40rem;
background-color:#F1F1F1;
}
.loader, .loader:before, .loader:after {
  border-radius: 50%;
  width: 2.5em;
  height: 2.5em;
  animation-fill-mode: both;
  animation: bblFadInOut 1.8s infinite ease-in-out;
  color:#3cb0fd;
display: flex;


}
.loader {
  color:#3cb0fd;
  font-size: 7px;
  position: relative;
  text-indent: -9999em;
  transform: translateZ(0);
  animation-delay: -0.16s;
  top:35vh;

}
.loader:before,
.loader:after {
  content: '';
  position: absolute;
  top: 0;
}
.loader:before {
  left: -3.5em;
  animation-delay: -0.32s;
}
.loader:after {
  left: 3.5em;
}

@keyframes bblFadInOut {
  0%, 80%, 100% { box-shadow: 0 2.5em 0 -1.3em }
  40% { box-shadow: 0 2.5em 0 0 }
}
.material-symbols-outlined{
  user-select:none;
}

    </style>
</head>
<body>

    <!-- nav do site -->
    <script>
        const toggleMenuOpen = () => document.body.classList.toggle("open");
    </script>

    	<nav class="nav">
	<img class="nav__collapser" src="https://raw.githubusercontent.com/JamminCoder/grid_navbar/master/menu.svg" alt="Collapse">
	<a href="../index.php"><img src="../img/logo.png" alt="" id="logotipo"></a>

	<!-- Put your collapsing content in here -->
	<div class="nav__collapsable">
		<a href="">Home</a>
		<a href="#">Blog</a>
		<a href="#">Clínicas</a>
	
		<div class="nav__cta">

		</div>
	</div>

</nav>

    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&v=weekly&language=pt&region=br"
    defer
  ></script>
  <input type="hidden" value="<?php echo $user['id']?>" id="id">
  <input type="hidden" id="valor-two" onkeyup="initMap()" value="<?php echo $nm_endereco;?>">
  <input type="hidden" id="valor" onkeyup="initMap()"  value="<?php echo $user['nm_local']?>">

  <div style="display:flex; margin:1rem 3rem;">
<div class="product-card" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">

		<div class="product-details">
			<span class="product-catagory" ><?php echo $nm_endereco;?></span>
			<h4><a href=""><?php echo $nm_clinica;?></a></h4>
			<p> <?php echo $nm_email;?></p>
      
			<div class="product-bottom-details">
      <p><span class="material-symbols-outlined" style="position:relative; top:0.2rem;">person</span> Dentista:
				<?php echo $nm_dentista;?>
        </p>
        <p><span class="material-symbols-outlined" style="position:relative; top:0.3rem;">dentistry</span> CRO:
        <?php echo $nr_cro;?>
      </p>


        

        <p><span class="material-symbols-outlined" style="position:relative; top:0.3rem;">call</span> Telefone:
        <?php echo $nr_telefone;?>
      </p>

				<div class="product-links">
					<a href=""><i class="fa fa-heart"></i></a>
					<a href=""><i class="fa fa-shopping-cart"></i></a>
				</div>
       
        
			</div>
      <div class="product-bottom-details">
      <p><span class="material-symbols-outlined" style="position:relative; top:0.3rem;">schedule</span> Abertura:
				<?php echo $hr_abri;?>
        </p>
        <p><span class="material-symbols-outlined" style="position:relative; top:0.3rem;">schedule</span> Fechamento:
        <?php echo $hr_fecha;?>
      </p>

				<div class="product-links">
					<a href=""><i class="fa fa-heart"></i></a>
					<a href=""><i class="fa fa-shopping-cart"></i></a>
				</div>
       
        
			</div>
      <div class="product-bottom-details">
				<div class="product-price"></div>
        <div class="product-price"></div>
				<div class="product-links">
					<a href=""><i class="fa fa-heart"></i></a>
					<a href=""><i class="fa fa-shopping-cart"></i></a>
				</div>
			</div>

<style>
.rating-container {
    text-align: center;
}

.stars {
    font-size: 30px;
    cursor: pointer;
}

.stars .star {
    color: #ccc;
    display: inline-block;
    margin-right: 5px;
}

.stars .star:hover,
.stars .star.active {
    color: #ffcc00;
}

      </style>
      <div class="rating-container">
    <h2>Avalie-nos</h2>
  
<style>
  /* Criar as variaveis com as cores */
:root {
    --amarelo: #ffcc00;
    --cinza: #cccccc;
}

/* Não exibir o input radio */
.estrelas input[type=radio] {
    display: none;
}

/* Criar as estrelas preenchidas de amarelo*/
.estrelas label i.opcao.fa:before {
    content: '\f005';
    color: var(--amarelo);
}

/* Atribuir o cinza nas estrelas, quando selecionar a estrela retirar o cinza*/
.estrelas input[type=radio]:checked~label i.fa:before {
    color: var(--cinza);
}

/* Personalizar a estrela preenchida */
.estrela-preenchida {
    color: var(--amarelo);
}

/* Personalizar a estrela vazia */
.estrela-vazia{
    color: var(--cinza);
} 
</style>
    <form method="POST" id="avaliar_clinica">

<div class="estrelas">
    <input type="hidden" name="autor" value="<?php echo $nm_nome?>">
    <input type="hidden" name="id_clinica" value="<?php echo $id?>">
    <!-- Carrega o formulário definindo nenhuma estrela selecionada -->
    <input type="radio" name="estrela" id="vazio" value="" checked>

    <!-- Opção para selecionar 1 estrela -->
    <label for="estrela_um"><i class="opcao fa"></i></label>
    <input type="radio" name="estrela" id="estrela_um" id="vazio" value="1">

    <!-- Opção para selecionar 2 estrela -->
    <label for="estrela_dois"><i class="opcao fa"></i></label>
    <input type="radio" name="estrela" id="estrela_dois" id="vazio" value="2">

    <!-- Opção para selecionar 3 estrela -->
    <label for="estrela_tres"><i class="opcao fa"></i></label>
    <input type="radio" name="estrela" id="estrela_tres" id="vazio" value="3">

    <!-- Opção para selecionar 4 estrela -->
    <label for="estrela_quatro"><i class="opcao fa"></i></label>
    <input type="radio" name="estrela" id="estrela_quatro" id="vazio" value="4">

    <!-- Opção para selecionar 5 estrela -->
    <label for="estrela_cinco"><i class="opcao fa"></i></label>
    <input type="radio" name="estrela" id="estrela_cinco" id="vazio" value="5"><br><br>

    <!-- Campo para enviar a mensagem -->
    <textarea name="mensagem" rows="4" cols="30" placeholder="Digite o seu comentário..."></textarea><br><br>

    <!-- Botão para enviar os dados do formulário -->
    <input type="submit" value="Avaliar"><br><br>

</div>

</form>

<p id="mensagem"></p>
<h4>Avaliações</h4>
<?php
    // Recuperar as avaliações do banco de dados
    $query_avaliacoes = "SELECT * FROM tb_avaliacao WHERE id_clinica = '$id' ORDER BY id DESC ";
    

    // Preparar a QUERY
    $result_avaliacoes = $conn->prepare($query_avaliacoes);

    // Executar a QUERY
    $result_avaliacoes->execute();
    $lines = $result_avaliacoes->rowCount();
    if($lines > 0){
    // Percorrer a lista de registros recuperada do banco de dados
    while ($row_avaliacao = $result_avaliacoes->fetch(PDO::FETCH_ASSOC)) {
        //var_dump($row_avaliacao);

        // Extrair o array para imprimir pelo nome do elemento do array
        extract($row_avaliacao);
      
        // Criar o for para percorrer as 5 estrelas
        for ($i = 1; $i <= 5; $i++) {

            // Acessa o IF quando a quantidade de estrelas selecionadas é menor a quantidade de estrela percorrida e imprime a estrela preenchida
            if ($i <= $vl_nota) {
                echo '<i class="estrela-preenchida fa-solid fa-star"></i>';
            } else {
                echo '<i class="estrela-vazia fa-solid fa-star"></i>';
            }
        }

        echo "<p>$nm_autor: $ds_mensagem</p><hr>";
    }}else{
      echo "<p>Sem avaliações no momento</p>";
    }
    ?>

<!-- Trigger/Open The Modal -->
<?php

if($nivel === '2'){
?>
<button id="myBtn2">Adicionar tratamento</button>
<?php
}
?>
<!-- The Modal -->
<div id="myModal2" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close2">&times;</span>
    <h5>Adicionar tratamento</h5>
    <form action="../php/adicionarTratamento.php" method="POST" >
    <input type="hidden" name="id_clinic" value="<?php echo $id?>">
    <input type="text" name="nome_tratamento" placeholder="Nome do tratamento">
    <button type="submit" name="adicionar">Adicionar</button>
    </form>
  </div>
</div>
</div>


<br><br><br>
<!-- EXIBIR TRATAMENTOS DA CLÍNICAS -->
<h4>Tratamentos</h4>
<?php 
$tratamento = $conn->prepare("SELECT * FROM tb_tratamentos WHERE id_clinica = :id");
$tratamento->bindParam(':id', $id);
$tratamento->execute();
$lines = $tratamento->rowCount();

while($exibir_tratamento = $tratamento->fetch(PDO::FETCH_ASSOC)){
  extract($exibir_tratamento);
?>

<p><?php echo $nm_tratamento?></p>

<?php
}
?>
<br>
<button class="edits" id="myBtn">
<b class="material-symbols-outlined">
edit_location_alt
</b>
</button>
		</div>
    
	</div>



<div id="map"><center><span class="loader"></span></center></div>
  </div>
  <div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content">
  <p id="respo"></p>
  <span class="close">&times;</span>
  <p>Adicione um novo endereço</p><br>
  <input placeholder="Adicione um endereço aqui" type="text"class="input" id="endereco" value="<?php echo $user['nm_local'];?>"> 
  <button class="edits" style="display:flex; float:right;" id="editos">
<b class="material-symbols-outlined">
edit
</b>
</button>
</div>
</div>

<script src="../js/modalSenha.js"></script>
<!-- ajax para enviar dados para o php -->
<script>

  $(document).ready(function () {
    $('#avaliar_clinica').submit(function (event) {
      event.preventDefault(); // Impede o envio padrão do formulário
      var form_data = new FormData(this);

      $.ajax({
        url: '../php/avaliarClinica.php', // Arquivo PHP para processar os dados
        type: 'POST',
        data: form_data,
        contentType: false,
        processData: false,
        success: function (response) {
          console.log(response); // Exibe a resposta do servidor
          $('#mensagem').html(response); // exibe resposta no html
        },
        error: function (xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    });
  });
  
</script>

<script>
    $(document).ready(function(){

    $("#editos").click(function(){
      var id = $("#id").val();
      var endereco = $("#endereco").val();


  $.ajax({
    url: "../php/editarLoc.php",
    type: "POST",
    data: "id="+id+"&endereco="+endereco,
    dataType: "html"

}).done(function(resposta) {
   $("#respo").html(resposta);
   innerHTMl = '<meta http-equiv="content-type" content="text/html; charset=UTF-8" />';
 

}).fail(function(jqXHR, textStatus ) {
    console.log("Request failed: " + textStatus);


}).always(function() {

});
});
});

var lat;
var lon;
function getLocation(){
  if(!navigator.geolocation)
    return null;
    navigator.geolocation.getCurrentPosition((pos)=>{
      lat = pos.coords.latitude;
      lon = pos.coords.longitude;
      initMap();
    });
  }


function initMap() {
  const uluru = {lat: lat, lng: lon};
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 16,
    center: uluru,
  });
  const directionsService = new google.maps.DirectionsService();
  const directionsRenderer = new google.maps.DirectionsRenderer({
    draggable: true,
    map,
    panel: document.getElementById("panel"),
  });


  directionsRenderer.addListener("directions_changed", () => {
    const directions = directionsRenderer.getDirections();

    if (directions) {
      computeTotalDistance(directions);
    }
  });
var jonas = document.getElementById("valor-two").value;
var bot = document.getElementById("valor").value;
  displayRoute(
    bot,
    jonas,
    directionsService,
    directionsRenderer
  );

  const maker = new google.maps.Marker({
    position: bot,
    map: map,
  });

  getLocation();
}



function displayRoute(origin, destination, service, display) {
  service
    .route({
      origin: origin,
      destination: destination,

      travelMode: google.maps.TravelMode.DRIVING,
      avoidTolls: true,
    })
    .then((result) => {
      display.setDirections(result);
    })
    .catch((e) => {

    });
}

function computeTotalDistance(result) {
  let total = 0;
  const myroute = result.routes[0];

  if (!myroute) {
    return;
  }

  for (let i = 0; i < myroute.legs.length; i++) {
    total += myroute.legs[i].distance.value;
  }

  total = total / 1000;
  document.getElementById("total").innerHTML = total + " km";
}

window.initMap = initMap;
  </script>
</body>
</html>