<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres - Admin</title>
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
                    <a href="/admin/parametres" class="admin-nav-link active">
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
                <h1>Paramètres Généraux</h1>
            </header>

            <div class="admin-content">
                <div class="admin-card" style="max-width: 600px;">
                    <div class="admin-card-header">
                        <h2>Configuration</h2>
                    </div>
                    <div class="admin-card-body">
                        <form action="#" method="post">
                            <div class="admin-form-group">
                                <label>Prix de l'Option Gold (Ar)</label>
                                <input type="number" name="gold_price" class="admin-form-control" value="50000">
                            </div>
                            <div class="admin-form-group">
                                <label>Remise Gold (%)</label>
                                <input type="number" name="gold_discount" class="admin-form-control" value="15">
                            </div>
                            <div class="admin-form-group">
                                <label>IMC de Référence (Cible)</label>
                                <input type="number" step="0.1" name="target_imc" class="admin-form-control" value="22.0">
                            </div>
                            <button type="submit" class="admin-btn admin-btn-primary">Enregistrer les modifications</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>