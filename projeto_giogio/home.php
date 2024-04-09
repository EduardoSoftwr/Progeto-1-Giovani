<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}


$nomeUsuario = $_SESSION['usuario']['nome'];

if (isset($_POST['sair'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

$usuarioAdministrador = isset($_SESSION['usuario']['tipo']) && $_SESSION['usuario']['tipo'] === 'administrador';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Home</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/comentarios.css">

    <script src="jquery.js"></script>
    <script src="comentario.controller.js"></script>
    <style>
        ul{
            width: 1680px;
            display:flex;
            align-items: center;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <header id="header">
        <div class="container">
            <div class="flex">
                <nav>
                    <ul>
                        <li>
                            <?php if ($usuarioAdministrador): ?>
                                <a href="cadastro.produtos.php">Adicionar Produtos</a>
                            <?php endif; ?>
                        </li>
                        <li><a href="produtos.php" class="sair">Produtos</a>
                        <li><a href="perfil.php" class="sair">Perfil</a>
                        <li>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> " method="POST">
                        <li><button type="submit" class="btn-sair button" name="sair" value="Sair">Sair</button>
                        <li>
                            </form>
                    </ul>

                </nav>


            </div>

        </div>

    </header>
    <section class="banner">
        <h1>UM NOVO CONCEITO DE <span>CONVÊNIENCIA</span></h1>
    </section>
    <script src="menu.js"></script>

    <div class="container">
        <div class="flex-container">
            <div class="mapBox">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14459.338068173274!2d-51.5432877!3d-25.0396894!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94eed9c96bf0319d%3A0xfeae96e672d90343!2sPonto%20Conv%C3%AA!5e0!3m2!1spt-BR!2sbr!4v1712444614331!5m2!1spt-BR!2sbr"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="content">

                <h1>Onde Estamos?</h1>

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem hic, doloremque ducimus culpa
                    laborum sapiente voluptatum asperiores quod ea eaque assumenda esse! Deserunt labore dolor illum
                    provident, architecto itaque libero.
                </p>
                <h3>Quem Somos</h3>
                <p>
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolores ad quo obcaecati consectetur
                    provident quia aliquid deserunt, reprehenderit in esse harum excepturi iusto explicabo labore!
                    Doloremque fugiat cumque esse nesciunt.
                </p>
                <h4>Nossa Politica</h4>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi deleniti, ipsa architecto ratione
                    vero nulla sint modi veniam possimus asperiores facilis repudiandae perspiciatis magnam. Obcaecati
                    cum odit sapiente ut harum!
                </p>

            </div>
        </div>
    </div>
    </div>
    </div>

    <section class="content">
        <div class="box-form">
            <div class="comment-header">
            <h1>Comentários:</h1>
            <form id="formularioComentario" class="comment-body">
                <textarea id="textoComentario" placeholder="Digite seu comentário" style="width: 100%; height: 100px;"></textarea><br>
                <button type="button" class="btn-sub" id="enviarComentario">Enviar</button>
            </form>
        </div>
        <br><br>
        <div id="comentarios" class="comment-body"></div>
        <br>
    </section>
        
</body>

</html>