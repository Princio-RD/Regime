<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programmes - NutriPlan</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="page">
        <div class="shell">
            <section class="hero fade-in">
                <div class="topbar">
                    <div class="welcome">
                        <h1>Choisir un programme</h1>
                        <p>Objectif : <strong><?= esc($objectif['nom'] ?? 'Non défini') ?></strong></p>
                        <?php if (isset($poids_ideal)): ?>
                            <p>Cible poids idéal : <strong><?= $poids_ideal ?> kg</strong></p>
                        <?php endif; ?>
                    </div>
                    <a href="/objectif" class="link">Changer d'objectif</a>
                </div>

                <?php if (isset($regimes) && !empty($regimes)): ?>
                    <div class="regime-list">
                        <?php foreach($regimes as $regime): ?>
                            <div class="regime-card">
                                <h3><?= esc($regime['nom']) ?></h3>
                                <p><?= esc($regime['description']) ?></p>
                                
                                <div class="composition">
                                    <strong>Composition :</strong><br>
                                    🥩 Viande : <?= esc($regime['pourcentage_viande']) ?>% | 
                                    🐟 Poisson : <?= esc($regime['pourcentage_poisson']) ?>% | 
                                    🍗 Volaille : <?= esc($regime['pourcentage_volaille']) ?>%
                                </div>

                                <div class="sports-box">
                                    <h4>🏃 Activités sportives</h4>
                                    <ul>
                                        <?php if (!empty($regime['sports'])): ?>
                                            <?php foreach ($regime['sports'] as $sport): ?>
                                                <li><strong><?= esc($sport['nom']) ?></strong> : <?= esc($sport['duree_minute']) ?> min (-<?= esc($sport['calories_brulees']) ?> cal)</li>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <li>Aucun sport spécifique</li>
                                        <?php endif; ?>
                                    </ul>
                                </div>

                                <div style="margin: 10px 0;">
                                    Variation prévue : <strong><?= esc($regime['variation_poids']) ?> kg</strong>
                                </div>

                                <div class="price-tag">
                                    <?php if ($is_gold): ?>
                                        <span class="price-old"><?= number_format($regime['prix'], 0, ',', ' ') ?> Ar</span>
                                        <?php $prixRemise = $regime['prix'] * 0.85; ?>
                                        <?= number_format($prixRemise, 0, ',', ' ') ?> Ar <small>(Gold -15%)</small>
                                    <?php else: ?>
                                        <?= number_format($regime['prix'], 0, ',', ' ') ?> Ar
                                    <?php endif; ?>
                                </div>

                                <div class="meta">
                                    <span>⏱ Durée : <?= esc($regime['duree_jour']) ?> jours</span>
                                </div>

                                <form action="/souscrire-regime" method="post" style="margin-top: 20px;">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="regime_id" value="<?= $regime['id'] ?>">
                                    <button type="submit" class="btn btn-block">
                                        Choisir ce programme
                                    </button>
                                </form>

                                <div style="margin-top: 10px;">
                                    <a href="<?= base_url('/regimes/' . esc($regime['id']) . '/export-pdf') ?>" class="btn btn-block" download>Exporter en PDF</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="card text-center mt-4">
                        <p>Désolé, aucun programme n'est disponible pour cet objectif pour le moment.</p>
                    </div>
                <?php endif; ?>

                <p class="mt-4 text-center">
                    <a href="/Accueil" class="link">Retour au tableau de bord</a>
                </p>
            </section>
        </div>
    </div>
</body>
</html>