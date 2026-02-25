# 🏋️ CrossFit Competition Platform

Plateforme web permettant de regrouper et gérer des compétitions de CrossFit organisées par différentes box.

Le site permet :

- Consulter les compétitions
- Voir les WOD (Rx / Intermédiaire / Scaled)
- S’inscrire à une compétition
- Gérer ses inscriptions
- Administration complète des compétitions

Projet réalisé dans le cadre de la formation **Développeur Web et Web Mobile (DWWM)**.

---

# 🚀 Fonctionnalités principales

## 👤 Utilisateur

- Création de compte
- Connexion / Déconnexion
- Inscription à une compétition
- Consultation des inscriptions personnelles
- Désinscription

## 🏆 Compétitions

- Liste dynamique depuis la base de données
- Fiche WOD dans une fenêtre modale
- Catégories :
  - RX
  - Intermédiaire
  - Scaled

## 🔐 Administrateur

- Ajouter une compétition
- Modifier une compétition
- Supprimer une compétition
- Voir les participants inscrits

---

# 🧰 Technologies utilisées

## Front-end

- HTML5
- CSS3
- Bootstrap 5
- JavaScript
- FontAwesome

## Back-end

- PHP 8 (procédural)
- PDO (connexion sécurisée base de données)

## Base de données

- MySQL / MariaDB

## Hébergement

- AlwaysData

---

# 📁 Structure du projet

/admin
    create_competition.php
    edit_competition.php
    delete_competition.php
    participants.php

/includes
    header.php
    footer.php
    db.php

index.php
competitions.php
inscriptions.php
login.php
register.php
logout.php
mes_inscriptions.php

---

# 🗄️ Base de données

Tables principales :

- users
- competitions
- inscriptions
- boxes

Relation principale :
users 1—N inscriptions N—1 competitions

---

# ⚙️ Installation locale

## 1️⃣ Cloner le projet

```bash
git clone https://github.com/Julien-Pignataro/Crossfit-Plateform.git

2️⃣ Configurer la base de données

Créer une base MySQL puis importer :
database/schema.sql

3️⃣ Configurer la connexion

Modifier :
includes/db.php

$host = 'localhost';
$db   = 'crossfit';
$user = 'root';
$pass = '';

4️⃣ Lancer le serveur PHP

php -S localhost:8000 -t public
Accès :
http://localhost:8000

🌍 Déploiement AlwaysData
1.	Upload des fichiers via FTP dans le dossier :
     /www
2.	Créer une base de données MySQL dans AlwaysData
3.	Importer le fichier SQL via phpMyAdmin
4.	Modifier includes/db.php :

$host = 'mysql-username.alwaysdata.net';
$db   = 'username_database';
$user = 'username';
$pass = 'password';`

🔐 Sécurité mise en place
	•	Sessions PHP sécurisées
	•	Mots de passe hashés (password_hash)
	•	Requêtes préparées PDO
	•	Protection XSS avec htmlspecialchars
	•	Vérification des rôles admin

📱 Responsive
	•	Adaptation mobile
	•	Menu burger
	•	Cartes dynamiques
	•	Interface Bootstrap

🧪 Jeu d’essai

Exemple compte admin :
Email : julien@email.fr
Mot de passe : 1234

📌 Améliorations possibles
	•	Paiement des inscriptions
	•	Upload de photos
	•	API REST
	•	Gestion des catégories athlètes
	•	Dashboard statistiques

👨‍💻 Auteur

Projet réalisé par :

Julien Pignataro-Barthome

Formation DWWM — 2026
