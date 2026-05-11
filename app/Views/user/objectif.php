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
                        <p class="muted">Dites-nous ce que vous voulez atteindre, on vous proposera les régimes adaptés.</p>
                    </div>
                    <div class="topbar-actions">
                        <a class="btn btn-ghost" href="/Accueil">Tableau de bord</a>
                        <a class="logout" href="/logout">Déconnexion</a>
                    </div>
                </div>

                <?php if (isset($objectifs) && !empty($objectifs)): ?>
                    <div class="goal-grid">
                        <?php foreach($objectifs as $obj): ?>
                            <?php
                                $oid = (int)($obj['id'] ?? 0);
                                $icon = '🎯';
                                if ($oid === 1) $icon = '📈';
                                if ($oid === 2) $icon = '📉';
                                if ($oid === 3) $icon = '⚖️';
                            ?>
                            <a class="goal-card" href="/objectifs/<?= esc($obj['id']) ?>">
                                <div class="goal-icon" aria-hidden="true"><?= $icon ?></div>
                                <div class="goal-body">
                                    <h3><?= esc($obj['nom']) ?></h3>
                                    <?php if (!empty($obj['description'])): ?>
                                        <p class="muted"><?= esc($obj['description']) ?></p>
                                    <?php else: ?>
                                        <p class="muted">Voir les régimes recommandés pour cet objectif.</p>
                                    <?php endif; ?>
                                    <div class="goal-cta">
                                        <span>Choisir cet objectif</span>
                                        <span aria-hidden="true">→</span>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="card text-center mt-4">
                        <p class="muted">Aucun objectif disponible pour le moment.</p>
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