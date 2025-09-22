<template>
  <div class="auth-container">
    <div class="auth-card">
      <div class="auth-header">
        <h2>Connexion</h2>
        <p>Connectez-vous à votre compte</p>
      </div>

      <form @submit.prevent="handleLogin" class="auth-form">
        <div v-if="errorMessage" class="error-message">
          {{ errorMessage }}
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input
            type="email"
            id="email"
            v-model="loginData.email"
            required
            placeholder="Votre adresse email"
          >
        </div>

        <div class="form-group">
          <label for="password">Mot de passe</label>
          <input
            type="password"
            id="password"
            v-model="loginData.password"
            required
            placeholder="Votre mot de passe"
          >
        </div>

        <button type="submit" class="auth-btn" :disabled="loading">
          {{ loading ? 'Connexion...' : 'Se connecter' }}
        </button>
      </form>

      <div class="auth-footer">
        <p>Pas encore de compte ? <router-link to="/register" class="auth-link">S'inscrire</router-link></p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '../store/auth';

const router = useRouter();
const authStore = useAuthStore();
const loading = ref(false);
const errorMessage = ref('');

const loginData = ref({
  email: '',
  password: ''
});

const handleLogin = async () => {
  loading.value = true;
  errorMessage.value = '';

  try {
    await authStore.login(loginData.value);
    router.push('/');
  } catch (error) {
    errorMessage.value = error.response?.data?.error || 'Erreur de connexion';
  } finally {
    loading.value = false;
  }
};
</script>

<style scoped>
.auth-container {
  min-height: 80vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
  background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.auth-card {
  background: white;
  padding: 40px;
  border-radius: 12px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 450px;
}

.auth-header {
  text-align: center;
  margin-bottom: 30px;
}

.auth-header h2 {
  color: #2c3e50;
  margin-bottom: 8px;
  font-size: 28px;
}

.auth-header p {
  color: #7f8c8d;
  margin: 0;
}

.auth-form {
  margin-bottom: 25px;
}

.error-message {
  background-color: #fee;
  border: 1px solid #f5c6cb;
  color: #721c24;
  padding: 12px;
  border-radius: 6px;
  margin-bottom: 20px;
}

.form-group {
  margin-bottom: 20px;
}

.form-group label {
  display: block;
  margin-bottom: 8px;
  color: #2c3e50;
  font-weight: 500;
}

.form-group input {
  width: 100%;
  padding: 12px 16px;
  border: 2px solid #e1e8ed;
  border-radius: 8px;
  font-size: 16px;
  transition: border-color 0.3s ease;
}

.form-group input:focus {
  outline: none;
  border-color: #3498db;
}

.auth-btn {
  width: 100%;
  padding: 14px;
  background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  transition: transform 0.2s ease;
}

.auth-btn:hover:not(:disabled) {
  transform: translateY(-2px);
}

.auth-btn:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

.auth-footer {
  text-align: center;
  margin-top: 20px;
}

.auth-link {
  color: #3498db;
  text-decoration: none;
  font-weight: 500;
}

.auth-link:hover {
  text-decoration: underline;
}

@media (max-width: 480px) {
  .auth-card {
    padding: 30px 20px;
  }
}
</style>