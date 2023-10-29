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
    <link rel="stylesheet" href="../css/navbar.css">
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
  </head>
  <body>
    <!-- NAV DO SITE -->
<?php
include("nav.php");
?>

    <?php
    if($nivel === '2'){
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

    <div class="blog-header">
      <h1>Blog <span id="our">Our</span><span id="smile">smile</span></h1>
    </div>

    
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

<!-- SECTION BLOG -->
    <section id="blog" class="blog-section">
      <?php
        $lines = $stmt_exibir->rowCount();
        if($lines > 0){
        while($row_pesquisa = $stmt_exibir->fetch(PDO::FETCH_ASSOC)){
        extract($row_pesquisa);
      ?>

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

    </section>

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