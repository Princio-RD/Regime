<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - NutriPlan</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <main class="auth">
        <section class="auth-card fade-in">
            <h2 class="auth-title">NutriPlan</h2>
            <p class="auth-sub">Connectez-vous pour continuer votre parcours santé</p>

            <?php if (session()->getFlashdata('Error')): ?>
                <div class="alert alert-error">
                    <?= esc((string) session()->getFlashdata('Error')) ?>
                </div>
            <?php endif; ?>

            <form method="post" action="/login">
                <?= csrf_field() ?>

                <div class="field">
                    <input type="email" name="email" placeholder="Adresse email" required>
                </div>
                <div class="field">
                    <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
                </div>

                <button class="btn btn-block" type="submit">Se connecter</button>
            </form>

            <div class="text-center mt-3">
                <a class="link" href="/register">Créer un compte</a>
            </div>
            <div class="text-center mt-2">
                <a class="link" href="/viewLoginAdmin">Accès Administrateur</a>
            </div>
        </section>
    </main>
</body>
</html>