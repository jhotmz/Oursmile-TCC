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
  <link rel="icon" type="image/x-icon" href="img/logo oursmile.png">
  <link rel="stylesheet" href="../css/view-blog.css">
  <link rel="stylesheet" href="../css/navbar.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- FONTE POPINS -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;1,200;1,300&display=swap" rel="stylesheet">
  <!-- ICON -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-rounded/css/uicons-solid-rounded.css'>
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
  <title><?php echo $publi['nm_postagem']?></title>
</head>

<body>
  <!-- NAV DO SITE -->
  <nav class="nav">
	<img class="nav__collapser" src="https://raw.githubusercontent.com/JamminCoder/grid_navbar/master/menu.svg" alt="Collapse">
	<img src="../img/logo.png" alt="" id="logotipo">

	<!-- Put your collapsing content in here -->
	<div class="nav__collapsable">
		<a href="#">Home</a>
		<a href="pag/blog.php">Blog</a>
		<a href="#">Clínicas</a>
		
    <?php
if (!isset($_SESSION['id_user'])) {
?>

 <a href="pag/cadastrar.php">Entrar</a>
<?php
}else{
?>
<a href="pag/perfil.php">Meu perfil</a>
<a href="pag/gerenciar.php">Gerenciar</a>
<a href="#contact" onclick="window.location='php/sair.php'">Sair</a>
<?php
}
?>



		<div class="nav__cta">
		</div>
	</div>
</nav>

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

  <div class="conteudo-blog">
    <header class="blog-header">

      <div class="dateActor">
        Por <?php echo $nm_autor ?>, publicado em <?php date_default_timezone_set('America/Sao_Paulo');

         echo date('d/m/Y', strtotime($dt_data)); ?>
      </div>
      <div class="back">
        <a href="blog.php" class="back-blog">Voltar para o blog</a>
      </div>
      <div class="img-file">
        <div class="foto">
        <img src="<?php echo $ds_img ?>" id="img" alt="imagem relacionada a postagem">
        </div>
      </div>
      <div class="tittle-post">
        <?php echo $nm_postagem; ?>
      </div>
    </header>
    <section class="conteudo-post">
      <p><?php echo $ds_conteudo; ?></p>
      <div class="share">
        <p>Compartilhe este conhecimento!</p><br>
        <a class="share" id="copiarBotao"><i class="fi fi-sr-share"></i></a>
      </div>
    </section>
  </div>
  
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
</body>
</main>
</body>
</html>