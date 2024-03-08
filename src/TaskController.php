<?php 
namespace App\Todolist;

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
        // rendre une vue
        $tasks = [
            [
                "id" => 23,
                "title" => "faire les courses"
            ],
            [
                "id" => 45,
                "title" => "finir le projet"
            ],
            [
                "id" => 56,
                "title" => "aller au sport"
            ]
        ];
        echo $twig->render('taskpage.twig', [
            'tasks' => $tasks
        ]);
    }
    public function show(int $id)
    {
        // determiner le dossier qui va contenir les fichiers twig
        $loader = new FilesystemLoader("../templates");
        // inintialiser twig
        $twig = new Environment($loader);
        // rendre une vue
        
        echo $twig->render('taskDetailPage.twig', [
            'taskId' => $id
        ]);
    }
}