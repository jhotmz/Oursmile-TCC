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
<?php
    if($nivel === '2'){
    ?>
<a href="pag/listar_usuarioAdm.php">Gerenciar</a>

<?php
    }
?>
<a href="#contact" onclick="window.location='php/sair.php'">Sair</a>
<?php
}
?>
		<div class="nav__cta">
		</div>
	</div>

</nav>