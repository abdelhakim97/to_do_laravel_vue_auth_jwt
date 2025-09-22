<template>
  <header class="app-header">
    <div class="header-container">
      <div class="logo">
        <router-link to="/">
          <h1>📝 TaskManager</h1>
        </router-link>
      </div>
      
      <nav v-if="authStore.isAuthenticated" class="navigation">
        <ul class="nav-list">
          <li class="nav-item">
            <router-link to="/" class="nav-link">Accueil</router-link>
          </li>
          <li class="nav-item">
            <span class="nav-user">Bonjour, {{ authStore.user?.name }}</span>
          </li>
        </ul>
      </nav>
      
      <div v-if="authStore.isAuthenticated" class="auth-buttons">
        <button class="auth-btn logout-btn" @click="logout">Déconnexion</button>
      </div>
      
      <div v-else class="auth-buttons">
        <button class="auth-btn login-btn" @click="login">Se connecter</button>
        <button class="auth-btn signup-btn" @click="signup">S'inscrire</button>
      </div>
    </div>
  </header>
</template>

<script setup>
import { useRouter } from 'vue-router';
import { useAuthStore } from '../store/auth';

const router = useRouter();
const authStore = useAuthStore();

const login = () => {
  router.push('/login');
};

const signup = () => {
  router.push('/register');
};

const logout = () => {
  authStore.logout();
  router.push('/login');
};
</script>

<style scoped>
.app-header {
  background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
  color: white;
  padding: 0;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  position: sticky;
  top: 0;
  z-index: 1000;
}

.header-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
  height: 70px;
}

.logo h1 {
  margin: 0;
  font-size: 1.8rem;
  color: white;
}

.logo a {
  text-decoration: none;
}

.navigation {
  display: flex;
}

.nav-list {
  display: flex;
  list-style: none;
  margin: 0;
  padding: 0;
  gap: 25px;
}

.nav-link {
  color: white;
  text-decoration: none;
  font-weight: 500;
  padding: 8px 12px;
  border-radius: 4px;
  transition: background-color 0.3s;
}

.nav-link:hover,
.nav-link.router-link-active {
  background-color: rgba(255, 255, 255, 0.1);
}

.nav-user {
  color: white;
  font-weight: 500;
}

.auth-buttons {
  display: flex;
  gap: 12px;
}

.auth-btn {
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
}

.login-btn {
  background-color: transparent;
  border: 2px solid white;
  color: white;
}

.login-btn:hover {
  background-color: white;
  color: #6a11cb;
}

.signup-btn {
  background-color: white;
  color: #6a11cb;
}

.signup-btn:hover {
  background-color: #f8f9fa;
  transform: translateY(-2px);
}

.logout-btn {
  background-color: #e74c3c;
  color: white;
}

.logout-btn:hover {
  background-color: #c0392b;
}

@media (max-width: 768px) {
  .header-container {
    padding: 0 15px;
  }
  
  .logo h1 {
    font-size: 1.5rem;
  }
  
  .nav-list {
    gap: 15px;
  }
  
  .auth-btn {
    padding: 8px 15px;
    font-size: 14px;
  }
}
</style>