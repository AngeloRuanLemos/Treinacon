<?php

require_once 'Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    $confirmar_senha = $_POST["confirmar"];
    $email = $_POST["email"];
    $nome = $_POST["nome"];
    $id = $_POST["id"];

    $conn = Database::getConnection();

    if($senha == $confirmar_senha){
        $stmt = $conn->prepare("UPDATE usuarios SET usuario = :usuario, senha = :senha, email = :email, nome = :nome WHERE id = :id");
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        header('Location: http://localhost:8000/application/listar?msg=2');
    } else {
        header('Location: http://localhost:8000/application/listar?msg=4');
    }
} else {
    header("Location: index.html");
    exit();
}
?>