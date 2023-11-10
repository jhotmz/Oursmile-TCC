 <?php
session_start();
    include('../php/conecta.php');
    if (!isset($_SESSION['id_user'])) {
    header('location: ../index.php');
    }else{
    $usuario = $_SESSION['id_user'];

    $user_id = $conn->prepare("SELECT * FROM tb_usuario WHERE id = '$usuario'");
    $user_id-> execute();
    $user_id = $user_id->fetch();
    $nome = $user_id['nm_nome'];
   
    
    //////////// PAGINAÇÃO ///////////

  // captura os valores da url
  $capture_get = filter_input(INPUT_GET, 'pg', FILTER_SANITIZE_URL);

    //variaveis de tratamento
   $pg = ($capture_get == '' ? 1 : $capture_get);

    // limite de exibição por página
    $limit = 10;
    $start = ($pg * $limit) - $limit;
    
    //CASO EXISTA PESQUISA
    if (!empty($_GET['busca'])) {
    $nome = "%" . $_GET['busca'] . "%";
    $pesquisa = "SELECT * FROM tb_clinica WHERE nm_clinica LIKE :nome ORDER BY nm_clinica DESC LIMIT $start, $limit";
    $stmt_exibir = $conn->prepare($pesquisa);
    $stmt_exibir->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt_exibir->execute();
    $post = "Resultados para: ".$_GET['busca'];
    $lines = $stmt_exibir->rowCount();
    }else{
    // CONSULTAR POSTAGENS NO BLOG
    $stmt_exibir = $conn->prepare("SELECT * FROM tb_clinica ORDER BY data_criacao DESC LIMIT $start, $limit");
    $stmt_exibir->execute();
    $lines = $stmt_exibir->rowCount();
    $post = "Publicações recentes";
    }

    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/modal.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
    <link rel="stylesheet" href="../css/sobre-nosso-site.css">
    <link rel="stylesheet" href="../css/clinica.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <title>Clínicas</title>
    <style>
#map{
  height: 25rem;
  max-width:40rem;
  border-color:#279989;
  border-style:solid;
  border-radius:1rem;

}
#horaEntrada,#horaSaida::placeholder {
    font: 0.9rem arial;
}
#horaEntrada,#horaSaida{
   width:7rem;
   height:2.2rem;
}


    </style>
</head>
<script src="../js/modais.js"></script>
<script src="../js/jquery-3.6.4.js"></script>

<body>
<nav class="nav">
	<img class="nav__collapser" src="https://raw.githubusercontent.com/JamminCoder/grid_navbar/master/menu.svg" alt="Collapse">
	<img src="../img/logo.png" alt="" id="logotipo">

	<!-- Put your collapsing content in here -->
	<div class="nav__collapsable">
		<a href="#">Home</a>
		<a href="#">Blog</a>
		<a href="#">Clínicas</a>

    <?php

if($_SESSION['nivel'] == 2){
?>
<button onclick="window.location.href='addClinica.php'">Adicionar +</button>
<?php
}else{
?>

<?php
}?>

		<div class="nav__cta">

		</div>
	</div>

</nav>
    <!-- nav do site -->
<br>
<br>
    <script>
        const toggleMenuOpen = () => document.body.classList.toggle("open");
    </script>
    <nav class="navbar" style="display:none;">
      <div class="navbar-overlay" onclick="toggleMenuOpen()"></div>

      <button type="button" class="navbar-burger" onclick="toggleMenuOpen()">
        <span class="material-icons">menu</span>
      </button>
      <img src="../img/logotipo.png" alt="" id="logo">
      <nav class="navbar-menu">

        <button type="button">Home</button>
        <button type="button">Blog</button>
        <div class="dropdown">
            
            <span>Configurações▼</span>
            <div class="dropdown-content">
            <?php 
                   if (!isset($_SESSION['email'])) {
                      ?>
                      <a href="pag/cadastrar.php">Logar</a>
                      <?php 
                  }else{?>
                  <a href="#login"><?php echo $nome;?></a><br><br>
                  <?php
                      }
                      ?>
               <a href="#contact" id="myBtn">Sair</a>
            </div>
          </div> 
        <button type="button" class="active">Clínicas</button>
       
     
      </nav>
    </nav>

        <!-- EXIBIR BUSCA NA URL -->
    <script>
      var search = document.getElementById('busca');

      function searchData() {
        window.location = 'clinicas.php?search=' + search.value;
      }
    </script>

    <div class="input-group">
   
    <form action="">
 
  <div class="container-input">
  <input type="text" name="busca" id="busca" placeholder="Pesquisar:" autocomplete="off" onkeyup="pesquisar()" class="input">
  <svg type="submit" class="invite-btn" onclick="searchData()" fill="#000000" width="20px" height="20px" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg">
    <path d="M790.588 1468.235c-373.722 0-677.647-303.924-677.647-677.647 0-373.722 303.925-677.647 677.647-677.647 373.723 0 677.647 303.925 677.647 677.647 0 373.723-303.924 677.647-677.647 677.647Zm596.781-160.715c120.396-138.692 193.807-319.285 193.807-516.932C1581.176 354.748 1226.428 0 790.588 0S0 354.748 0 790.588s354.748 790.588 790.588 790.588c197.647 0 378.24-73.411 516.932-193.807l516.028 516.142 79.963-79.963-516.142-516.028Z" fill-rule="evenodd"></path>
    </svg>
</div>
</div>
   </form>



</div>
    



<div class="wrapper">

  

  <div class="team">
<!-- EXIBIR CLINICAS -->
<?php
    if($lines > 0){
    while($row = $stmt_exibir->fetch(PDO::FETCH_ASSOC)){
    extract($row);
?>


    <div class="team_member">
   <!-- <b class="dot"></b> -->
   <img src="<?php echo $ds_img?>" alt="Imagem relacionada a clínica" width="100%">
<br>
     <p class="titulos"><?php echo $nm_clinica;?></p><br>
      
      
      <p class="subTitulos"><?php echo $nm_dentista;?></p>
<br>
   


   
    <button onclick="window.location.href='pagClinica.php?id=<?php echo $row['id']?>'" class="buttonClinica">
  <span>Saiba mais</span>
</button>

 <br><br>
 <?php
 $botao = '<label class="container" style="display:flex; justify-content:end;">
 <input type="checkbox">
 <svg class="save-regular" xmlns="http://www.w3.org/2000/svg" height="1rem" viewBox="0 0 384 512"><path d="M0 48C0 21.5 21.5 0 48 0l0 48V441.4l130.1-92.9c8.3-6 19.6-6 27.9 0L336 441.4V48H48V0H336c26.5 0 48 21.5 48 48V488c0 9-5 17.2-13 21.3s-17.6 3.4-24.9-1.8L192 397.5 37.9 507.5c-7.3 5.2-16.9 5.9-24.9 1.8S0 497 0 488V48z"></path></svg>
 <svg class="save-solid" xmlns="http://www.w3.org/2000/svg" height="1rem" viewBox="0 0 384 512"><path d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z"></path></svg>
</label>';

$botaoAtivo = '<label class="container" style="display:flex; justify-content:end;">
<input type="checkbox" checked>
<svg class="save-regular" xmlns="http://www.w3.org/2000/svg" height="1rem" viewBox="0 0 384 512"><path d="M0 48C0 21.5 21.5 0 48 0l0 48V441.4l130.1-92.9c8.3-6 19.6-6 27.9 0L336 441.4V48H48V0H336c26.5 0 48 21.5 48 48V488c0 9-5 17.2-13 21.3s-17.6 3.4-24.9-1.8L192 397.5 37.9 507.5c-7.3 5.2-16.9 5.9-24.9 1.8S0 497 0 488V48z"></path></svg>
<svg class="save-solid" xmlns="http://www.w3.org/2000/svg" height="1rem" viewBox="0 0 384 512"><path d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z"></path></svg>
</label>';

     $clinica_id = $id;
     // Verifique se a publicação já está nos favoritos do usuário
     $favoritada = false;
     $query = "SELECT * FROM tb_favorito WHERE user_id = :usuario_id AND clinica_id = :clinica_id";
     $stmt2 = $conn->prepare($query);
     $stmt2->bindParam(':usuario_id', $_SESSION['id_user']);
     $stmt2->bindParam(':clinica_id', $clinica_id);
     $stmt2->execute();
     if ($stmt2->rowCount() > 0) {
       $favoritada = true;
     }

    if(isset($_SESSION['id_user'])){
      // Exiba o botão de favoritar
        if ($favoritada){
                    // <!-- Exiba o botão de desfavoritar -->
                      echo "<button class='button-fav' method = 'Unlike' data-post ='$clinica_id' type='submit' style='display:flex; justify-content:end; margin-left:0.5rem;'>
                      
              $botaoAtivo

                      </button>";
                  } else {
          
                    echo  "<button class='button-fav' method = 'Like' data-post ='$clinica_id' style='display:flex; justify-content:end; margin-left:0.5rem;'>
                    
                    $botao


                    </button>";

                  }}
                  ?>


<br>
<?php

if($_SESSION['nivel'] == 2){
?>
<button class="edits"  onclick="window.location.href='editClinica.php?id=<?php echo $row['id'];?>'">
<b class="material-symbols-outlined">
edit
    </b>
</button>

<button class="edits" onclick="window.location.href='../php/excluirClinica.php?id=<?php echo $row['id']; ?>'">
<b class="material-symbols-outlined">
delete

    </b>
</button>
<?php
}else{
?>

<?php
}?>
 
    </div>
    
  <?php 
  }}else{
    echo "Sem resultados!";
  }
  
  ?>

    </div>
 </div>
  
</div>


<!-- PAGINAÇÃO DAS PUBLICAÇÕES -->
<?php
// Função para gerar o link de paginação
function generatePageLink($page) {
    $baseURL = 'clinicas.php';
    $params = array();

    if (!empty($_GET['busca'])) {
      $params['busca'] = $_GET['busca'];
    }

    $params['pg'] = $page;
    $queryString = http_build_query($params);

    return $baseURL . '?' . $queryString;
}

echo "<div class='center'>";
echo "<ul id='paginacao'>";

// Consulta para contar o número total de resultados de acordo com o filtro
$stmt_total = $conn->prepare("SELECT COUNT(*) as total FROM tb_clinica");
if (!empty($_GET['busca'])) {
  // Adicione aqui a lógica para contar os resultados com base no filtro de busca
  $stmt_total = $conn->prepare("SELECT COUNT(*) as total FROM tb_clinica WHERE nm_clinica LIKE :busca");
  $stmt_total->bindParam(':busca',$nome, PDO::PARAM_STR);
}

$stmt_total->execute();
$total_results = $stmt_total->fetchColumn();
$total_pages = ceil($total_results / $limit);

$pg = isset($_GET['pg']) ? intval($_GET['pg']) : 1;

if ($pg < 1) {
    $pg = 1;
} elseif ($pg > $total_pages) {
    $pg = $total_pages;
}

if ($total_results > 0) {
    // Verifica a navegação da página anterior
    $previousPage = $pg - 1;

    if ($previousPage >= 1) {
        echo "<li class='paginacao'><a href='" . generatePageLink($previousPage) . "'>&laquo</a></li>";
    }

    // Gere os links para as páginas
    for ($i = max(1, $pg - 5); $i <= min($total_pages, $pg + 5); $i++) {
        // Página atual estará colorida
      if ($i >= 1) {
        if ($pg == $i) {
          $active = "style='background-color: #14c4f4;'";
          }else{
            $active = "";
          }
        }
        echo "<li class='paginacao' {$active}><a href='" . generatePageLink($i) . "'>$i</a></li>";
    }

    // Verifica a navegação da próxima página
    $nextPage = $pg + 1;

    if ($nextPage <= $total_pages) {
        echo "<li class='paginacao'><a href='" . generatePageLink($nextPage) . "'>&raquo</a></li>";
    }
} 
echo "</ul></div>";
?>

<!-- SCRIPT PARA ENVIAR FAVORITO-->
<script>
    $(document).ready(function ($) {
        $(".button-fav").click(function (e) {
            e.preventDefault();
            const director_id = $(this).attr('data-post'); // Get the parameter director_id from the button
            const method = $(this).attr('method'); // Get the parameter method from the button
            if (method === "Like") {
                $(this).attr('method', 'Unlike'); // Change the div method attribute to Unlike
                $(this).html('<label class="container" style="display:flex; justify-content:end;"><input type="checkbox" checked " id="'+director_id+'"><svg class="save-regular" xmlns="http://www.w3.org/2000/svg" height="1rem" viewBox="0 0 384 512"><path d="M0 48C0 21.5 21.5 0 48 0l0 48V441.4l130.1-92.9c8.3-6 19.6-6 27.9 0L336 441.4V48H48V0H336c26.5 0 48 21.5 48 48V488c0 9-5 17.2-13 21.3s-17.6 3.4-24.9-1.8L192 397.5 37.9 507.5c-7.3 5.2-16.9 5.9-24.9 1.8S0 497 0 488V48z"></path></svg><svg class="save-solid" xmlns="http://www.w3.org/2000/svg" height="1rem" viewBox="0 0 384 512"><path d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z"></path></svg></label>').toggleClass('button mybtn'); // Replace the image with the liked button
            }else{
                $(this).attr('method', 'Like');
                $(this).html('<label class="container" style="display:flex; justify-content:end;"><input type="checkbox" id="'+director_id+'"><svg class="save-regular" xmlns="http://www.w3.org/2000/svg" height="1rem" viewBox="0 0 384 512"><path d="M0 48C0 21.5 21.5 0 48 0l0 48V441.4l130.1-92.9c8.3-6 19.6-6 27.9 0L336 441.4V48H48V0H336c26.5 0 48 21.5 48 48V488c0 9-5 17.2-13 21.3s-17.6 3.4-24.9-1.8L192 397.5 37.9 507.5c-7.3 5.2-16.9 5.9-24.9 1.8S0 497 0 488V48z"></path></svg><svg class="save-solid" xmlns="http://www.w3.org/2000/svg" height="1rem" viewBox="0 0 384 512"><path d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z"></path></svg></label>').toggleClass('mybtn button');
            }
            $.ajax({
                url: '../php/favPostClinica.php', // Call favs.php to update the database
                type: 'GET',
                data: {director_id: director_id, method: method},
                cache: false,
                success: function (data){
                }
            });
        });
    });
</script>

</body>
</html>