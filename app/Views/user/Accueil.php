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

                    <a class="logout" href="/logout" aria-label="Déconnexion">
                        Déconnexion
                    </a>
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

                <div class="kpis">
                    <div class="kpi">
                        <p class="label">Votre IMC</p>
                        <p class="value"><?= esc($imcValue) ?></p>
                        <p class="sub">Indice de masse corporelle</p>
                    </div>
                    <div class="kpi">
                        <p class="label">Poids actuel</p>
                        <p class="value"><?= esc($poidsValue) ?><?= $poidsValue !== '--' ? ' kg' : '' ?></p>
                        <p class="sub">Dernière mesure</p>
                    </div>
                    <div class="kpi">
                        <p class="label">Porte-monnaie</p>
                        <p class="value"><?= esc($soldeValue) ?> Ar</p>
                        <p class="sub">Crédit disponible</p>
                    </div>
                </div>

                <div class="actions">
                    <a class="action" href="/profil">
                        <span>
                            <p class="title">Mon Profil</p>
                            <p class="desc">Compléter les infos</p>
                        </span>
                    </a>

                    <a class="action" href="/objectif">
                        <span>
                            <p class="title">Mes Objectifs</p>
                            <p class="desc">Définir mon plan</p>
                        </span>
                    </a>

                    <a class="action" href="/porte-monnaie">
                        <span>
                            <p class="title">Porte-monnaie</p>
                            <p class="desc">Recharger mon compte</p>
                        </span>
                    </a>

                    <a class="cta" href="/gold">
                        <span>
                            <p class="cta-title">Passer Gold</p>
                            <p class="cta-sub">-15% sur tout</p>
                        </span>
                        <span style="font-weight:800;">›</span>
                    </a>
                </div>

            </section>
        </div>
    </div>
</body>
</html>