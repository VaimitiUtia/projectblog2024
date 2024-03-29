<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Mon blog</title>
</head>
<body>
<div>
    <h1>Mon blog</h1>
    <div>
        <h2><?= htmlspecialchars($article->getTitle()); ?></h2>
        <p><?= htmlspecialchars($article->getContent()); ?></p>
        <p><?= htmlspecialchars($article->getAuthor()); ?></p>
        <p>Créé le : <?= htmlspecialchars($article->getCreatedAt()); ?></p>
    </div>
    <br>
    <div id="comments" class="text-left" style="margin-left: 50px">
        <h3>Commentaires</h3>
        <?php
        foreach ($comments as $comment) {
            ?>
            <h4><?= htmlspecialchars($comment->getPseudo()); ?></h4>
            <p><?= htmlspecialchars($comment->getContent()); ?></p>
            <p>Posté le <?= htmlspecialchars($comment->getCreatedAt()); ?></p>
            <?php
        }
        ?>
    </div>
    <!-- Formulaire de commentaire -->
        <h2>Ajouter un commentaire</h2>

        <form action="index.php?route=addComment&articleId=<?= $article->getId(); ?>" method="POST">

            <label for="pseudo">Pseudo:</label><br>
            <input type="text" id="pseudo" name="pseudo" required><br>

            <label for="commentaire">Commentaire:</label><br>
            <textarea id="commentaire" name="content" rows="4" aria-required="true"></textarea><br>

            <input type="submit" value="Soumettre">
        </form>

    <br>
    <a href="../public/index.php">Retour à l'accueil</a>
</div>
</body>
</html>
