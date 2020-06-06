<?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'sim') {

  $_SESSION['msg'] = 'Faça login antes de acessar as páginas.';
  header("location: /Public/index.php");

}

?>

<html>
  <head>
    <meta charset="utf-8" />
    <title>App Help Desk</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
      .card-home {
        padding: 30px 0 0 0;
        width: 100%;
        margin: 0 auto;
      }
    </style>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.dev.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src= "https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.js"></script>


  </head>

  <body>

    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="index.php">
        <img src="../logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        App Help Desk
      </a>
      <ul class="navbar-nav">
        <li>
          <a class="nav-link" href="../logoff.php">Sair</a>
        </li>
      </ul>
    </nav>

    <div class="card grey lighten-3 chat-room">
      <div class="card-body">
        <div class="row px-lg-2 px-2">
          <div class="col-md-6 col-xl-4 px-0">

            <!-- Inicio do Formulario -->
      <form onsubmit="return sendMessage();">
        <!-- Grid -->
        <div class="col-md-6 col-xl-8 pl-md-3 px-lg-auto px-0">
          <div class="chat-message">
            <ul class="list-unstyled chat">
              <li class="d-flex justify-content-between mb-4">
                <div class="chat-body white p-3 ml-2 z-depth-1">
                  <div class="header">
                    <strong class="primary-font">Chat Ambiental</strong>
                  </div>
                  <hr class="w-100">
                  <p class="mb-0" id="messages"></p>
                </div>
              </li>
                      <div class="mensagem"></div>
                      <input type="text" name="username" id="message" placeholder="<?php echo $_SESSION['usuario']; ?>: ">
                      <button type="submit" class="btn btn-primary btn-md">Enviar</button>
            </ul>
          </div>
        </div>
      </div>
    </div>


      </form>


      <script type="text/javascript">
        var server = "http://localhost:5000"
        var io = io(server);

        function sendMessage() {
        	// pega a Mensagem
        	var message = document.getElementById("message");
        	// Enviando a mensagem pelo cliente
        	io.emit("new_message", message.value);
        }

        $.ajax({
        	url: server + "/get_messages",
        	method: "GET",
        	success: function (response) {
        		console.log(response);

        		var messages = document.getElementById("messages");

            //analisa o JSON para objeto javascript
        		var data = JSON.parse(response);
        		for (var a = 0; a < data.length; a++) {
        			// cria um novo elemento DOM
        			var li = document.createElement("li");
              //git id unico
              li.id = "message-" + data[a].id;
              //adiciona conteudo da mensagem como HTML
              li.innerHTML = data[a].message;
              //adiciona botao delete
              //li.innerHTML += "<button data-id='" + data[a].id + "' onclick='deleteMessage(this);' >Delete</button>";
              //acrescenta no fim da lista
        			messages.appendChild(li);
        		}
        	}
        });

        // CLiente ira ouvir do servidor
        io.on("new_message", function (data) {
          console.log("Server says", data);
          //Mostra as mensagens
          var li = document.createElement("li");
          li.id = "message-" + data.id;
          li.innerHTML = data;
          //li.innerHTML += "<button data-id='" + data.id + "' onclick='deleteMessage(this);'>Delete</button>";
          var messages = document.getElementById("messages");
          messages.appendChild(li);
        });
      </script>


  </body>
</html>
