<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficticio Commerce - Admin</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/burger-button.css">
    <link rel="stylesheet" href="../css/forms.css">
    <link rel="shortcut icon" href="../utils/images/logo.png" type="image/x-icon">
</head>

<body>
    <?php include '../utils/header.html'; ?>
    <section class="session_login">
        <div class="login_user">
            <h1>Cadastro</h1>
            <br />
            <form class="form" action="../controller/cadastro.php" method="POST">
                <fieldset class="form-container">
                    <label class="form-label">
                        Nome:
                        <input type="text" name="name" id="name" placeholder="Digite seu nome">
                    </label>
                    <br>
                    <label class="form-label">
                        Telefone:
                        <input type="tel" name="cell" id="cell" placeholder="Digite seu telefone">
                    </label>
                    <br>
                    <label class="form-label">
                        E-mail:
                        <input type="email" name="email" id="email" placeholder="Digite seu e-mail">
                    </label>
                    <br>
                    <label class="form-label">
                        Senha:
                        <input type="password" name="password" id="password" required placeholder="Digite sua senha">
                    </label>
                    <br>
                    <br>
                    <div class="btn-div">
                        <input type="submit" value="Cadastrar" class="btn">
                        <a class="btn" href="login.php">Login</a>
                    </div>
                </fieldset>
            </form>
        </div>
    </section>
    <?php include '../utils/footer.html'; ?>
</body>
</html>