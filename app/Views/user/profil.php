<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - NutriPlan</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="page">
        <div class="shell">
            <section class="hero fade-in">
                <div class="topbar">
                    <div class="welcome">
                        <h1>Complétion du profil</h1>
                    </div>
                    <a class="logout" href="/logout">Déconnexion</a>
                </div>

                <div class="kpis">
                    <div class="kpi">
                        <h2>Informations personnelles</h2>
                        <p class="label">Nom:</p>
                        <p class="value"><?= esc($user['nom'] ?? '') ?></p>
                    </div>

                    <div class="kpi">
                        <p class="label">Email:</p>
                        <p class="value"><?= esc($user['email'] ?? '') ?></p>
                    </div>

                    <div class="kpi">
                        <p class="label">Genre:</p>
                        <p class="value"><?= esc($user['genre'] ?? '') ?></p>
                    </div>

                    <div class="kpi">
                        <p class="label">Date de naissance:</p>
                        <p class="value"><?= esc($user['date_de_naissance'] ?? '') ?></p>
                    </div>
                </div>
            </section>

            <section class="card update-account mt-4">
                <h2>Mise à jour des informations du compte</h2>
                
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="flash-message flash-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="flash-message flash-error">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form action="/update-account" method="post">
                    <?= csrf_field() ?>
                    <div class="field">
                        <label>Nom complet :</label>
                        <input type="text" name="nom" value="<?= esc($user['nom'] ?? '') ?>" required>
                    </div>
                    <div class="field">
                        <label>Email :</label>
                        <input type="email" name="email" value="<?= esc($user['email'] ?? '') ?>" required>
                    </div>
                    <div class="field">
                        <label>Date de naissance:</label>
                        <input type="date" name="date_de_naissance" value="<?= esc($user['date_de_naissance'] ?? '') ?>" required>
                    </div>
                    <div class="field">
                        <label>Nouveau mot de passe (laisser vide pour ne pas changer) :</label>
                        <input type="password" name="mot_de_passe" placeholder="Nouveau mot de passe">
                    </div>
                    <button type="submit" class="btn">Mettre à jour mon compte</button>
                </form>
            </section>

            <section class="card update-health mt-4">
                <h2>Mise à jour des données de santé</h2>
                
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="flash-message flash-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="flash-message flash-error">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <div class="current-status mb-3">
                    <p>Votre IMC actuel : <strong><?= $imc ?? '--' ?></strong></p>
                </div>

                <form action="/update-profil" method="post">
                    <?= csrf_field() ?>
                    <div class="field">
                        <label>Poids (kg) :</label>
                        <input type="number" step="0.1" name="poids" value="<?= esc($sante['poids'] ?? '') ?>" required>
                    </div>
                    <div class="field">
                        <label>Taille (cm) :</label>
                        <input type="number" step="0.1" name="taille" value="<?= esc($sante['taille'] ?? '') ?>" required>
                    </div>
                    <button type="submit" class="btn">Mettre à jour mon IMC</button>
                </form>
            </section>

            <p class="mt-4">
                <a class="link" href="/Accueil">Retour à l'accueil</a>
            </p>
        </div>
    </div>
</body>
</html>