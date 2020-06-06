<html>
  <head>
    <meta charset="utf-8" />
    <title>App Help Desk</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
      .card-login {
        padding: 30px 0 0 0;
        width: 350px;
        margin: 0 auto;
      }
    </style>
  </head>

  <body>

    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="index.php">
        <img src="../logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        App Help Desk
      </a>
    </nav>

    <div class="container">
      <div class="row">

        <div class="card-login">
          <div class="card">
            <div class="card-header">
              Login
            </div>
            <div class="card-body">

            <!-- Inicio do Formulario -->
              <form action="server.php" method="POST">

                <div class="form-group">
                  <input name="login" type="login" class="form-control" placeholder="Login" required>
                </div>
                <div class="form-group">
                  <input name="senha" type="password" class="form-control" placeholder="Senha" required>
                </div>

                <?php if (isset($_GET["login"]) && $_GET["login"] == 'erro') { ?>

                  <div class="text-danger">
                    Usuário ou Senha inválido(s)
                  </div>
                  <br>

                <?php } ?>

                <button class="btn btn-lg btn-info btn-block" name="login_usuario" type="submit">Entrar</button>

                <p>Não tem usuário?<a href="registro.php"><b> Crie sua Conta!</b></a></p>
                <!-- Fim do Formulario -->
              </form>

            </div>
          </div>
        </div>
    </div>
  </body>
</html>
