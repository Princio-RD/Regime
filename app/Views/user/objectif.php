<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choisir un objectif - NutriPlan</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="page">
        <div class="shell">
            <section class="hero fade-in">
                <div class="topbar">
                    <div class="welcome">
                        <h1>Choisir votre objectif</h1>
                        <p>Sélectionnez l'objectif qui correspond à votre parcours</p>
                    </div>
                    <a class="logout" href="/logout">Déconnexion</a>
                </div>

                <?php if (isset($objectifs) && !empty($objectifs)): ?>
                    <div class="objectif-list">
                        <?php foreach($objectifs as $obj): ?>
                            <a class="objectif-item" href="/objectifs/<?= esc($obj['id']) ?>">
                                <h3><?= esc($obj['nom']) ?></h3>
                                <?php if (!empty($obj['description'])): ?>
                                    <p><?= esc($obj['description']) ?></p>
                                <?php endif; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="card text-center mt-4">
                        <p>Aucun objectif disponible pour le moment.</p>
                    </div>
                <?php endif; ?>

                <p class="mt-4">
                    <a class="link" href="/Accueil">Retour au tableau de bord</a>
                </p>
            </section>
        </div>
    </div>
</body>
</html>