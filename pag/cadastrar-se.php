<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <nav class="nav">
        <img class="nav__collapser" src="https://raw.githubusercontent.com/JamminCoder/grid_navbar/master/menu.svg" alt="Collapse">
        <img src="../img/logo.png" alt="" id="logotipo">
        <link rel="stylesheet" href="../css/navbar.css">

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
            } else {
            ?>
                <a href="pag/perfil.php">Meu perfil</a>
                <?php
                if ($nivel === '2') {
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

    <div class="section">
        <div class="button">
            <button><a href="cadastrar.php">Cadastrar-se como usuário</a></button>
        </div>
        <div class="button">
            <button><a href="cadastroDentista.php">Cadastrar-se como dentista</a></button>
        </div>
        <a href="login.php">Já tenho login</a>
    </div>

</body>
</html>