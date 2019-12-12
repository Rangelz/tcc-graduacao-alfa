<?php
session_start();
if (!isset($_SESSION["sistema"])) {
    echo "<script>alert('Usuário não logado!');location.replace('../index.php')</script>";
    exit;
}
if (isset($_GET["param"])) {
    $pagina = trim($_GET["param"]);

    //quebra uma string a partir de um caracter
    $p = explode("/", $pagina);

    //print_r($p);
    // $p[0] - nome da pagina
    // $p[1] - id do registro
    $pagina = $p[0];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Corimba Assados</title>
</head>
<body>
    <main>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">

            <!--button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Alterna navegação">
                <span class="navbar-toggler-icon"></span> DEIXAR RESPONSIVO
            </button-->
            <div class="collapse navbar-collapse container" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="home.php?fd=.&pg=relatorios">Inicio</a>
                </div>

                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="home.php?fd=.&pg=vendas">Vendas</a>
                </div>
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="home.php?fd=.&pg=categorias">Categorias</a>
                </div>
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="home.php?fd=.&pg=fornecedores">Fornecedores</a>
                </div>

                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="home.php?fd=.&pg=produtos">Produtos</a>
                </div>

                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="home.php?fd=.&pg=clientes">Clientes</a>
                </div>
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="home.php?fd=.&pg=usuarios">Usuario</a>
                </div>
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="home.php?fd=.&pg=sair">Deslogar -></a>
                </div>
            </div>
        </nav>
        <div class="container">
            <?php
            $fd = $pg = "";
            $page = "home.php?fd=.&pg=relatorios";
            if (isset($_GET["fd"])) {
                $fd = trim($_GET["fd"]);
            }

            if (isset($_GET["pg"])) {
                $pg = trim($_GET["pg"]);
            }

            if (empty($pg)) {
                $page = "home.php?fd=.&pg=relatorios";
            } else {
                $page =  $fd . "/" . $pg . ".php";
            }
            if (file_exists($page)) {
                include $page;
            } else {
                include "pages/erro.php";
            }

            ?>
        </div>
    </main>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="./dist/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
    <script src="./dist/js/bootstrap.min.js"></script>
</body>

</html>