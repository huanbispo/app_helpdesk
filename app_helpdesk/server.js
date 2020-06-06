console.log("Servidor JS");

// usando express
var express = require("express");

// criando a instancia express
var app = express();

//adicionando os Headers
app.use(function (request, result, next){
	result.setHeader("Access-Control-Allow-Origin", "*");
	next();
});

//usar http com a instancia do express
var http = require("http").createServer(app);

//cria o socket e instancia com o http
var io = require("socket.io")(http);

// usa o mySql
var mysql = require("mysql");

// cria a conexao
var connection = mysql.createConnection({
	host: "localhost",
	user: "root",
	password: "",
	database: "helpdesk"
});

connection.connect(function (error) {
	// mostra caso tiver algum erro
});

// adiciona o listener para nova conexao
io.on("connection", function (socket) {
	// este e o sockete para cada usuario
	console.log("User connected", socket.id);
	// anexa o listener com o servidor
	socket.on("delete_message", function (messageId) {
		// deleta da DataBase
		connection.query("DELETE FROM messages WHERE id = '" + messageId + "'", function (error, result){
			// envia o comentario para todos os usuarios
			io.emit("delete_message", messageId);
		});
	});
  // o servidor deve ouvir cada cliente via Socket
  socket.on("new_message", function (data) {
	  console.log("Client says", data);

		//salva a mensagem no DataBase
		connection.query("INSERT INTO messages (message) VALUES('" + data +"')", function(error, result){
			//retorna o novo id da mensagem

			//server ira enviar a mensagem para todos os clientes conectados
			//envia a mesma mensagem de volta para todos os cleintes
	    io.emit("new_message", {
				id: result.insertId,
				message: data
			});
		});
  });
});

//cria a API para get_message
app.get("/get_messages", function (request, result){
	connection.query("SELECT * FROM messages", function (error, messages){
		//retorna os dados em formato JSON
		result.end(JSON.stringify(messages));
	});
});

app.get("/", function(request, result){
  result.send("Hello World");
});

//inicia o servidor
var port = 5000;
http.listen(port, function () {
	console.log("Listening to port " + port);
});
