<?php

require_once 'Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    $confirmar_senha = $_POST["confirmar"];
    $email = $_POST["email"];
    $nome = $_POST["nome"];

    $conn = Database::getConnection();

    if($senha == $confirmar_senha){
        $senha = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO usuarios (usuario, senha, email, nome) VALUES (:usuario, :senha, :email, :nome)");
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':nome', $nome);

        $stmt->execute();
        header('Location: http://localhost:8000/application/listar?msg=1');
    } else {
        header('Location: http://localhost:8000/application/listar?msg=4');
    }
} else {
    header("Location: index.html");
    exit();
}
?>