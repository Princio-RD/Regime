<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - NutriPlan</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <?php
        $userName = (string) (($user['nom'] ?? '') ?: 'Utilisateur');
        $niveau = (isset($user['is_gold']) && $user['is_gold'] == 1) ? 'Membre Gold <span class="gold-badge">Gold</span>' : 'Membre Standard';

        $imcValue = isset($imc) && $imc !== null ? (string) $imc : '--';
        $poidsValue = isset($sante['poids']) && $sante['poids'] !== null ? (string) $sante['poids'] : '--';

        $soldeValue = number_format($user['porte_monnaie'] ?? 0, 0, ',', ' ');
    ?>

    <div class="page">
        <div class="shell">
            <section class="hero fade-in">

                <div class="topbar">
                    <div class="welcome">
                        <h1>Bienvenue, <span><?= esc($userName ?: 'Utilisateur') ?></span> !</h1>
                        <p><?= $niveau ?></p>
                    </div>

                    <a class="logout" href="/logout" aria-label="Déconnexion">Déconnexion</a>
                </div>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="flash-message flash-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('Error')): ?>
                    <div class="flash-message flash-error">
                        <?= session()->getFlashdata('Error') ?>
                    </div>
                <?php endif; ?>

                <div class="dash-hero">
                    <div class="dash-hero-card">
                        <h2>Votre menu santé du jour</h2>
                        <p>
                            Suivez vos indicateurs, choisissez votre objectif et lancez un programme comme dans un
                            restaurant : simple, clair, et prêt à servir.
                        </p>
                        <div class="dash-hero-actions">
                            <a class="btn" href="/objectif">Choisir un programme</a>
                            <a class="btn btn-secondary" href="/profil">Compléter mon profil</a>
                        </div>
                    </div>

                    <div class="dash-hero-media" aria-hidden="true">
                        <img src="/assets/img/1.jpg" alt="Illustration repas sain">
                    </div>
                </div>

                <h3 class="section-title">Vos indicateurs</h3>
                <div class="cards-grid">
                    <div class="card-soft">
                        <div class="card-title">IMC</div>
                        <div class="card-desc">Indice de masse corporelle</div>
                        <div style="font-size: 2rem; font-weight: 900; color: var(--primary); margin-top: 0.25rem;">
                            <?= esc($imcValue) ?>
                        </div>
                    </div>

                    <div class="card-soft">
                        <div class="card-title">Poids actuel</div>
                        <div class="card-desc">Dernière mesure</div>
                        <div style="font-size: 2rem; font-weight: 900; color: var(--primary); margin-top: 0.25rem;">
                            <?= esc($poidsValue) ?><?= $poidsValue !== '--' ? ' kg' : '' ?>
                        </div>
                    </div>

                    <div class="card-soft">
                        <div class="card-title">Porte-monnaie</div>
                        <div class="card-desc">Crédit disponible</div>
                        <div style="font-size: 2rem; font-weight: 900; color: var(--primary); margin-top: 0.25rem;">
                            <?= esc($soldeValue) ?> Ar
                        </div>
                    </div>
                </div>

                <h3 class="section-title">Accès rapides</h3>
                <div class="cards-grid">
                    <a class="card-soft" href="/profil" style="text-decoration:none; color: inherit; display:block;">
                        <div class="card-title">Mon Profil</div>
                        <div class="card-desc">Compléter les infos</div>
                    </a>

                    <a class="card-soft" href="/objectif" style="text-decoration:none; color: inherit; display:block;">
                        <div class="card-title">Mes Objectifs</div>
                        <div class="card-desc">Définir mon plan</div>
                    </a>

                    <a class="card-soft" href="/porte-monnaie" style="text-decoration:none; color: inherit; display:block;">
                        <div class="card-title">Porte-monnaie</div>
                        <div class="card-desc">Recharger mon compte</div>
                    </a>

                    <a class="card-soft" href="/gold" style="text-decoration:none; color: inherit; display:block;">
                        <div class="card-title">Passer Gold</div>
                        <div class="card-desc">-15% sur tout</div>
                    </a>
                </div>

            </section>
        </div>
    </div>
</body>
</html>