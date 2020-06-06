
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
              Cadastro
            </div>
            <div class="card-body">

            <!-- Inicio do Formulario -->
            <form action="server.php" method="POST">

                <div class="form-group">
                  <input name="usuario" type="login" class="form-control" placeholder="Usuário" required>
                </div>
                <div class="form-group">
                  <input name="senha_1" type="password" class="form-control" placeholder="Senha" required>
                </div>

                <div class="form-group">
                  <input name="senha_2" type="password" class="form-control" placeholder="Confirmar Senha" required>
                </div>
                
                <!-- Botão Submit do registro_usuario -->
                <button class="btn btn-lg btn-info btn-block" name="registro_usuario" type="submit">Criar Conta</button>


              </form> <!-- Fim do Formulario -->

            </div>
          </div>
        </div>
    </div>
  </body>
</html>
