<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($activite) ? 'Modifier' : 'Ajouter' ?> une Activité - Admin</title>
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
                <h1><?= isset($activite) ? 'Modifier' : 'Ajouter' ?> une activité</h1>
                <a href="/admin/activites" class="admin-btn admin-btn-outline">Retour</a>
            </header>

            <div class="admin-content">
                <div class="admin-card" style="max-width: 600px;">
                    <div class="admin-card-header">
                        <h2>Informations de l'Activité</h2>
                    </div>
                    <div class="admin-card-body">
                        <form action="/admin/activites/save" method="post">
                            <?= csrf_field() ?>
                            <?php if(isset($activite)): ?>
                                <input type="hidden" name="id" value="<?= $activite['id'] ?? '' ?>">
                            <?php endif; ?>
                            
                            <div class="admin-form-group">
                                <label>Nom de l'activité</label>
                                <input type="text" name="nom" class="admin-form-control" value="<?= $activite['nom'] ?? '' ?>" required>
                            </div>
                            
                            <div class="admin-form-group">
                                <label>Durée (minutes)</label>
                                <input type="number" name="duree_minute" class="admin-form-control" value="<?= $activite['duree_minute'] ?? '' ?>" required>
                            </div>
                            
                            <div class="admin-form-group">
                                <label>Calories brûlées</label>
                                <input type="number" name="calories_brulees" class="admin-form-control" value="<?= $activite['calories_brulees'] ?? '' ?>" required>
                            </div>
                            
                            <button type="submit" class="admin-btn admin-btn-primary">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>