# WordPress Project - Xulinos

Ce projet WordPress est configuré pour être déployé sur Coolify avec Docker.

## 🚀 Déploiement sur Coolify

### Prérequis
- Un compte GitHub
- Un serveur Coolify configuré
- Une base de données MySQL/MariaDB

### Étapes de déploiement

1. **Créer un repository GitHub**
   ```bash
   git remote add origin https://github.com/votre-username/xulinos-wp.git
   git add .
   git commit -m "Initial commit - WordPress project ready for Coolify"
   git push -u origin main
   ```

2. **Configurer les variables d'environnement dans Coolify**
   
   Dans l'interface Coolify, ajoutez ces variables d'environnement :
   
   ```env
   # Database Configuration
   DB_NAME=wordpress
   DB_USER=wordpress
   DB_PASSWORD=votre_mot_de_passe_securise
   DB_HOST=mysql:3306
   
   # WordPress Configuration
   WP_DEBUG=false
   WP_DEBUG_LOG=false
   WP_DEBUG_DISPLAY=false
   
   # Security Keys (générez de nouvelles clés pour la production)
   AUTH_KEY=votre_cle_auth
   SECURE_AUTH_KEY=votre_cle_secure_auth
   LOGGED_IN_KEY=votre_cle_logged_in
   NONCE_KEY=votre_cle_nonce
   AUTH_SALT=votre_salt_auth
   SECURE_AUTH_SALT=votre_salt_secure_auth
   LOGGED_IN_SALT=votre_salt_logged_in
   NONCE_SALT=votre_salt_nonce
   
   # WordPress URLs
   WP_HOME=https://votre-domaine.com
   WP_SITEURL=https://votre-domaine.com
   
   # Table Prefix
   TABLE_PREFIX=wp_
   ```

3. **Déployer sur Coolify**
   - Connectez votre repository GitHub à Coolify
   - Sélectionnez le Dockerfile comme méthode de build
   - Configurez les variables d'environnement
   - Lancez le déploiement

### 🔧 Développement local

Pour développer localement :

```bash
# Cloner le repository
git clone https://github.com/votre-username/xulinos-wp.git
cd xulinos-wp

# Copier le fichier d'environnement
cp env.example .env

# Modifier les variables dans .env selon vos besoins

# Lancer avec Docker Compose
docker-compose up -d
```

Le site sera accessible sur `http://localhost:8080`

### 📁 Structure du projet

```
xulinos-wp/
├── Dockerfile              # Configuration Docker pour la production
├── docker-compose.yml      # Configuration pour le développement local
├── coolify.yml            # Configuration spécifique à Coolify
├── wp-config-production.php # Configuration WordPress pour la production
├── env.example            # Exemple de variables d'environnement
├── .gitignore             # Fichiers à ignorer par Git
└── README.md              # Ce fichier
```

### 🔐 Sécurité

- Les clés de sécurité WordPress sont configurées via les variables d'environnement
- Le fichier `wp-config.php` n'est pas versionné (dans .gitignore)
- Les uploads et caches sont exclus du versioning
- Configuration de sécurité activée en production

### 📝 Notes importantes

- Assurez-vous de générer de nouvelles clés de sécurité pour la production
- Configurez un certificat SSL pour votre domaine
- Sauvegardez régulièrement votre base de données
- Surveillez les logs d'erreur en production

### 🆘 Support

Pour toute question ou problème, consultez la documentation Coolify ou créez une issue sur GitHub.
