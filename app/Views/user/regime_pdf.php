<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= esc((string)($regime['nom'] ?? 'Régime')) ?></title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #111; }
        h1 { font-size: 18px; margin: 0 0 6px; }
        .muted { color: #555; margin: 0 0 14px; }
        .box { border: 1px solid #ddd; border-radius: 6px; padding: 10px 12px; margin: 10px 0; }
        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: left; padding: 6px 4px; border-bottom: 1px solid #eee; }
        .kpi { display: inline-block; margin-right: 18px; }
    </style>
</head>
<body>
    <h1><?= esc((string)($regime['nom'] ?? '')) ?></h1>
    <p class="muted"><?= esc((string)($regime['description'] ?? '')) ?></p>

    <div class="box">
        <div class="kpi"><strong>Durée :</strong> <?= esc((string)($regime['duree_jour'] ?? '')) ?> jours</div>
        <div class="kpi"><strong>Variation prévue :</strong> <?= esc((string)($regime['variation_poids'] ?? '')) ?> kg</div>
        <div class="kpi"><strong>Prix :</strong> <?= number_format((float)($regime['prix'] ?? 0), 0, ',', ' ') ?> Ar</div>
    </div>

    <div class="box">
        <strong>Composition</strong>
        <ul>
            <li>Viande : <?= esc((string)($regime['pourcentage_viande'] ?? '')) ?>%</li>
            <li>Poisson : <?= esc((string)($regime['pourcentage_poisson'] ?? '')) ?>%</li>
            <li>Volaille : <?= esc((string)($regime['pourcentage_volaille'] ?? '')) ?>%</li>
        </ul>
    </div>

    <div class="box">
        <strong>Activités sportives</strong>
        <?php if (!empty($sports)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Durée (min)</th>
                        <th>Calories</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sports as $sport): ?>
                        <tr>
                            <td><?= esc((string)($sport['nom'] ?? '')) ?></td>
                            <td><?= esc((string)($sport['duree_minute'] ?? '')) ?></td>
                            <td><?= esc((string)($sport['calories_brulees'] ?? '')) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucune activité spécifique.</p>
        <?php endif; ?>
    </div>
</body>
</html>
