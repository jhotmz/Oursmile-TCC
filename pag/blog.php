<?php
  session_start();
  if(isset($_SESSION['nivel'])){
    $nivel = $_SESSION['nivel'];
  }else{
    $nivel = '1';
  }
  include_once('../php/conecta.php');
  //////////// PAGINAÇÃO ///////////

  // captura os valores da url
  $capture_get = filter_input(INPUT_GET, 'pg', FILTER_SANITIZE_URL);

  //variaveis de tratamento
  $pg = ($capture_get == '' ? 1 : $capture_get);

  // limite de exibição por página
  $limit = 8;
  $start = ($pg * $limit) - $limit;
  
  // CONSULTA TABELA USUÁRIO
  $usuario = $conn->prepare("SELECT id, nm_nome FROM tb_usuario");
  $usuario->execute();
  $exibir_user = $usuario->fetch(PDO::FETCH_ASSOC);

  // CONSULTAR CATEGORIAS DO BLOG
  $categoria = "SELECT id, nm_categoria FROM tb_categoria";
  $exibir_categoria = $conn->prepare($categoria);
  $exibir_categoria->execute();

  // CASO EXISTA ARTIGO
  if(isset($_GET['artigo'])){
  $id_categoria = $_GET['artigo'];
  $stmt_exibir = $conn->prepare("SELECT * FROM tb_blog WHERE id_categoria = '$id_categoria' ORDER BY data_criacao DESC LIMIT $start, $limit");
  $stmt_exibir->execute();
  $lines = $stmt_exibir->rowCount();
  $post = "Categoria: ";
  }
  //CASO EXISTA PESQUISA
  elseif (!empty($_GET['busca'])) {
  $nome = "%" . $_GET['busca'] . "%";
  $pesquisa = "SELECT * FROM tb_blog WHERE nm_postagem LIKE :nome ORDER BY nm_postagem DESC LIMIT $start, $limit";
  $stmt_exibir = $conn->prepare($pesquisa);
  $stmt_exibir->bindParam(':nome', $nome, PDO::PARAM_STR);
  $stmt_exibir->execute();
  $post = "Resultados para: ".$_GET['busca'];
  $lines = $stmt_exibir->rowCount();
  }else{
  // CONSULTAR POSTAGENS NO BLOG
  $stmt_exibir = $conn->prepare("SELECT * FROM tb_blog ORDER BY data_criacao DESC LIMIT $start, $limit");
  $stmt_exibir->execute();
  $lines = $stmt_exibir->rowCount();
  $post = "Publicações recentes";
  }
  ?>

  <!DOCTYPE html>
  <html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="../img/logo oursmile.png">
    <link rel="stylesheet" href="../css/blog_copy.css">
    <link rel="stylesheet" href="../css/blog.css">
    <link rel="stylesheet" href="../css/modal.css">
    <script src="https://kit.fontawesome.com/eac31603cd.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../dist/ui/trumbowyg.min.css">
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;1,200&display=swap" rel="stylesheet">
    <!-- font pesquisar -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- font icon -->
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <title>Oursmile</title>
    <style>
      /* Font */
@import url('https://fonts.googleapis.com/css?family=Quicksand:400,700');




.main{
  max-width: 1200px;
  margin: 0 auto;
}

h1 {
    font-size: 24px;
    font-weight: 400;
    text-align: center;
}

img {
  height: auto;
  max-width: 100%;
  vertical-align: middle;
}

.btn {

  padding: 0.8rem;
  font-size: 14px;
  text-transform: uppercase;
  border-radius: 4px;
  font-weight: 400;
  display: block;
  width: 100%;
  cursor: pointer;
  border: 1px solid rgba(255, 255, 255, 0.2);
  background: transparent;
}

.btn:hover {
  background-color: rgba(255, 255, 255, 0.12);
}

.cards {
  display: flex;
  flex-wrap: wrap;
  list-style: none;
  margin: 0;
  padding: 0;
}

.cards_item {
  display: flex;
  padding: 1rem;
}

@media (min-width: 40rem) {
  .cards_item {
    width: 50%;
  }
}

@media (min-width: 56rem) {
  .cards_item {
    width: 33.3333%;
  }
}

.card {
  background-color: white;
  border-radius: 0.25rem;
  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  display: flex;
  flex-direction: column;
  overflow: hidden;
}

.card_content {
  padding: 1rem;

}

.card_title {

  font-size: 1.1rem;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: capitalize;
  margin: 0px;
}

.card_text {

  font-size: 0.875rem;
  line-height: 1.5;
  margin-bottom: 1.25rem;    
  font-weight: 400;
}
.made_by{
  font-weight: 400;
  font-size: 13px;
  margin-top: 35px;
  text-align: center;
}
    </style>
  </head>
  <body>
    <!-- NAV DO SITE -->
<?php
include("navbars.php");
?>
<br><br><br><br><br>  
    <?php
    if($nivel == '2'){
    ?>
    <!-- BOTÕES ADM -->
    <div class="button-nav">
      <!-- BOTÃO PARA ABRIR MODAL-->
      <div class="button-adm">
        <button id="myBtn" class="button button-adc" title="Adicione uma nova publicação">+ Adicionar publicação</button>
      </div>
    </div>
    <?php
    }
    ?>

    <!-- EXIBIR BUSCA NA URL -->
    <script>
      var search = document.getElementById('busca');

      function searchData() {
        window.location = 'blog.php?search=' + search.value;
      }
    </script>

    <!-- MODAL ADICIONAR, JQUERY E AJAX -->

    <?php
    include_once('../modal/adicionarPub.php');
    ?>

  

    
<!-- NAVTAB -->
<div class="nav-tab">
<div class="link-tab">
    <a href="blog.php" name="">Recentes</a>        
</div>
  <?php
      while($categoria = $exibir_categoria->fetch(PDO::FETCH_ASSOC)){
  ?>  
    <div class="link-tab">
    <a href="#" name="" onclick="window.location.href='blog.php?artigo=<?php echo $categoria['id']; ?>'"><?php echo $categoria['nm_categoria'];?></a>        
    </div>
  <?php
      }    
  ?>
</div>

  <!-- PESQUISAR -->
  <div class="search">
    <form class="example" action="">
      <input type="text" name="busca" id="busca" placeholder="Pesquise publicações">
      <button type="submit" onclick="searchData()"><i class="fa fa-search"></i></button>
    </form>
  </div>  

<!-- LEGENDA DA EXIBIÇÃO -->
    <div class="msg-post">
  <?php 
  echo $post;
  ?> 
    </div>

    <div class="main">
  <h1>Responsive Card Grid Layout</h1>
  <ul class="cards">

<!-- SECTION BLOG -->
   
      <?php
        $lines = $stmt_exibir->rowCount();
        if($lines > 0){
        while($row_pesquisa = $stmt_exibir->fetch(PDO::FETCH_ASSOC)){
        extract($row_pesquisa);
      ?>

    <li class="cards_item">
      <div class="card">
        <div class="card_image"><img src="https://picsum.photos/500/300/?image=10"></div>
        <div class="card_content">
          <h2 class="card_title"><?php echo $nm_postagem ?></h2>
          <p class="card_text"><?php echo $nm_desc?></p>
          <?php date_default_timezone_set('America/Sao_Paulo');
 echo date('d/m/y', strtotime($dt_data)); ?>
          <button class="buttonPerfil">Saiba mais</button>
          <img src="../img/dentechave.png" alt="" style="width:2rem;margin-top:1rem;"> <?php echo $row_pesquisa['nm_autor'] ?>
        </div>
        
      </div>
    </li>
   

    

<div class="blog-card">
    <div class="meta">
     <div class="photo" style="background-image: url(<?php echo $ds_img ?>)"></div>
    </div>
<div class="description">
     <h1><?php echo $nm_postagem ?></h1>
     <br>
     <i class="fa fa-calendar"> <?php date_default_timezone_set('America/Sao_Paulo');
 echo date('d/m/y', strtotime($dt_data)); ?></i>
     </h2>
     <p><?php echo $nm_desc?></p>
     
     <?php
     $publicacao_id = $row_pesquisa['id_post'];
     // Verifique se a publicação já está nos favoritos do usuário
     $favoritada = false;
     $query = "SELECT * FROM tb_favorito WHERE user_id = :usuario_id AND pub_id = :publicacao_id";
     $stmt2 = $conn->prepare($query);
     $stmt2->bindParam(':usuario_id', $_SESSION['id_user']);
     $stmt2->bindParam(':publicacao_id', $publicacao_id);
     $stmt2->execute();
     if ($stmt2->rowCount() > 0) {
       $favoritada = true;
     }
     ?>
                  <?php
                  if(isset($_SESSION['id_user'])){
                  // Exiba o botão de favoritar
                  if ($favoritada){
              
                    // <!-- Exiba o botão de desfavoritar -->
                     
                      echo "<button class='button-fav' method = 'Unlike' data-post ='$publicacao_id' type='submit'><img src='../img/lover.png' alt='desfavoritar_icon' style='width: 25px;'></button>";
                  } else {
          
      echo  "<button class='button-fav' method = 'Like' data-post ='$publicacao_id'><img src='../img/heart.png' alt='img_favorito' style='width:25px;'></button>";

      }}
     ?>
     <p class="read-more">
       <a onclick="window.location.href='view.php?id=<?php echo $row_pesquisa['id_post']; ?>'">Saiba mais</a>&nbsp;&nbsp;
       <?php
      if($nivel === '2'){
       ?>
       <a class="teste" href="edit.php?id=<?php echo $id_post?>"><i class="fa-solid fa-pen-to-square"></i></a>&nbsp;&nbsp;
       <a href="../php/excluirPub.php?id=<?php echo $id_post?>"><i class="fa-solid fa-trash"></i></a>
       <?php
       }
       ?>
     </p>
     <h2><i class="fi fi-rr-user"><?php echo $row_pesquisa['nm_autor'] ?></i></h2>
   </div>
  
 </div>
  <!-- FECHAR WHILE EXIBIÇÃO -->
      <?php
    }    
     }else{
     echo "Sem resultados!";
    }
        ?>

</ul>
</div>

<!-- PAGINAÇÃO DAS PUBLICAÇÕES -->
<?php
// Função para gerar o link de paginação
function generatePageLink($page) {
    $baseURL = 'blog.php';
    $params = array();

    if (isset($_GET['artigo'])) {
        $params['artigo'] = $_GET['artigo'];
    } elseif (!empty($_GET['busca'])) {
        $params['busca'] = $_GET['busca'];
    }

    $params['pg'] = $page;
    $queryString = http_build_query($params);

    return $baseURL . '?' . $queryString;
}

echo "<div class='center'>";
echo "<ul id='paginacao'>";

// Consulta para contar o número total de resultados de acordo com o filtro
$stmt_total = $conn->prepare("SELECT COUNT(*) as total FROM tb_blog");

if (isset($_GET['artigo'])) {
    // Adicione aqui a lógica para contar os resultados com base no filtro de artigo
    $stmt_total = $conn->prepare("SELECT COUNT(*) as total FROM tb_blog WHERE id_categoria = :id_categoria");
    $stmt_total->bindParam(':id_categoria', $_GET['artigo'], PDO::PARAM_INT);
} elseif (!empty($_GET['busca'])) {
    // Adicione aqui a lógica para contar os resultados com base no filtro de busca
    $stmt_total = $conn->prepare("SELECT COUNT(*) as total FROM tb_blog WHERE nm_postagem LIKE :busca");
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
<!-- SCRIPT PARA ENVIAR FAVORITO-->
<script>
    $(document).ready(function ($) {
        $(".button-fav").click(function (e) {
            e.preventDefault();
            const director_id = $(this).attr('data-post'); // Get the parameter director_id from the button
            const method = $(this).attr('method'); // Get the parameter method from the button
            if (method === "Like") {
                $(this).attr('method', 'Unlike'); // Change the div method attribute to Unlike
                $(this).html('<img src="../img/favorite.png" alt="desfavoritar_icon" style="width: 25px;>" id="'+director_id+'">').toggleClass('button mybtn'); // Replace the image with the liked button
            }else{
                $(this).attr('method', 'Like');
                $(this).html('<img src="../img/fav.png" alt="desfavoritar_icon" style="width: 25px;>" id="' + director_id + '">').toggleClass('mybtn button');
            }
            $.ajax({
                url: '../php/favPost.php', // Call favs.php to update the database
                type: 'GET',
                data: {director_id: director_id, method: method},
                cache: false,
                success: function (data) {
                }
            });
        });
    });
</script>

</body>
</html>