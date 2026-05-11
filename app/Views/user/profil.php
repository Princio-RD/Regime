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
                        <h1>Mon profil</h1>
                        <p class="muted">Gérez vos informations, vos objectifs et vos régimes depuis un seul endroit.</p>
                    </div>

                    <div class="topbar-actions">
                        <a class="btn btn-ghost" href="/Accueil">Accueil</a>
                        <a class="logout" href="/logout">Déconnexion</a>
                    </div>
                </div>

                <div class="profile-head">
                    <div class="avatar" aria-hidden="true">
                        <?php
                            $name = trim((string)($user['nom'] ?? ''));
                            $initials = '';
                            if ($name !== '') {
                                $parts = preg_split('/\s+/', $name);
                                $initials = strtoupper(substr($parts[0] ?? '', 0, 1) . substr($parts[1] ?? '', 0, 1));
                            }
                        ?>
                        <span><?= esc($initials !== '' ? $initials : 'NP') ?></span>
                    </div>

                    <div class="identity">
                        <h2 class="name"><?= esc($user['nom'] ?? '') ?></h2>
                        <div class="badges">
                            <?php if (!empty($user['genre'])): ?>
                                <span class="badge"><?= esc($user['genre']) ?></span>
                            <?php endif; ?>
                            <?php if (!empty($user['date_de_naissance'])): ?>
                                <span class="badge badge-soft">Né(e) le <?= date('d/m/Y', strtotime($user['date_de_naissance'])) ?></span>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($user['email'])): ?>
                            <p class="email"><?= esc($user['email']) ?></p>
                        <?php endif; ?>

                        <div class="quick-actions">
                            <a class="chip" href="#compte">Mettre à jour le compte</a>
                            <a class="chip" href="#sante">Mettre à jour l’IMC</a>
                            <a class="chip" href="#objectifs">Voir mes objectifs</a>
                            <a class="chip" href="#regimes">Voir mes régimes</a>
                        </div>
                    </div>
                </div>

                <div class="kpis">
                    <div class="kpi">
                        <p class="label">IMC</p>
                        <p class="value"><?= esc($imc ?? '--') ?></p>
                        <p class="sub">Selon vos données actuelles</p>
                    </div>

                    <div class="kpi">
                        <p class="label">Poids</p>
                        <p class="value"><?= esc(isset($sante['poids']) && $sante['poids'] !== '' ? $sante['poids'] : '--') ?></p>
                        <p class="sub">kg</p>
                    </div>

                    <div class="kpi">
                        <p class="label">Taille</p>
                        <p class="value"><?= esc(isset($sante['taille']) && $sante['taille'] !== '' ? $sante['taille'] : '--') ?></p>
                        <p class="sub">cm</p>
                    </div>

                    <div class="kpi">
                        <p class="label">Objectifs</p>
                        <p class="value"><?= esc(is_array($userObjectifs ?? null) ? count($userObjectifs) : 0) ?></p>
                        <p class="sub">Choisis</p>
                    </div>
                </div>
            </section>

            <section id="objectifs" class="card mt-4">
                <div class="card-head">
                    <h2>🎯 Mes Objectifs</h2>
                    <span class="pill"><?= esc(is_array($userObjectifs ?? null) ? count($userObjectifs) : 0) ?></span>
                </div>
                <?php if (!empty($userObjectifs)): ?>
                    <div class="objectifs-list">
                        <?php foreach ($userObjectifs as $obj): ?>
                            <div class="objectif-item">
                                <h3><?= esc($obj['objectif_nom']) ?></h3>
                                <p class="meta">Choisi le : <?= date('d/m/Y', strtotime($obj['date_choix'])) ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="muted">Aucun objectif choisi pour le moment.</p>
                <?php endif; ?>
            </section>

            <section id="regimes" class="card mt-4">
                <div class="card-head">
                    <h2>🥗 Mes Régimes Achetés</h2>
                    <span class="pill"><?= esc(is_array($userRegimes ?? null) ? count($userRegimes) : 0) ?></span>
                </div>
                <?php if (!empty($userRegimes)): ?>
                    <div class="regimes-list">
                        <?php foreach ($userRegimes as $regime): ?>
                            <div class="regime-item">
                                <div class="regime-top">
                                    <h3><?= esc($regime['regime_nom']) ?></h3>
                                    <?php if (!empty($regime['statut'])): ?>
                                        <span class="badge badge-status"><?= esc($regime['statut']) ?></span>
                                    <?php endif; ?>
                                </div>

                                <p class="muted"><?= esc($regime['description']) ?></p>

                                <div class="meta-grid">
                                    <div><span class="meta-label">Période</span><span class="meta-value"><?= date('d/m/Y', strtotime($regime['date_debut'])) ?> → <?= date('d/m/Y', strtotime($regime['date_fin'])) ?></span></div>
                                    <div><span class="meta-label">Prix payé</span><span class="meta-value"><?= number_format($regime['prix_total'], 0, ',', ' ') ?> Ar</span></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="muted">Aucun régime acheté pour le moment.</p>
                <?php endif; ?>
            </section>

            <section id="compte" class="card update-account mt-4">
                <div class="card-head">
                    <div>
                        <h2>Mise à jour du compte</h2>
                        <p class="muted">Modifiez vos informations et, si besoin, votre mot de passe.</p>
                    </div>
                </div>

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

                <form action="/update-account" method="post" class="form-grid">
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

                    <div class="form-actions">
                        <button type="submit" class="btn">Mettre à jour mon compte</button>
                        <span class="muted small">Pensez à vérifier votre email après modification.</span>
                    </div>
                </form>
            </section>
                    
            <section id="sante" class="card update-health mt-4">
                <div class="card-head">
                    <div>
                        <h2>Données de santé</h2>
                        <p class="muted">Mettez à jour votre poids et votre taille pour recalculer l’IMC.</p>
                    </div>
                </div>

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

                <div class="status-row mb-3">
                    <div class="status-card">
                        <span class="status-label">Votre IMC actuel</span>
                        <span class="status-value"><?= esc($imc ?? '--') ?></span>
                        <span class="status-sub">Basé sur vos dernières données</span>
                    </div>
                </div>

                <form action="/update-profil" method="post" class="form-grid">
                    <?= csrf_field() ?>
                    <div class="field">
                        <label>Poids (kg) :</label>
                        <input type="number" step="0.1" name="poids" value="<?= esc($sante['poids'] ?? '') ?>" required>
                    </div>
                    <div class="field">
                        <label>Taille (cm) :</label>
                        <input type="number" step="0.1" name="taille" value="<?= esc($sante['taille'] ?? '') ?>" required>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn">Mettre à jour mon IMC</button>
                        <span class="muted small">Astuce : mettez à jour 1×/semaine pour un suivi fiable.</span>
                    </div>
                </form>
            </section>


            <p class="mt-4">
                <a class="link" href="/Accueil">Retour à l'accueil</a>
            </p>
        </div>
    </div>
</body>
</html>