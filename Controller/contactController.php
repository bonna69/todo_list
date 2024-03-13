<?php

namespace App\Todolist;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ContactController
{

public function index()
{
    // determiner le dossier qui va contenir les fichiers twig
    $loader = new FilesystemLoader("../templates");
    // Initialiser twig
    $twig = new Environment($loader);
    // rendre une vue
    $data=[
        'title'=>"Page de contact"
    ];
    echo $twig->render('contact.twig',$data);
    
}
}