<?php

namespace App\src\controller;
use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;
use App\src\model\View;

class FrontController
{
    private $articleDAO;
    private $commentDAO;
    private $View;

    public function __construct()
    {
        $this->articleDAO = new ArticleDAO();
        $this->commentDAO = new CommentDAO();
        $this->view = new View();
    }

    public function home()
    {
        /* $articles = $this->articleDAO->getArticles();
         require '../templates/home.php';*/
        $articles = $this->articleDAO->getArticles();
        return $this->view->render('home', [
            'articles' => $articles
        ]);

    }

    public function article($articleId)
    {
        $article = $this->articleDAO->getArticle($articleId);
        $comments = $this->commentDAO->getCommentsFromArticle($articleId);
//        require '../templates/single.php';
        return $this->view->render('single', [
            'article' => $article,
            'comments' => $comments
        ]);

    }
    // La méthode addComment à ajouter
    public function addComment($articleId, $pseudo, $content) {
        if (!$this->validateCommentData($articleId, $pseudo, $content)) {
            $this->errorController->errorNotFound();
            return;
        }

        $this->commentDAO->addComment($articleId, $pseudo, $content);
        header('Location: index.php?route=article&articleId=' . $articleId);
        exit;
    }

    // Exemple validation
    private function validateCommentData($articleId, $pseudo, $content) {
        return !empty($pseudo) && !empty($content) && !empty($articleId) && $_SERVER['REQUEST_METHOD'] === 'POST';
    }

}
