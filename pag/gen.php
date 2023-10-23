<?php
try {
  $conn = new PDO('mysql:host=127.0.0.1:3306;dbname=db_oursmile', 'root', 'usbw');
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
} catch(PDOException $e) {
    echo "ERROR: " . $e->getMessage();
}
?>
<!doctype html>
<html lang="pt-br">
  <head>
  	<title>Sidebar 04</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/navbar.css">

  </head>
  <body>
		    <!-- NAV DO SITE -->
            <nav id='menu'>
      <input type='checkbox' id='responsive-menu' onclick='updatemenu()'><label></label>
      <ul>
        <li><a href='#'>Sobre nós</a></li>
        <li><a href='#'>Clínicas e profissionais</a></li>
        <li><a href='blog.php'>Blog</a></li>
        <li><a href='../index.php'>Home</a></li>
      </ul>
    </nav>
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
	  		<h1><a href="index.html" class="logo">Project Name</a></h1>
        <ul class="list-unstyled components mb-5">
          <li class="active">
            <a href="#"><span class="fa fa-home mr-3"></span> Homepage</a>
          </li>
          <li>
              <a href="#"><span class="fa fa-user mr-3"></span> Dashboard</a>
          </li>
          <li>
            <a href="#"><span class="fa fa-sticky-note mr-3"></span> Friends</a>
          </li>
          <li>
            <a href="#"><span class="fa fa-sticky-note mr-3"></span> Subcription</a>
          </li>
          <li>
            <a href="#"><span class="fa fa-paper-plane mr-3"></span> Settings</a>
          </li>
          <li>
            <a href="#"><span class="fa fa-paper-plane mr-3"></span> Information</a>
          </li>
        </ul>

    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">
        <div class="tudo">
          <div class="pag">
            <p class="title">Usuarios cadastrados</p>
          </div>
    
    
          <div class="box-container">
            <div class="pesquisar">
              <input type="search" placeholder="Pesquisar...">
            </div>
            <div class="container">
              <div class="row mt-4">
                <div class="col-lg-12">
                  <div>
                    <h4>Listar Usuários</h4>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-lg-12">
                  <?php
                  $stmt = $conn->prepare("SELECT * FROM tb_usuario");
                  $stmt->execute();
    
                  while ($listar_usuario = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($listar_usuario)
                  ?>
    
                    <!-- Modal Editar Cargo -->
                    <div class="modal fade" id="modalEditar_<?php echo $listar_usuario['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Alterar cargo do usuário <?php echo $nm_nome; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
    
                            <form action="../php/alterarCargo.php?id=<?php echo $listar_usuario['id'] ?>" method="POST">
                              <select class="form-select" aria-label="select example" name="cargo" id="cargo">
                                <option disabled selected>Alterar(<?php echo $id_nivel; ?>)</option>
                                <option value="1">Usuário comum</option>
                                <option value="2">Administrador</option>
                                <option value="3">Dentista</option>
                              </select>
    
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          </div>
                          </form>
    
                        </div>
                      </div>
                    </div>
    
                    <!-- Modal Deletar -->
                    <div class="modal fade" id="modalDelete_<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form action="../php/excluirUsuario.php?id=<?php echo $id; ?>" method="POST">
                              <p>Tem certeza que deseja excluir o usuário <?php echo $nm_nome ?>?</p>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Excluir</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
    
    
                    <table class="table">
                      <thead class="table-dark">
                        <tr>
                          <th scope="col">ID</th>
                          <th scope="col">Nome</th>
                          <th scope="col">Sobrenome</th>
                          <th scope="col">Email</th>
                          <th scope="col">Cargo</th>
                          <th scope="col">Ações</th>
                        </tr>
                      </thead>
                      <!-- LISTAR USUÁRIOS CADASTRADOS -->
    
                      <tbody>
    
                        <tr>
                          <th scope="row"><?php echo $id; ?></th>
                          <td><?php echo $nm_nome; ?></td>
                          <td><?php echo $nm_sobrenome; ?></td>
                          <td><?php echo $nm_email; ?></td>
                          <td><?php echo $id_nivel; ?></td>
                          <td>
    
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
    
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                                  <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                                  <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
                                </svg>
    
    
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
    
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditar_<?php echo $listar_usuario['id']; ?>">
                                  Alterar
                                </button>
    
                                <button type="button" class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#modalDelete_<?php echo $id; ?>">
                                  Deletar
                                </button>
    
                              </ul>
                            </div>
    
                          </td>
                        </tr>
                      </tbody>
                    </table>
    
                  <?php
                  }
                  ?>
    
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
		</div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>