<?php
session_start();
// VISUALIZAÇÕES DA PAGINA
include_once("../php/conecta.php");

// Função para registrar uma visualização
function registrarVisualizacao($postId)
{
  global $conn;
  $ip = $_SERVER['REMOTE_ADDR'];
  $navegador = $_SERVER['HTTP_USER_AGENT'];
  
  // Verificar se o cookie para este post já existe
  if (!isset($_COOKIE["post_viewed_$postId"])) {
    try {
      $stmt = $conn->prepare("INSERT INTO tb_acesso (id_post, dt_acesso, ds_navegador, ip) VALUES (:postId, NOW(), '$navegador', '$ip')");
      $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
      $stmt->execute();
      
      // Definir um cookie para evitar visualizações repetidas por este usuário
      setcookie("post_viewed_$postId", 1, time() + 3600); // O cookie expira em 1 hora
    } catch (PDOException $e) {
      echo "Erro ao registrar visualização: " . $e->getMessage();
    }
  }
}

// Função para obter o número de visualizações de um post
function obterVisualizacoes($postId)
{
  global $conn;

  try {
    $stmt = $conn->prepare("SELECT COUNT(*) as total FROM tb_acesso WHERE id_post = :postId");
    $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    return $resultado['total'];
  } catch (PDOException $e) {
    echo "Erro ao obter visualizações: " . $e->getMessage();
    return 0;
  }
}

$id = $_GET['id'];
// EXIBIR PUB
$blog_pub = $conn->prepare("SELECT * FROM tb_blog WHERE id_post = :id");
$blog_pub->bindParam(':id', $id);
$blog_pub->execute();
$lines = $blog_pub->rowCount();  
$publi = $blog_pub->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="img/logo.png">
  <link rel="stylesheet" href="../css/view-blog.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- FONTE POPINS -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;1,200;1,300&display=swap" rel="stylesheet">
  <!-- ICON -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-rounded/css/uicons-solid-rounded.css'>
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
  <title>Publicação - <?php echo $publi['nm_postagem']?></title>
</head>

<body style="background-color:#DBEEFF">
  <!-- NAV DO SITE -->
  <?php
include("navbars.php");
?><br><br><br><br>
<br><br>


  <!-- <div class="header">
    <div class="progress-container">
      <div class="progress-bar" id="myBar"></div>
    </div>
  </div> -->

  <?php
  if($lines === 0){
    echo "Desculpe, mas essa página não existe!"."<br>";
    echo "<a href='blog.php' class='back-blog'>Voltar para o blog</a>";
  }else{

  extract($publi);
  ?>
  <div style="display:flex;justify-content:center;">
<div class="card">

<div class="info">
  <p class="title"><?php echo $nm_postagem; ?></p>
  <p style="font-size:1rem;"><?php echo $ds_conteudo; ?></p>
</div>
<div class="dateActor">
        Por <?php echo $nm_autor ?>, publicado em <?php date_default_timezone_set('America/Sao_Paulo');

         echo date('d/m/Y', strtotime($dt_data)); ?>
      </div><br>
<div class="footer">


  <div class="visu-post">
    <i class="fi fi-rr-eye" >
      <?php

      // ID do post que você deseja registrar visualizações
      $postId = $_GET['id'];

      // Registrar uma visualização para o post com o ID especificado
      registrarVisualizacao($postId);

      // Obter o número de visualizações para o post com o ID especificado
      $visualizacoes = obterVisualizacoes($postId);

      echo "$visualizacoes";

      ?>

    </i>
  </div>

  <?php
}
?>


  </p>
  <div class="share">
       
        <a class="share" id="copiarBotao" style="cursor:pointer;"><i class="fi fi-sr-share" style="position:relative;top:0.2rem;"></i> Compartilhe este conhecimento</a>
      </div>
</div>
</div>
</div>

 


  <script>
        // Função para copiar a URL da página atual
        function copiarURL() {
            // Obtém a URL da página atual
            var url = window.location.href;

            // Cria um elemento de input para armazenar a URL
            var input = document.createElement('input');
            input.value = url;

            // Adiciona o elemento de input à página
            document.body.appendChild(input);

            // Seleciona o conteúdo do input
            input.select();

            // Copia o conteúdo selecionado para a área de transferência
            document.execCommand('copy');

            // Remove o elemento de input da página
            document.body.removeChild(input);

            // Feedback para o usuário
            swal('URL copiada: '+url);
        }

        // Associa a função ao evento de clique do botão
        document.getElementById('copiarBotao').addEventListener('click', copiarURL);
    </script>

<script src="../js/scroll.js"></script>
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
</main>
</body>

</body>
</html>