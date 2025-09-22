<template>
  <div class="auth-container">
    <div class="auth-card">
      <div class="auth-header">
        <h2>Créer un compte</h2>
        <p>Remplissez les informations pour créer votre compte</p>
      </div>

      <form @submit.prevent="handleRegister" class="auth-form">
        <!-- عرض رسائل الخطأ -->
        <div v-if="errors.length > 0" class="error-message">
          <ul>
            <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
          </ul>
        </div>

        <div class="form-group">
          <label for="name">Nom complet *</label>
          <input
            type="text"
            id="name"
            v-model="registerData.name"
            required
            placeholder="Entrez votre nom complet"
            :class="{ 'error-input': fieldErrors.name }"
          >
          <span v-if="fieldErrors.name" class="error-text">{{ fieldErrors.name[0] }}</span>
        </div>

        <div class="form-group">
          <label for="email">Adresse email *</label>
          <input
            type="email"
            id="email"
            v-model="registerData.email"
            required
            placeholder="Entrez votre adresse email"
            :class="{ 'error-input': fieldErrors.email }"
          >
          <span v-if="fieldErrors.email" class="error-text">{{ fieldErrors.email[0] }}</span>
        </div>

        <div class="form-group">
          <label for="password">Mot de passe *</label>
          <input
            type="password"
            id="password"
            v-model="registerData.password"
            required
            placeholder="Créez un mot de passe fort"
            minlength="6"
            :class="{ 'error-input': fieldErrors.password }"
          >
          <span v-if="fieldErrors.password" class="error-text">{{ fieldErrors.password[0] }}</span>
          <p class="password-hint">Le mot de passe doit contenir au moins 6 caractères</p>
        </div>

        <div class="form-group">
          <label for="password_confirmation">Confirmer le mot de passe *</label>
          <input
            type="password"
            id="password_confirmation"
            v-model="registerData.password_confirmation"
            required
            placeholder="Confirmez votre mot de passe"
            :class="{ 'error-input': fieldErrors.password_confirmation }"
          >
          <span v-if="fieldErrors.password_confirmation" class="error-text">{{ fieldErrors.password_confirmation[0] }}</span>
        </div>

        <div class="form-options">
          <label class="checkbox-container">
            <input 
              type="checkbox" 
              v-model="registerData.terms" 
              required
              :class="{ 'error-input': fieldErrors.terms }"
            >
            <span class="checkmark"></span>
            J'accepte les <a href="#" class="terms-link">conditions d'utilisation</a>
          </label>
          <span v-if="fieldErrors.terms" class="error-text">{{ fieldErrors.terms[0] }}</span>
        </div>

        <button type="submit" class="auth-btn" :disabled="loading">
          {{ loading ? 'Création en cours...' : 'Créer un compte' }}
        </button>
      </form>

      <div class="auth-footer">
        <p>Vous avez déjà un compte ? <router-link to="/login" class="auth-link">Se connecter</router-link></p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

const router = useRouter();
const loading = ref(false);
const errors = ref([]);
const fieldErrors = reactive({});

const registerData = reactive({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  terms: false
});

const handleRegister = async () => {
  loading.value = true;
  errors.value = [];
  Object.keys(fieldErrors).forEach(key => delete fieldErrors[key]);
  
  try {
    const response = await axios.post('http://127.0.0.1:8000/api/register', {
      name: registerData.name,
      email: registerData.email,
      password: registerData.password,
      password_confirmation: registerData.password_confirmation,
      terms: registerData.terms
    });

    console.log('Inscription réussie:', response.data);
    
    // Redirection vers la page de connexion avec message de succès
    router.push({ 
      path: '/login', 
      query: { registered: 'true' } 
    });
    
  } catch (error) {
    if (error.response && error.response.status === 422) {
      // Validation errors from Laravel
      const validationErrors = error.response.data.errors;
      Object.assign(fieldErrors, validationErrors);
      
      // Convertir les erreurs de champ en messages généraux
      errors.value = Object.values(validationErrors).flat();
    } else if (error.response) {
      // Autres erreurs du serveur
      errors.value = [error.response.data.message || 'Une erreur est survenue lors de l\'inscription'];
    } else {
      // Erreurs réseau
      errors.value = ['Erreur de connexion. Veuillez vérifier votre connexion internet.'];
    }
    console.error('Erreur lors de l\'inscription:', error);
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

.error-message ul {
  margin: 0;
  padding-left: 20px;
}

.error-text {
  color: #e74c3c;
  font-size: 14px;
  margin-top: 5px;
  display: block;
}

.error-input {
  border-color: #e74c3c !important;
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

.password-hint {
  font-size: 12px;
  color: #7f8c8d;
  margin: 5px 0 0;
}

.form-options {
  margin-bottom: 25px;
}

.checkbox-container {
  display: flex;
  align-items: center;
  cursor: pointer;
  font-size: 14px;
}

.checkbox-container input {
  margin-right: 8px;
}

.terms-link {
  color: #3498db;
  text-decoration: none;
}

.terms-link:hover {
  text-decoration: underline;
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