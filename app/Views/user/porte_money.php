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
                        <p class="muted">Rechargez votre solde et suivez les codes disponibles.</p>
                    </div>
                    <div class="topbar-actions">
                        <a class="btn btn-ghost" href="/Accueil">Accueil</a>
                        <a class="logout" href="/logout">Déconnexion</a>
                    </div>
                </div>

                <div class="wallet-layout">
                    <div class="card wallet-card">
                        <div class="wallet-balance">
                            <div>
                                <div class="muted small">Solde actuel</div>
                                <div class="wallet-amount"><?= number_format($user['porte_monnaie'] ?? 0, 0, ',', ' ') ?> <span class="currency">Ar</span></div>
                            </div>
                            <div class="wallet-badge">
                                <span class="badge badge-soft">Sécurisé</span>
                            </div>
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

                        <div class="divider"></div>

                        <form action="/recharge-wallet" method="post" class="wallet-form">
                            <?= csrf_field() ?>
                            <div class="field">
                                <label for="code">Code de recharge</label>
                                <input type="text" name="code" id="code" placeholder="Ex: GIFT2024-001" autocomplete="off" required>
                                <p class="help">Collez votre code ici. Il doit être valide et non utilisé.</p>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-block">Recharger maintenant</button>
                                <span class="muted small">Le solde est mis à jour instantanément.</span>
                            </div>
                        </form>
                    </div>

                    <div class="card wallet-card">
                        <div class="card-head">
                            <h2>Codes disponibles</h2>
                            <span class="pill"><?= esc(is_array($codesDisponibles ?? null) ? count($codesDisponibles) : 0) ?></span>
                        </div>

                        <?php if (!empty($codesDisponibles)): ?>
                            <div class="table-wrap">
                                <table class="w-full">
                                    <thead>
                                        <tr>
                                            <th class="text-left py-2">Code</th>
                                            <th class="text-left py-2">Montant</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($codesDisponibles as $code): ?>
                                            <tr>
                                                <td class="py-2"><span class="code-pill"><?= htmlspecialchars($code['code']) ?></span></td>
                                                <td class="py-2"><strong><?= number_format($code['montant'], 0, ',', ' ') ?> Ar</strong></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="empty-state">
                                <p class="muted">Aucun code de recharge disponible pour le moment.</p>
                                <p class="muted small">Revenez plus tard ou contactez l’assistance.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <p class="mt-4 text-center">
                    <a href="/Accueil" class="link">Retour à l'accueil</a>
                </p>
            </section>
        </div>
    </div>
</body>
</html>