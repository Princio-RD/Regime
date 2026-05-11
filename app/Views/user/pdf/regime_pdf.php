<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 13px; }
        .header { text-align:center; margin-bottom: 12px; }
        .section { margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h2><?= esc($regime['nom']) ?></h2>
        <div><?= esc($regime['description']) ?></div>
    </div>

    <div class="section"><strong>Durée :</strong> <?= esc($regime['duree_jour']) ?> jours</div>
    <div class="section"><strong>Variation de poids :</strong> <?= esc($regime['variation_poids']) ?> kg</div>
    <div class="section"><strong>Prix :</strong> <?= number_format($regime['prix'], 0, ',', ' ') ?> Ar</div>

    <div class="section"><strong>Composition :</strong>
        <div>Viande: <?= esc($regime['pourcentage_viande']) ?>% — Poisson: <?= esc($regime['pourcentage_poisson']) ?>% — Volaille: <?= esc($regime['pourcentage_volaille']) ?>%</div>
    </div>

    <div class="section"><strong>Activités sportives :</strong>
        <ul>
            <?php if (!empty($regime['sports'])): ?>
                <?php foreach ($regime['sports'] as $sport): ?>
                    <li><?= esc($sport['nom']) ?> — <?= esc($sport['duree_minute']) ?> min (<?= esc($sport['calories_brulees']) ?> cal)</li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>Aucune activité listée</li>
            <?php endif; ?>
        </ul>
    </div>
</body>
</html>