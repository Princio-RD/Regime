<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infos santé - NutriPlan</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <main class="auth">
        <section class="auth-card fade-in">
            <h2 class="auth-title">Infos santé</h2>
            <p class="auth-sub">Dernière étape avant d'accéder au tableau de bord</p>

            <?php if (session()->getFlashdata('Error')): ?>
                <div class="alert alert-error">
                    <?= session()->getFlashdata('Error') ?>
                </div>
            <?php endif; ?>

            <form method="post" action="/save-sante">
                <?= csrf_field() ?>

                <div class="field">
                    <input type="number" name="taille" placeholder="Taille (cm)" required>
                </div>
                <div class="field">
                    <input type="number" name="poids" placeholder="Poids (kg)" required>
                </div>

                <button class="btn btn-block" type="submit">Terminer</button>
            </form>
        </section>
    </main>
</body>
</html>