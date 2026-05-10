<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - NutriPlan</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="admin-sidebar-header">
                <h2>📊 NutriPlan</h2>
            </div>
            <ul class="admin-nav">
                <li class="admin-nav-item">
                    <a href="/admin/dashboard" class="admin-nav-link active">
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
                    <a href="/admin/codes" class="admin-nav-link">
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
                <h1>Tableau de bord</h1>
                <a href="/Accueil" class="admin-btn admin-btn-outline">🌐 Retour Front</a>
            </header>

            <div class="admin-content">
                <!-- Stats Grid -->
                <div class="admin-stats-grid">
                    <div class="admin-stat-card">
                        <div class="label">Utilisateurs</div>
                        <div class="value"><?= $totalUsers ?? 0 ?></div>
                    </div>
                    <div class="admin-stat-card">
                        <div class="label">Membres Gold</div>
                        <div class="value"><?= $goldMembers ?? 0 ?></div>
                    </div>
                    <div class="admin-stat-card">
                        <div class="label">Régimes Actifs</div>
                        <div class="value"><?= $activeRegimes ?? 0 ?></div>
                    </div>
                    <div class="admin-stat-card money">
                        <div class="label">Revenu Total</div>
                        <div class="value"><?= number_format($totalRevenue ?? 0, 0, ',', ' ') ?> Ar</div>
                    </div>
                    <div class="admin-stat-card money">
                        <div class="label">Revenu du Mois</div>
                        <div class="value"><?= number_format($monthlyRevenue ?? 0, 0, ',', ' ') ?> Ar</div>
                    </div>
                </div>

                <!-- Charts -->
                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                    <div class="admin-card">
                        <div class="admin-card-header">
                            <h2>Flux de Revenus Mensuels</h2>
                        </div>
                        <div class="admin-card-body">
                            <canvas id="revChart" height="100"></canvas>
                        </div>
                    </div>
                    <div class="admin-card">
                        <div class="admin-card-header">
                            <h2>Type d'Utilisateurs</h2>
                        </div>
                        <div class="admin-card-body">
                            <canvas id="userChart" height="100"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Recent Regimes -->
                <div class="admin-card">
                    <div class="admin-card-header">
                        <h2>Régimes Récents</h2>
                        <a href="/admin/regimes/add" class="admin-btn admin-btn-primary">+ Nouveau</a>
                    </div>
                    <div class="admin-card-body" style="padding: 0;">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Programme</th>
                                    <th>Variation</th>
                                    <th>Prix</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($recentRegimes)): ?>
                                    <?php foreach($recentRegimes as $r): ?>
                                    <tr>
                                        <td><strong><?= esc($r['nom'] ?? '') ?></strong></td>
                                        <td>
                                            <span class="admin-badge <?= $r['variation_poids'] > 0 ? 'admin-badge-success' : 'admin-badge-warning' ?>">
                                                <?= $r['variation_poids'] > 0 ? 'Gain' : 'Perte' ?> <?= abs($r['variation_poids']) ?>kg
                                            </span>
                                        </td>
                                        <td><?= number_format($r['prix'] ?? 0, 0, ',', ' ') ?> Ar</td>
                                        <td>
                                            <div class="admin-actions">
                                                <a href="/admin/regimes/edit/<?= $r['id'] ?>" class="admin-action-link">Modifier</a>
                                                <a href="/admin/regimes/delete/<?= $r['id'] ?>" class="admin-action-link delete" onclick="return confirm('Supprimer ce régime ?')">Supprimer</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" style="text-align: center; color: #64748b;">Aucun régime disponible</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Graphique Revenus
        new Chart(document.getElementById('revChart'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
                datasets: [{
                    label: 'Revenus (Ar)',
                    data: [400000, 600000, 550000, 900000, 750000, 850000],
                    borderColor: '#6366f1',
                    backgroundColor: 'rgba(99, 102, 241, 0.1)',
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } }
            }
        });

        // Graphique Users
        new Chart(document.getElementById('userChart'), {
            type: 'doughnut',
            data: {
                labels: ['Standard', 'Gold'],
                datasets: [{
                    data: [<?= ($totalUsers ?? 0) - ($goldMembers ?? 0) ?>, <?= $goldMembers ?? 0 ?>],
                    backgroundColor: ['#64748b', '#f59e0b']
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    </script>
</body>
</html>