<?php
/**
 * Created by PhpStorm.
 * User: Mireille
 * Date: 27/04/2021
 * Time: 13:56
 */

namespace App\config;
use App\src\controller\FrontController;
use App\src\controller\ErrorController;
use Exception;

class Router
{
    private $frontController;
    private $errorController;

    public function __construct()
    {
        $this->frontController = new FrontController();
        $this->errorController = new ErrorController();
    }

    public function run()
    {
        try {
            if (isset($_GET['route'])) {
                switch ($_GET['route']) {
                    case 'article':
                        // Afficher un article spécifique
                        if (isset($_GET['articleId'])) {
                            $this->frontController->article($_GET['articleId']);
                        } else {
                            $this->errorController->errorNotFound();
                        }
                        break;

                    case 'addComment':
                        // Ajouter un commentaire si la méthode est POST
                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['pseudo']) && !empty($_POST['content']) && !empty($_GET['articleId'])) {
                            $articleId = $_GET['articleId'];
                            $pseudo = trim($_POST['pseudo']);
                            $content = trim($_POST['content']);
                            $this->frontController->addComment($articleId, $pseudo, $content);
                        } else {
                            // Gérer l'erreur, en affichant un message d'erreur ou en renvoyant vers une page d'erreur.
                            $this->errorController->errorNotFound();
                        }
                        break;

                    default:
                        // Route non trouvée
                        $this->errorController->errorNotFound();
                        break;
                }
            } else {
                // Aucune route spécifiée, afficher la page d'accueil
                $this->frontController->home();
            }
        } catch (Exception $e) {
            // En cas d'erreur exceptionnelle, afficher une erreur serveur
            $this->errorController->errorServer();
        }
    }

}

