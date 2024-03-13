<?php 
namespace App\Todolist\Controller;

use App\Todolist\Repository\TaskRepository;
use App\Todolist\Service\Database;


class TaskController
{
    public function index()
    {
        

        $taskRepository = new TaskRepository();
        $tasks = $taskRepository->index();
        // echo "<pre>" ; 
        // var_dump($tasks);
        // echo "</pre>";
        // rendre une vue
        
    }

    public function new(){
        // determiner le dossier qui va contenir les fichiers twig
        $loader = new FilesystemLoader("../templates");
        // inintialiser twig
        $twig = new Environment($loader);

        if ($_SERVER['REQUEST_METHOD'] === "POST"){
            $taskrepository = new TaskRepository();
            $taskrepository->add();

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

        $taskRepository = new TaskRepository();
        $task = $taskRepository->find($id);       
        
        echo $twig->render('taskDetailPage.twig', [
            'task' => $task
        ]);
    }
    
    public function delete(int $id)
    {
        $taskRepository = new TaskRepository();
        $taskRepository->remove($id);

        // rediriger vers la liste des tâches
        header("Location: http://localhost/todo_list/public/task/");
    }

    public function update(int $id)
    {
        // determiner le dossier qui va contenir les fichiers twig
        $loader = new FilesystemLoader("../templates");
        // inintialiser twig
        $twig = new Environment($loader);
        // se connecter à la base de donnée
        $taskRepository = new TaskRepository();
        $task = $taskRepository->find($id);

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            // récupérer les datas
            $title = $_POST['title'];
            $status = $_POST['status'];
            $taskRepository->update($id, $title, $status);

            // rediriger vers la liste des tâches
            header("Location: http://localhost/todo_list/public/task/");
        }

        echo $twig->render('taskUpdatePage.twig', [
            'task' => $task,
            'optionList' => ["En attente", "terminée"]
        ]);
    }
}