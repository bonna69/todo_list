<?php 
namespace App\Todolist;

use App\Todolist\Service\Database;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TaskController
{
    public function index()
    {
        // echo "page d'accueil";
        // determiner le dossier qui va contenir les fichiers twig
        $loader = new FilesystemLoader("../templates");
        // inintialiser twig
        $twig = new Environment($loader);

        // se connecter à la base de donnée
        $pdo = new Database(
            "127.0.0.1",
            "todolist",
            "3306",
            "root",
            ""
        );
        // récupérer les datas
        $tasks = $pdo->selectAll(
            "SELECT * FROM task"
        );
        // echo "<pre>" ; 
        // var_dump($tasks);
        // echo "</pre>";
        // rendre une vue
        echo $twig->render('taskpage.twig', [
            'tasks' => $tasks
        ]);
    }

    public function new(){
        // determiner le dossier qui va contenir les fichiers twig
        $loader = new FilesystemLoader("../templates");
        // inintialiser twig
        $twig = new Environment($loader);

        if ($_SERVER['REQUEST_METHOD'] === "POST"){
            // se connecter à la base de donnée
            $pdo = new Database(
                "127.0.0.1",
                "todolist",
                "3306",
                "root",
                ""
            );
            // récupérer les datas
            $pdo->query(
                "INSERT INTO task (title, status) VALUES (?,?)",
                [$_POST['title'], $_POST['status']]
            );

            // rediriger vers la liste des tâches
            header("Location: http://localhost/todo_list/public/task/");
        }

        echo $twig->render('taskNewPage.twig', []);
    }

    public function show(int $id)
    {
        // determiner le dossier qui va contenir les fichiers twig
        $loader = new FilesystemLoader("../templates");
        // inintialiser twig
        $twig = new Environment($loader);
        // rendre une vue

        // se connecter à la base de donnée
        $pdo = new Database(
            "127.0.0.1",
            "todolist",
            "3306",
            "root",
            ""
        );
        // récupérer les datas
        $task = $pdo->select(
            "SELECT * FROM task WHERE id = " . $id
        );

        // echo "<pre>" ; 
        // var_dump($task);
        // echo "</pre>";
        
        echo $twig->render('taskDetailPage.twig', [
            'task' => $task
        ]);
    }
}