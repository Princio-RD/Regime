<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin - NutriPlan</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <main class="auth">
        <section class="auth-card fade-in">
            <h2 class="auth-title">NutriPlan Admin</h2>
            <p class="auth-sub">Accédez au back-office</p>

            <?php if (session()->getFlashdata('Error')): ?>
                <div class="alert alert-error">
                    <?= esc((string) session()->getFlashdata('Error')) ?>
                </div>
            <?php endif; ?>

            <form method="post" action="/doLoginAdmin">
                <?= csrf_field() ?>

                <div class="field">
                    <input type="email" name="email" placeholder="Email administrateur" required>
                </div>
                <div class="field">
                    <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
                </div>

                <button class="btn btn-block" type="submit">Se connecter</button>
            </form>

            <div class="text-center mt-3">
                <a class="link" href="/">Retour au site</a>
            </div>
        </section>
    </main>
</body>
</html>