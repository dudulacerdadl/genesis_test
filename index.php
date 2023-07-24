<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficticio Commerce</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/burger-button.css">
    <link rel="stylesheet" href="css/cards.css">
    <link rel="stylesheet" href="css/forms.css">
    <link rel="shortcut icon" href="utils/images/logo.png" type="image/x-icon">
</head>

<body>
    <header>
        <div class="header-container">
            <a href="/"><img src="utils/images/logo.png" alt="Logo" class="logo"></a>
            <img src="utils/images/icons/burger-menu.png" alt="" class="burger-button">
        </div>

        <nav class="top-nav">
            <ul>
                <li><a href="/">Início</a></li>
                <li><a href="/user/login.html">Usuário</a></li>
                <li><a href="/admin/login.html">Admin</a></li>
            </ul>
        </nav>
    </header>
    <div class="mask"></div>
    <div class="principal">
        <h1>Bem vindo à Ficticio Commerce!</h1>
        <ul class="product-list">
            <?php

            include 'utils/env.php';

            $mysqli = new mysqli(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_NAME'));

            $sql = 'SELECT * FROM products';
            $result = mysqli_query($mysqli, $sql);
            $products = mysqli_fetch_all($result);

            // Exibe os produtos na tela
            foreach ($products as $product) {
            echo '<li class="product-card">
                <a href="/#article1">
                    <div class="image-container">
                        <img src="'. $product[4] .'" class="product-img">
                    </div>
                    <p class="product-title">' . $product[1] . '</p>
                </a>
            </li>';
            }

            ?>
        </ul>
    </div>
    <footer>
        <p>Ficticio Commerce ®</p>
        <p>Site produzido por Eduardo Lacerda</p>
        <ul class="redes-sociais">
            <li>
                <a href="https://www.linkedin.com/in/dudulacerda/" target="_blank" rel="noopener noreferrer"><img src="utils/images/icons/icon-linkedin.png" alt=""></a>
            </li>
            <li>
                <a href="https://www.instagram.com/dudulacerdadl/" target="_blank" rel="noopener noreferrer"><img src="utils/images/icons/icon-instagram.png" alt=""></a>
            </li>
            <li>
                <a href="https://github.com/dudulacerdadl/" target="_blank" rel="noopener noreferrer"><img src="utils/images/icons/icon-github.png" alt=""></a>
            </li>
        </ul>
    </footer>

    <script type="module" src="js/router.js"></script>
    <script type="module" src="js/routes.js"></script>
    <script src="js/main.js"></script>
</body>

</html>