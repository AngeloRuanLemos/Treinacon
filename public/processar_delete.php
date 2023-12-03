<?php

require_once 'Database.php';

if(isset($_GET['id'])) {
    $conn = Database::getConnection();

    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    echo "Usuário excluído com sucesso";
    header('Location: http://localhost:8000/application/listar?msg=3');
} else {
    header("Location: index.html");
    exit();
}
?>