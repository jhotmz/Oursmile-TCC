<?php
require "../php/conecta.php";
$id = $_GET['id'];

session_start();
    include('../php/conecta.php');
    if (!isset($_SESSION['id_user'])) {
    $nome = "Login";
    }else{
    $usuario = $_SESSION['id_user'];

    $stmt = $conn->prepare("SELECT * FROM tb_usuario WHERE id = '$id'");
    $stmt-> execute();
    $stmt = $stmt->fetch();
    $nome = $stmt['nm_nome'];
    }
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/clinica.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <?php
    $exibir_clinica = $conn->prepare("SELECT * FROM tb_clinica WHERE id = '$id'");
    $exibir_clinica->execute();
    $exibir = $exibir_clinica->fetch(PDO::FETCH_ASSOC);
    extract($exibir);
    ?>
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
    <?php
    $exibir_clinica = $conn->prepare("SELECT * FROM tb_clinica WHERE id = '$id'");
    $exibir_clinica->execute();
    $exibir = $exibir_clinica->fetch(PDO::FETCH_ASSOC);
    extract($exibir);
    ?>

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
  <input type="hidden" value="<?php echo $stmt['id']?>" id="id">
  <input type="hidden" id="valor-two" onkeyup="initMap()" value="<?php echo $nm_endereco;?>">
  <input type="hidden" id="valor" onkeyup="initMap()"  value="<?php echo $stmt['nm_local']?>">

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
    <div class="stars" data-rating="0">
        <span class="star" data-value="1">★</span>
        <span class="star" data-value="2">★</span>
        <span class="star" data-value="3">★</span>
        <span class="star" data-value="4">★</span>
        <span class="star" data-value="5">★</span>
    </div>
    <p id="rating-value">Avaliação: 0</p>
</div>
<script src="../js/avaliar.js"></script>


<br><br><br>
<?php echo $nm_tratamentos;?><br>
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
  <input placeholder="Adicione um endereço aqui" type="text"class="input" id="endereco" value="<?php echo $stmt['nm_local'];?>"> 
  <button class="edits" style="display:flex; float:right;" id="editos">
<b class="material-symbols-outlined">
edit
</b>
</button>
</div>
</div>


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

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

        </script>


</body>
</html>