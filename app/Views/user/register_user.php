<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - NutriPlan</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <main class="auth">
        <section class="auth-card fade-in">
            <h2 class="auth-title">Créer un compte</h2>
            <p class="auth-sub">Renseignez vos informations pour commencer</p>

            <?php if (session()->getFlashdata('Error')): ?>
                <div class="alert alert-error">
                    <?= session()->getFlashdata('Error') ?>
                </div>
            <?php endif; ?>

            <form method="post" action="/save-user">
                <?= csrf_field() ?>

                <div class="field">
                    <input type="text" name="nom" placeholder="Nom complet" required>
                </div>
                <div class="field">
                    <input type="text" name="prenom" placeholder="Prénom">
                </div>
                <div class="field">
                    <input type="email" name="email" placeholder="Adresse email" required>
                </div>
                <div class="field">
                    <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
                </div>
                <div class="field">
                    <input type="date" id="date_naissance" name="date_naissance" required>
                </div>
                <div class="field">
                    <select name="genre" required>
                        <option value="">Sélectionner le genre</option>
                        <option value="Homme">Homme</option>
                        <option value="Femme">Femme</option>
                    </select>
                </div>

                <button class="btn btn-block" type="submit">Suivant</button>
            </form>

            <div class="text-center mt-3">
                <a class="link" href="/">Déjà un compte ? Se connecter</a>
            </div>
        </section>
    </main>
</body>
</html>