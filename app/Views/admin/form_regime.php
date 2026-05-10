<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($regime) ? 'Modifier' : 'Ajouter' ?> un Régime - Admin</title>
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
                    <a href="/admin/regimes" class="admin-nav-link active">
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
                <h1><?= isset($regime) ? 'Modifier' : 'Ajouter' ?> un programme</h1>
                <a href="/admin/regimes" class="admin-btn admin-btn-outline">Retour</a>
            </header>

            <div class="admin-content">
                <div class="admin-card" style="max-width: 700px;">
                    <div class="admin-card-header">
                        <h2>Informations du Régime</h2>
                    </div>
                    <div class="admin-card-body">
                        <form action="/admin/regimes/save" method="post">
                            <?= csrf_field() ?>
                            <?php if(isset($regime)): ?>
                                <input type="hidden" name="id" value="<?= $regime['id'] ?? '' ?>">
                            <?php endif; ?>
                            
                            <div class="admin-form-group">
                                <label>Nom du programme</label>
                                <input type="text" name="nom" class="admin-form-control" value="<?= $regime['nom'] ?? '' ?>" required>
                            </div>
                            
                            <div class="admin-form-group">
                                <label>Description</label>
                                <textarea name="description" class="admin-form-control" rows="3"><?= $regime['description'] ?? '' ?></textarea>
                            </div>
                            
                            <div class="admin-form-group">
                                <label>Prix (Ar)</label>
                                <input type="number" name="prix" class="admin-form-control" value="<?= $regime['prix'] ?? '' ?>" required>
                            </div>
                            
                            <div class="admin-form-group">
                                <label>Durée (jours)</label>
                                <input type="number" name="duree_jour" class="admin-form-control" value="<?= $regime['duree_jour'] ?? '' ?>" required>
                            </div>
                            
                            <div class="admin-form-group">
                                <label>Variation de poids (kg)</label>
                                <input type="number" step="0.1" name="variation_poids" class="admin-form-control" value="<?= $regime['variation_poids'] ?? '' ?>" required>
                            </div>
                            
                            <div class="admin-form-group">
                                <label>Composition (%)</label>
                                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
                                    <div>
                                        <small>Viande</small>
                                        <input type="number" name="pourcentage_viande" class="admin-form-control" value="<?= $regime['pourcentage_viande'] ?? '' ?>">
                                    </div>
                                    <div>
                                        <small>Poisson</small>
                                        <input type="number" name="pourcentage_poisson" class="admin-form-control" value="<?= $regime['pourcentage_poisson'] ?? '' ?>">
                                    </div>
                                    <div>
                                        <small>Volaille</small>
                                        <input type="number" name="pourcentage_volaille" class="admin-form-control" value="<?= $regime['pourcentage_volaille'] ?? '' ?>">
                                    </div>
                                </div>
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