# Design Élégant - NutriPlan User & Admin Interface

## Vue d'ensemble

Un design moderne et élégant a été créé pour toutes les vues utilisateur et administrateur de l'application NutriPlan.

## Fichiers CSS
- [`public/assets/css/style.css`](public/assets/css/style.css) - Styles pour les vues utilisateur
- [`public/assets/css/admin.css`](public/assets/css/admin.css) - Styles pour les vues administrateur

## Vues Utilisateur (8 fichiers)
1. [`app/Views/user/login.php`](app/Views/user/login.php) - Page de connexion
2. [`app/Views/user/Accueil.php`](app/Views/user/Accueil.php) - Tableau de bord
3. [`app/Views/user/profil.php`](app/Views/user/profil.php) - Profil utilisateur
4. [`app/Views/user/objectif.php`](app/Views/user/objectif.php) - Sélection d'objectifs
5. [`app/Views/user/regime.php`](app/Views/user/regime.php) - Programmes régimes
6. [`app/Views/user/porte_money.php`](app/Views/user/porte_money.php) - Porte-monnaie
7. [`app/Views/user/register_user.php`](app/Views/user/register_user.php) - Inscription étape 1
8. [`app/Views/user/register_sante.php`](app/Views/user/register_sante.php) - Inscription étape 2

## Vues Administrateur (8 fichiers)
1. [`app/Views/admin/loginAdmin.php`](app/Views/admin/loginAdmin.php) - Page de connexion admin
2. [`app/Views/admin/dashboard.php`](app/Views/admin/dashboard.php) - Tableau de bord admin
3. [`app/Views/admin/regimes.php`](app/Views/admin/regimes.php) - Gestion des régimes
4. [`app/Views/admin/activites.php`](app/Views/admin/activites.php) - Gestion des activités
5. [`app/Views/admin/codes.php`](app/Views/admin/codes.php) - Gestion des codes
6. [`app/Views/admin/parametres.php`](app/Views/admin/parametres.php) - Paramètres
7. [`app/Views/admin/form_regime.php`](app/Views/admin/form_regime.php) - Formulaire régime
8. [`app/Views/admin/form_activite.php`](app/Views/admin/form_activite.php) - Formulaire activité

## Caractéristiques du Design

### Palette de Couleurs
- **Primaire** : Indigo (#6366f1) - Couleur principale pour les actions
- **Secondaire** : Emeraude (#10b981) - Couleur de succès
- **Accent** : Ambre (#f59e0b) - Couleur pour les éléments Gold
- **Neutres** : Gris clair et blanc pour les fonds

### Composants Principaux

1. **Cartes KPI** - Affichage des indicateurs (IMC, poids, solde)
2. **Grille d'actions** - Boutons d'accès rapide aux fonctionnalités
3. **Cartes programme** - Présentation des régimes avec composition et prix
4. **Formulaires** - Champs modernes avec effets de focus
5. **Messages d'alerte** - Notifications de succès et d'erreur

### Effets & Animations
- Transitions fluides au survol
- Ombres progressives (shadow-md, shadow-lg, shadow-xl)
- Animation de fondu à l'apparition
- Effet de soulèvement au hover

### Responsive Design
- Grille adaptative pour les cartes
- Layout flexible pour les écrans mobiles
- Typographie responsive

## Utilisation

### Vues Utilisateur
```html
<link rel="stylesheet" href="/assets/css/style.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
```

### Vues Admin
```html
<link rel="stylesheet" href="/assets/css/admin.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
```

## Classes CSS Principales

### User Views
| Classe | Description |
|--------|-------------|
| `.page` | Container principal avec padding |
| `.shell` | Container centré max-width 1200px |
| `.topbar` | Barre supérieure avec déconnexion |
| `.kpis` | Grille de 3 indicateurs |
| `.kpi` | Carte indicateur individuel |
| `.actions` | Grille de boutons d'action |
| `.action` | Bouton d'action standard |
| `.cta` | Bouton d'appel à l'action (gradient) |
| `.btn` | Bouton standard |
| `.link` | Lien stylisé |
| `.field` | Groupe de champ de formulaire |
| `.auth` | Container pour pages d'authentification |
| `.auth-card` | Carte de connexion/inscription |
| `.alert` | Message d'alerte |
| `.flash-message` | Message flash |
| `.card` | Carte avec ombre |
| `.regime-card` | Carte programme régime |

### Admin Views
| Classe | Description |
|--------|-------------|
| `.admin-container` | Container flex pour layout admin |
| `.admin-sidebar` | Sidebar fixe à gauche |
| `.admin-nav` | Liste de navigation |
| `.admin-nav-link` | Lien de navigation |
| `.admin-main` | Contenu principal |
| `.admin-header` | En-tête de page |
| `.admin-content` | Contenu avec padding |
| `.admin-stats-grid` | Grille de statistiques |
| `.admin-stat-card` | Carte statistique |
| `.admin-card` | Carte admin |
| `.admin-table` | Tableau de données |
| `.admin-btn` | Bouton admin |
| `.admin-badge` | Badge de statut |
| `.admin-form-group` | Groupe de formulaire |
| `.admin-form-control` | Champ de formulaire |