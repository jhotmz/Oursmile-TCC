<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <style>
        button {
 appearance: button;
 background-color: #1899D6;
 border: solid transparent;
 border-radius: 16px;
 border-width: 0 0 4px;
 box-sizing: border-box;
 color: #FFFFFF;
 cursor: pointer;
 display: inline-block;
 font-size: 15px;
 font-weight: 700;
 letter-spacing: .8px;
 line-height: 20px;
 margin: 0;
 outline: none;
 overflow: visible;
 padding: 13px 19px;
 text-align: center;
 text-transform: uppercase;
 touch-action: manipulation;
 transform: translateZ(0);
 transition: filter .2s;
 user-select: none;
 -webkit-user-select: none;
 vertical-align: middle;
 white-space: nowrap;
}

button:after {
 background-clip: padding-box;
 background-color: #1CB0F6;
 border: solid transparent;
 border-radius: 16px;
 border-width: 0 0 4px;
 bottom: -4px;
 content: "";
 left: 0;
 position: absolute;
 right: 0;
 top: 0;
 z-index: -1;
}

button:main, button:focus {
 user-select: auto;
}

button:hover:not(:disabled) {
 filter: brightness(1.1);
}

button:disabled {
 cursor: auto;
}

button:active:after {
 border-width: 0 0 0px;
}

button:active {
 padding-bottom: 10px;
}
.section{
    display:grid;
    justify-content:center;
    
    align-items:center;
    place-items:center;
 
}

    </style>
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

    </nav><br><br>
    <div class="section">
    
       
            <button onclick="window.location='cadastrar.php'">Cadastrar-se como usuário</button>

        <br>
            <button onclick="window.location='cadastroDentista.php'">Cadastrar-se como dentista</button>
       
        <a href="login.php" style="margin-top:0.3rem; color: #1CB0F6; text-decoration:underline">Já tenho login</a>
   

</body>
</html>