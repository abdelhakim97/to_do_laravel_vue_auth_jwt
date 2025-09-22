# 📝 To Do List – Laravel + Vue 3 (JWT Auth + CRUD)

Projet **Full Stack SPA** avec séparation **Backend (Laravel)** et **Frontend (Vue 3)**.  
Ce projet implémente :  
- Authentification avec **JWT**  
- Gestion des tâches (**CRUD**)  
- **Pinia** pour le store global  
- **Axios** pour la communication avec l’API  

---

## 📂 Structure du projet

to_do_laravel_vue_auth_jwt/
 ├── backend/    # API Laravel (JWT + CRUD)
 └── frontend/   # Vue 3 (SPA + Pinia + Axios)

---

## ⚙️ Prérequis

- **PHP** >= 8.1  
- **Composer**  
- **MySQL** ou SQLite  
- **Node.js** >= 18  
- **npm** ou yarn  

---

## 🚀 Installation

### 1️⃣ Cloner le projet
git clone https://github.com/abdelhakim97/to_do_laravel_vue_auth_jwt.git
cd to_do_laravel_vue_auth_jwt

---

### 2️⃣ Backend – Laravel API

cd backend

1. Copier le fichier d’environnement :
cp .env.example .env

2. Configurer la base de données dans `.env` :
DB_CONNECTION=mysql  
DB_HOST=127.0.0.1  
DB_PORT=3306  
DB_DATABASE=todo_db  
DB_USERNAME=root  
DB_PASSWORD=

3. Installer les dépendances :
composer install

4. Générer la clé d’application :
php artisan key:generate

5. Installer et configurer JWT :
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"  
php artisan jwt:secret

6. Exécuter les migrations et seeders :
php artisan migrate --seed

7. Démarrer le serveur Laravel :
php artisan serve

L’API est disponible sur : http://127.0.0.1:8000/api

---

### 3️⃣ Frontend – Vue 3

cd frontend

1. Installer les dépendances :
npm install

2. Lancer le serveur de développement :
npm run dev

Le frontend est disponible sur : http://127.0.0.1:5173

---

## 🔑 Authentification (JWT)

- **Login** : retourne un token **JWT**.  
- Le token est stocké dans **Pinia store** et ajouté automatiquement aux headers **Axios**.  
- **Logout** : supprime le token du store.  

---

## 📌 Endpoints API (Tasks)

Méthode | Endpoint | Description
--- | --- | ---
GET | /api/tasks | Liste des tâches de l’utilisateur
GET | /api/tasks/{id} | Détail d’une tâche
POST | /api/tasks | Créer une nouvelle tâche
PUT | /api/tasks/{id} | Modifier une tâche
DELETE | /api/tasks/{id} | Supprimer une tâche

---

## 👨‍💻 Auteur

**Abdelhakim Akayou**  
Développeur Full Stack (Laravel + Vue)  
🔗 [LinkedIn](https://www.linkedin.com/in/abdelhakim-akayou-678806283/)
