  <?php
  session_start();

// $_SESSION['id_user'];

  include_once('../php/conecta.php');
  //////////// PAGINAÇÃO ///////////

  // captura os valores da url
  $capture_get = filter_input(INPUT_GET, 'pg', FILTER_SANITIZE_URL);

  //variaveis de tratamento
  $pg = ($capture_get == '' ? 1 : $capture_get);

  // limite de exibição por página
  $limit = 8;
  $start = ($pg * $limit) - $limit;
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

    FONTE NAVTAB
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


    <!-- Font footer -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arimo:ital,wght@0,500;1,400;1,500&display=swap" rel="stylesheet">
    <!-- font icon -->
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <title>Oursmile</title>
  </head>

  <body>
    <!-- NAV DO SITE -->
    <nav class="nav">
	<img class="nav__collapser" src="https://raw.githubusercontent.com/JamminCoder/grid_navbar/master/menu.svg" alt="Collapse">
	<img src="../img/logo.png" alt="" id="logotipo">

	<!-- Put your collapsing content in here -->
	<div class="nav__collapsable">
		<a href="../index.php">Home</a>
		<a href="blog.php">Blog</a>
		<a href="#">Clínicas</a>
		
    <?php
if (!isset($_SESSION['id_user'])) {
?>

 <a href="pag/cadastrar.php">Entrar</a>
<?php
}else{
?>
<a href="perfil.php">Meu perfil</a>
<a href="#contact" onclick="window.location='php/sair.php'">Sair</a>
<?php
}
?>


		<div class="nav__cta">

		</div>
	</div>

</nav>

    <!-- BOTÕES ADM -->
    <div class="button-nav">
      <!-- BOTÃO PARA ABRIR MODAL-->
      <div class="button-adm">
        <button id="myBtn" class="button button-adc" title="Adicione uma nova publicação">+ Adicionar publicação</button>
      </div>
    </div>
<!-- 
    <style>

.favorite {
    position: relative;
    display: inline-block;
}

img {
    max-width: 100%;
    height: auto;
    display: block;
}
    </style> -->

    <!-- PESQUISAR -->
    <div class="search">
      <form class="example" action="">
        <input type="text" name="busca" id="busca" placeholder="Pesquise publicações">
        <button type="submit" onclick="searchData()"><i class="fa fa-search"></i></button>
      </form>
    </div>

    <!-- EXIBIR BUSCA NA URL -->
    <script>
      var search = document.getElementById('busca');

      function searchData() {
        window.location = 'blog.php?search=' + search.value;
      }
    </script>

    <!-- MODAL ADICIONAR, JQUERY E AJAX -->

    <?php
    include('../modal/adicionarPub.html');
    ?>

      
    <div class="w3-container">
    <div class="blog-header">
      <h1>Blog <span id="our">Our</span><span id="smile">smile</span></h1>
    </div>

  <div class="w3-row">
    <a href="javascript:void(0)" onclick="openCity(event, 'London');">
      <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">London</div>
    </a>
    <a href="javascript:void(0)" onclick="openCity(event, 'Paris');">
      <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Paris</div>
    </a>
    <a href="javascript:void(0)" onclick="openCity(event, 'Tokyo');">
      <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Tokyo</div>
    </a>
  </div>

  <div id="London" class="w3-container city" style="display:none">
    <h2>London</h2>
    <p>London is the capital city of England.</p>
  </div>

  <div id="Paris" class="w3-container city" style="display:none">
    <h2>Paris</h2>
    <p>Paris is the capital of France.</p> 
  </div>

  <div id="Tokyo" class="w3-container city" style="display:none">
    <h2>Tokyo</h2>
    <p>Tokyo is the capital of Japan.</p>
  </div>
</div>

    <section id="blog" class="blog-section">
      
        <?php
        // caso exista pesquisa
           if (!empty($_GET['busca'])) {
        // As porcentagens indicam valor antes ou depois do resultado da var "busca"
        $nome = "%" . $_GET['busca'] . "%";
        $pesquisa = "SELECT * FROM tb_blog WHERE nm_postagem LIKE :nome ORDER BY nm_postagem ASC";
        $stmt_exibir = $conn->prepare($pesquisa);
        $stmt_exibir->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt_exibir->execute();
        $lines = $stmt_exibir->rowCount();
        // exibir publicações pela ordem recentes de criação
        }else{
        $stmt_exibir = $conn->prepare("SELECT * FROM tb_blog ORDER BY data_criacao DESC LIMIT $start, $limit");
        $stmt_exibir->execute();
        $lines = $stmt_exibir->rowCount();
        }
        // se não existir publicação
        if($lines == 0) {
          echo "<br>Sem resultados!";
        }else{
          while($row_pesquisa = $stmt_exibir->fetch(PDO::FETCH_ASSOC)) {
            extract($row_pesquisa);
            //id publicação
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

<div class="blog-card">
    <div class="meta">
     <div class="photo" style="background-image: url(<?php echo $ds_img ?>)"></div>
    </div>
   <div class="description">
     <h1><?php echo $nm_postagem ?></h1>
     <br>
     <i class="fa fa-calendar"> <?php echo $dt_data ?></i>
     </h2>
     <p> <?php echo $nm_desc   ?> </p>
     <p class="favorite">
                  <?php
                  if(isset($_SESSION['id_user'])){
                  // Exiba o botão de favoritar
                  if ($favoritada){
                    // <!-- Exiba o botão de desfavoritar -->
                      echo "<button class='button-fav' method = 'Unlike' data-post ='$publicacao_id' type='submit'><img src='../img/favorite.png' alt='desfavoritar_icon' style='width: 25px;'></button>";
                  } else {
          
                    echo  "<button class='button-fav' method = 'Like' data-post ='$publicacao_id'><img src='../img/fav.png' alt='img_favorito' style='width:25px;'></button>";

                  }}
                  ?>
                </p>
     <p class="read-more">
       <a href="#">Read More</a>
     </p>
     <h2><i class="fi fi-rr-user">Jonatas</i></h2>
   </div>
   
 </div>
            <!-- FECHAR OS BAGUI -->
      <?php
          }
        }
        ?>

    </section>

    <!-- PAGINAÇÃO DAS PUBLICAÇÕES -->
    <?php
    $stmt = $conn->prepare("SELECT * FROM tb_blog ORDER BY data_criacao DESC");
    $stmt->execute();
    $linha = $stmt->rowCount();
    if ($pg <= 0) {
      return false;
    }
    $quantia = ceil($linha / $limit);
    if ($pg > $quantia) {
      return false;
    }

    echo "<div class='center'>";
    echo "<ul id='paginacao'>";

    // verifica a navegação da página anterior 
    if ($pg == 1) {
      $undo = 1;
    } else {
      $undo = $pg - 1;
    }

    // verifica a navegação da próxima página
    if ($pg == $quantia) {
      $forward = $quantia;
    } else {
      $forward = $pg + 1;
    }
    echo "<li class='paginacao'><a href='blog.php?pg={$undo}'>&laquo</a></li>";

    //  Indices limitando por 5 paginas anteriores ao ativo
    for ($i = $pg - 5; $i <= $pg; $i++) {

      //  Página atual estará colorida
      if ($i >= 1) {
        if ($pg == $i) {
          $active = "style='background-color: #14c4f4;'";
        } else {
          $active = "";
        }
      }

      if ($i >= 1) {
        echo "<li class='paginacao' {$active} id='active' ><a href='blog.php?pg={$i}'>{$i}</a></li>";
      }
    }

    //  Indices limitando por 5 paginas próximos ao ativo
    for ($e = $pg + 1; $e <= $pg + 5; $e++) {
      if ($e <= $quantia) {
        echo "<li class='paginacao'><a href='blog.php?pg={$e}'>{$e}</a></li>";
      }
    }
    echo "<li class='paginacao'><a href='blog.php?pg={$forward}'>&raquo</a></li>";
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
            } else {
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
<!-- SCRIPT NAVTAB -->
<script>
function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" w3-border-red", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.firstElementChild.className += " w3-border-red";
}
</script>


  </body>

  </html>