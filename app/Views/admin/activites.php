<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Activités - Admin</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
                    <a href="/admin/activites" class="admin-nav-link active">
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
                <h1>Gestion des Activités Sportives</h1>
                <a href="/admin/activites/add" class="admin-btn admin-btn-primary">+ Nouvelle Activité</a>
            </header>

            <div class="admin-content">
                <div class="admin-card">
                    <div class="admin-card-header">
                        <h2>Liste des Activités</h2>
                    </div>
                    <div class="admin-card-body" style="padding: 0;">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Activité</th>
                                    <th>Durée (min)</th>
                                    <th>Calories</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($activites)): ?>
                                    <?php foreach($activites as $a): ?>
                                    <tr>
                                        <td><strong><?= esc($a['nom'] ?? '') ?></strong></td>
                                        <td><?= $a['duree_minute'] ?? 0 ?> min</td>
                                        <td><?= $a['calories_brulees'] ?? 0 ?> cal</td>
                                        <td>
                                            <div class="admin-actions">
                                                <a href="/admin/activites/edit/<?= $a['id'] ?>" class="admin-action-link">Modifier</a>
                                                <a href="/admin/activites/delete/<?= $a['id'] ?>" class="admin-action-link delete" onclick="return confirm('Supprimer cette activité ?')">Supprimer</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" style="text-align: center; color: #64748b;">Aucune activité disponible</td>
                                    </tr>
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
