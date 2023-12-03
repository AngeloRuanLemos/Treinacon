<?php

declare(strict_types=1);

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use PDO;

class IndexController extends AbstractActionController
{
    private function conectarBanco()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "treinacon";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (\PDOException $e) {
            // Lidar com erros de conexão aqui
            return null;
        }
    }

    public function indexAction()
    {
        return new ViewModel();
    }

    public function cadastroAction()
    {
        return new ViewModel();
    }

    public function listarAction()
    {   
        $conn = $this->conectarBanco();

        if ($conn !== null) {
            try {
                $stmt = $conn->prepare("SELECT * FROM usuarios");
                $stmt->execute();
                $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return new ViewModel(['usuarios' => $usuarios]);
            } catch (\PDOException $e) {
                return new ViewModel(['error' => $e->getMessage()]);
            } finally {
                $conn = null;
            }
        }
    }

    public function editarAction()
    {
        $id = 0;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        $conn = $this->conectarBanco();

        if ($conn !== null) {
            try {
                $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $dados = $stmt->fetch(PDO::FETCH_ASSOC);
                return new ViewModel(['dados' => $dados]);
            } catch (\PDOException $e) {
                return new ViewModel(['error' => $e->getMessage()]);
            } finally {
                $conn = null; // Fechar a conexão no final
            }
        }
    }
}
?>
