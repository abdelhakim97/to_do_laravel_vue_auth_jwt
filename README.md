# 📝 To Do App – Laravel + Vue 3 (CRUD + JWT Auth)

Application **SPA** (Single Page Application) avec :
- ✅ **Backend**: Laravel (API REST)  
- ✅ **Frontend**: Vue 3 + Vite + Pinia + Axios  
- ✅ **Authentification**: JWT (tymon/jwt-auth)  
- ✅ **Fonctionnalités**: CRUD des tâches + Authentification (login/logout)  

---

## ⚙️ Prérequis

### Backend (Laravel)
- PHP >= 8.1
- Composer
- MySQL ou SQLite
- [XAMPP](https://www.apachefriends.org/) ou [Laragon](https://laragon.org/) (optionnel)

### Frontend (Vue)
- Node.js >= 18
- npm ou yarn

---

## 🚀 Installation

### 1) Cloner le projet
```bash
git clone https://github.com/USERNAME/to_do_laravel_vue_auth_jwt.git
cd to_do_laravel_vue_auth_jwt
2) Backend – Laravel API
bash
Copier le code
cd backend
Copier le fichier d’environnement :

bash
Copier le code
cp .env.example .env
Configurer la base de données dans .env :

env
Copier le code
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todo_db
DB_USERNAME=root
DB_PASSWORD=
Installer les dépendances :

bash
Copier le code
composer install
Générer la clé d’application :

bash
Copier le code
php artisan key:generate
Installer JWT :

bash
Copier le code
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
php artisan jwt:secret
Lancer les migrations :

bash
Copier le code
php artisan migrate
Démarrer le serveur :

bash
Copier le code
php artisan serve
🔗 API disponible sur :
http://127.0.0.1:8000/api

3) Frontend – Vue 3
bash
Copier le code
cd frontend
Installer les dépendances :

bash
Copier le code
npm install
Démarrer le projet :

bash
Copier le code
npm run dev
🔗 Application Vue disponible sur :
http://127.0.0.1:5173

🛠️ Structure du projet
bash
Copier le code
to_do_laravel_vue_auth_jwt/
 ├── backend/        # Laravel API (CRUD + JWT)
 └── frontend/       # Vue 3 + Pinia + Axios (SPA)
🔑 Authentification (JWT)
Login : retourne un JWT token.

Le token est stocké dans Pinia store et ajouté dans les headers Authorization pour chaque requête Axios.

Logout : supprime le token du store.

📌 Commandes utiles
Laravel
php artisan migrate:fresh --seed : réinitialiser la base de données

php artisan serve : démarrer l’API

Vue
npm run dev : lancer le serveur en mode dev

npm run build : construire une version production

👨‍💻 Auteur
Abdelhakim Akayou

🏷️ Développeur Full Stack (Laravel + Vue)

🔗 LinkedIn

yaml
Copier le code
