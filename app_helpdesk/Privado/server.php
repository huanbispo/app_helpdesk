<?php

session_start();

// Iniciando variaveis
$usuario = "";
$errors = array();

// método de Conexão com o Banco de dados
// localhost:
// root = Nome do Utilizador ( mySQL )
// "" = Senha do utilizador ( no caso, vazia )
// helpdesk = Base de Dados
$db = mysqli_connect("localhost", "root", "", "helpdesk") or die($db);

// Registro de Usuario
if (isset($_POST['registro_usuario'])) {

//Registrando usuarios
$usuario = $_POST['usuario'];
$senha_1 = $_POST['senha_1'];
$senha_2 = $_POST['senha_2'];

// Validação Formulario
if(empty($usuario)) {array_push($errors, "Usuario é requisitado");}
if(empty($senha_1)) {array_push($errors, "Senha é requisitada");}
if($senha_1 != $senha_2) {array_push($erros, "Ambas senhas devem ser iguais");}

// Check no BD se já existe um usuario com o mesmo nome
$user_check = "SELECT * FROM tb_usuario WHERE login = '$usuario' LIMIT 1";
$resultado = mysqli_query($db, $user_check);


// Verifica se há algum erro em mysqli
if (!$resultado) {
    echo 'Error: ' .mysqli_error($db);
}

$user_check = mysqli_fetch_assoc($resultado);
// Faz o check caso a variavel seja igual, faz um array push
if ($user_check) {
    if ($user_check['login'] === $usuario) {array_push($errors, "login já existe");}
    header("location: /app_helpdesk/Public/index.php");
}

// Registra o usuario se não tiver erros
if (count($errors) == 0) {
    $senha = md5($senha_1); // Encripta a senha

    // faz o INSERT no banco com os valores de usuario e senha digitados
    $query = "INSERT INTO tb_usuario ( login, senha ) VALUES ('$usuario', '$senha')";

    mysqli_query($db, $query);
    @$_SESSION['login'] == $usuario;
    @$_SESSION['sucesso'] == "Usuário registrado!";
    // Após fazer o registro, volta para a tela de login
    header("location: /app_helpdesk/Public/index.php");

}

}

// login Usuario
if (isset($_POST['login_usuario'])) {

    // puxando o usuario e senha
    $usuario = mysqli_real_escape_string($db, $_POST['login']);
    $senha = mysqli_real_escape_string($db, $_POST['senha']);

    // Caso usuario ou senha esteja vazio..
    // Método de Segurança
    if (empty($usuario)) {
        array_push($errors, "Usuário é obrigatório");
    }
    if (empty($senha)) {
        array_push($errors, "Senha é obrigatória");
    }

    // Caso não tenha nenhum erro, faz a autenticação do login
    if (count($errors) == 0) {
        $senha = md5($senha);

        $query = "SELECT * FROM tb_usuario WHERE login = '$usuario' AND senha = '$senha'";
        $resultado = mysqli_query($db, $query);

        if (mysqli_num_rows($resultado)) {

          $_SESSION['usuario'] = $usuario;
          $_SESSION['autenticado'] = 'sim';
          // Encaminha para a tela de Chat Ambiental
          header('location: /app_helpdesk/Public/home.php');
        }
        else {
          // Caso haja erros, falha na autenticação, volta para tela de login com o respectivo erro
          $_SESSION['autenticado'] = 'não';
          header('location: /app_helpdesk/Public/index.php?login=erro');
        }
    }
}


?>
