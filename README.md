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

2. **Déployer sur Coolify**
   - Connectez votre repository GitHub à Coolify
   - Sélectionnez le Dockerfile comme méthode de build
   - **Aucune configuration supplémentaire nécessaire** - tout est déjà dans wp-config.php
   - Lancez le déploiement

### 🔧 Développement local

Pour développer localement :

```bash
# Cloner le repository
git clone https://github.com/votre-username/xulinos-wp.git
cd xulinos-wp

# Lancer avec Docker Compose
docker-compose up -d
```

Le site sera accessible sur `http://localhost:8080`

### 📁 Structure du projet

```
xulinos-wp/
├── Dockerfile              # Configuration Docker pour la production
├── docker-compose.yml      # Configuration pour le développement local
├── wp-config.php          # Configuration WordPress (déjà configurée)
├── .gitignore             # Fichiers à ignorer par Git
└── README.md              # Ce fichier
```

### 🔐 Sécurité

- Les clés de sécurité WordPress sont déjà configurées dans wp-config.php
- Les uploads et caches sont exclus du versioning
- Configuration de sécurité activée en production

### 📝 Notes importantes

- Les clés de sécurité sont déjà configurées
- Configurez un certificat SSL pour votre domaine
- Sauvegardez régulièrement votre base de données
- Surveillez les logs d'erreur en production

### 🆘 Support

Pour toute question ou problème, consultez la documentation Coolify ou créez une issue sur GitHub.
