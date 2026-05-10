<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Porte-monnaie - NutriPlan</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="page">
        <div class="shell">
            <section class="hero fade-in">
                <div class="topbar">
                    <div class="welcome">
                        <h1>Mon Porte-monnaie</h1>
                    </div>
                    <a class="logout" href="/logout">Déconnexion</a>
                </div>

                <div class="card" style="max-width: 500px; margin: 2rem auto;">
                    <div class="balance-box text-center">
                        <div class="label" style="font-size: 1rem; color: var(--text-secondary); margin-bottom: 0.5rem;">Solde Actuel</div>
                        <div class="value" style="font-size: 2.5rem; font-weight: 700; color: var(--primary);"><?= number_format($user['porte_monnaie'] ?? 0, 0, ',', ' ') ?> Ar</div>
                    </div>

                    <?php if (session()->getFlashdata('Error')): ?>
                        <div class="flash-message flash-error">
                            <?= session()->getFlashdata('Error') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="flash-message flash-success">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>

                    <form action="/recharge-wallet" method="post" class="mt-4">
                        <?= csrf_field() ?>
                        <div class="field">
                            <label for="code">Code de recharge</label>
                            <input type="text" name="code" id="code" placeholder="Ex: XXXX-XXXX-XXXX" required>
                        </div>
                        <button type="submit" class="btn btn-block">Recharger maintenant</button>
                    </form>

                    <?php if (!empty($codesDisponibles)): ?>
                        <div class="mt-4">
                            <h3>Codes de recharge disponibles</h3>
                            <table class="w-full">
                                <thead>
                                    <tr>
                                        <th class="text-left py-2">Code</th>
                                        <th class="text-left py-2">Montant (Ar)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($codesDisponibles as $code): ?>
                                        <tr class="border-t">
                                            <td class="py-2"><?= htmlspecialchars($code['code']) ?></td>
                                            <td class="py-2"><?= number_format($code['montant'], 0, ',', ' ') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="mt-4 text-center text-muted">Aucun code de recharge disponible pour le moment.</p>
                    <?php endif; ?>
                </div>

                <p class="mt-4 text-center">
                    <a href="/Accueil" class="link">Retour à l'accueil</a>
                </p>
            </section>
        </div>
    </div>
</body>
</html>