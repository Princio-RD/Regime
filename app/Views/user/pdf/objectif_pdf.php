<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .regime { border-bottom: 1px solid #ccc; padding: 10px 0; }
        .title { font-size: 16px; font-weight: bold; }
        .meta { color: #555; }
        ul { margin: 0; padding-left: 18px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Objectif : <?= esc($objectif['nom'] ?? 'Non défini') ?></h2>
        <?php if (isset($poids_ideal)): ?>
            <div>Poids idéal ciblé : <strong><?= $poids_ideal ?> kg</strong></div>
        <?php endif; ?>
    </div>

    <?php if (!empty($regimes)): ?>
        <?php foreach ($regimes as $regime): ?>
            <div class="regime">
                <div class="title"><?= esc($regime['nom']) ?></div>
                <div class="meta">Durée: <?= esc($regime['duree_jour']) ?> jours | Variation: <?= esc($regime['variation_poids']) ?> kg</div>
                <div style="margin-top:6px;">Prix: <?= number_format($regime['prix'], 0, ',', ' ') ?> Ar</div>
                <div style="margin-top:6px;"><strong>Composition:</strong> Viande <?= esc($regime['pourcentage_viande']) ?>% • Poisson <?= esc($regime['pourcentage_poisson']) ?>% • Volaille <?= esc($regime['pourcentage_volaille']) ?>%</div>
                <div style="margin-top:6px;"><strong>Activités sportives:</strong>
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
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun régime associé à cet objectif.</p>
    <?php endif; ?>
</body>
</html>