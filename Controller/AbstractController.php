<?php
namespace App\Todolist\Controller;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
class AbstractController


abstract class AbstractController{
    protected function render(string $template, array $data )
    {

// echo "page d'accueil";
        // determiner le dossier qui va contenir les fichiers twig
        $loader = new FilesystemLoader("../templates");
        // inintialiser twig
        $twig = new Environment($loader);
        $this->render('taskpage.twig', [
            'tasks' => $tasks
        ]);
    }

}