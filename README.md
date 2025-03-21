# Projet Symfony Gestion

Ce projet est une application de gestion développée avec Symfony 6.

## Prérequis

- PHP 8.2 ou supérieur
- Composer
- Symfony CLI
- MySQL/MariaDB

## Installation

1. Cloner le projet :
```bash
git clone [URL_DU_REPO]
cd projet-symfony-gestion
```

2. Installer les dépendances :
```bash
composer install
```

3. Configurer la base de données :
- Créer un fichier `.env.local` à la racine du projet
- Configurer les variables d'environnement :
```env
DATABASE_URL="mysql://user:password@127.0.0.1:3306/dbname?serverVersion=8.0.32&charset=utf8mb4"
```

4. Créer la base de données :
```bash
symfony console doctrine:database:create
```

5. Exécuter les migrations :
```bash
symfony console doctrine:migrations:migrate
```

## Configuration

Les paramètres principaux sont configurés dans `config/services.yaml` :
- `uploads_directory`: Dossier pour les fichiers uploadés
- `sounds_directory`: Dossier pour les fichiers sons
- `root_directory`: Dossier racine public

## Fonctionnalités

- Gestion des produits
- Gestion des catégories
- Gestion des stocks
- Gestion des utilisateurs
- Gestion des commandes
- Gestion des statistiques
- Système de notification

## Développement

Pour lancer le serveur de développement :
```bash
symfony server:start
```

Pour nettoyer le cache :
```bash
symfony console cache:clear
```

## Sécurité

- Authentification requise pour l'accès à l'administration
- Gestion des rôles (ROLE_ADMIN, ROLE_SUPER_ADMIN)
- Protection CSRF activée

## Structure du projet

```
src/
├── Controller/         # Contrôleurs de l'application
│   └── Admin/         # Contrôleurs de l'administration
├── Entity/            # Entités Doctrine
├── Repository/        # Repositories Doctrine
├── Listener/          # Event Listeners
└── Twig/              # Extensions Twig
```

## Maintenance

Pour mettre à jour les dépendances :
```bash
composer update
```

Pour mettre à jour la base de données :
```bash
symfony console doctrine:schema:update --force
```

## Support

Pour toute question ou problème, veuillez créer une issue dans le dépôt GitHub.
