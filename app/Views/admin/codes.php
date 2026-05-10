<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Codes - Admin</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="admin-container">
  
        <aside class="admin-sidebar">
            <div class="admin-sidebar-header">
                <h2>📊 NutriPlan</h2>
            </div>
            <ul class="admin-nav">
                <li class="admin-nav-item">
                    <a href="/admin/dashboard" class="admin-nav-link">
                        <span class="admin-nav-icon">📊</span>
                        <span>Tableau de bord</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="/admin/regimes" class="admin-nav-link">
                        <span class="admin-nav-icon">🥗</span>
                        <span>Régimes</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="/admin/activites" class="admin-nav-link">
                        <span class="admin-nav-icon">🏃</span>
                        <span>Activités</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="/admin/codes" class="admin-nav-link active">
                        <span class="admin-nav-icon">🔑</span>
                        <span>Codes</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="/admin/parametres" class="admin-nav-link">
                        <span class="admin-nav-icon">⚙️</span>
                        <span>Paramètres</span>
                    </a>
                </li>
                <li class="admin-nav-item" style="margin-top: 2rem;">
                    <a href="/admin/logout" class="admin-nav-link" style="color: #ef4444;">
                        <span class="admin-nav-icon">🚪</span>
                        <span>Déconnexion</span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <header class="admin-header">
                <h1>Validation des Codes</h1>
                <a href="#" class="admin-btn admin-btn-primary">+ Générer des codes</a>
            </header>

            <div class="admin-content">
                <div class="admin-card">
                    <div class="admin-card-header">
                        <h2>Liste des Codes</h2>
                    </div>
                    <div class="admin-card-body" style="padding: 0;">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Valeur</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($codes)): ?>
                                    <tr>
                                        <td colspan="3" style="text-align: center; color: #64748b;">Aucun code à valider pour le moment.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach($codes as $c): ?>
                                    <tr>
                                        <td><code><?= esc($c['code'] ?? '') ?></code></td>
                                        <td><?= number_format($c['montant'] ?? 0, 0, ',', ' ') ?> Ar</td>
                                        <td>
                                            <span class="admin-badge <?= ($c['utilise'] ?? 0) == 1 ? 'admin-badge-success' : 'admin-badge-warning' ?>">
                                                <?= ($c['utilise'] ?? 0) == 1 ? 'Utilisé' : 'Disponible' ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>