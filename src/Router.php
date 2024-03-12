<?php 
namespace App\Todolist;

use App\Todolist\Controller\HomeController;
use App\Todolist\Controller\TaskController;



class Router 
{
    public function index()
    {
        // Récupérer l'URL demandée
        $url = $_SERVER['REQUEST_URI'];
        // Trouver le controller et la méthode correspondante
        if ($url === "/todo_list/public/") {
            // Instancier le contrôleur et appeler la méthode
            $controller = new HomeController();
            $controller->index();
        }
        if ($url === "/todo_list/public/task/new") {
            // Instancier le contrôleur et appeler la méthode
            $controller = new TaskController();
            $controller->new();
        }
        if ($url === "/todo_list/public/task/") {
            // Instancier le contrôleur et appeler la méthode
            $controller = new TaskController();
            $controller->index();
        }
        $parts = explode('/', $url);
        if (array_key_exists(4, $parts) && !array_key_exists(5, $parts) && $parts[4] !== "" && (int)$parts[4] && $parts[3] === "task") {
            // Instancier le contrôleur et appeler la méthode
            $controller = new TaskController();
            $controller->show((int)$parts[4]);
        }
        if (array_key_exists(5, $parts) && $parts[5] === "delete" && $parts[4] !== "new" && $parts[3] === "task") {
            // Instancier le contrôleur et appeler la méthode
            $controller = new TaskController();
            $controller->delete((int)$parts[4]);
        }
        if (array_key_exists(5, $parts) && $parts[5] === "update" && $parts[4] !== "new" && $parts[3] === "task") {
            // Instancier le contrôleur et appeler la méthode
            $controller = new TaskController();
            $controller->update((int)$parts[4]);
        }
        // Gérer les erreurs (par exemple, afficher une page 404)
    }
}