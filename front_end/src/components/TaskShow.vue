<template>
  <div class="task-show">
    <div class="header">
      <h1>Détails de la Tâche</h1>
      <router-link to="/" class="back-button">← Retour à la liste</router-link>
    </div>

    <div v-if="loading" class="loading">Chargement en cours...</div>

    <div v-else-if="task" class="task-details">
      <div class="detail-card">
        <h2 class="task-title">{{ task.title }}</h2>
        
        <div class="detail-item">
          <label>Description:</label>
          <p class="description">{{ task.description || 'Aucune description' }}</p>
        </div>
        
        <div class="detail-item">
          <label>Statut:</label>
          <span :class="['status', task.is_completed ? 'completed' : 'pending']">
            {{ task.is_completed ? 'Complétée' : 'En cours' }}
          </span>
        </div>
        
        <div class="detail-item">
          <label>ID de la tâche:</label>
          <span class="task-id">#{{ task.id }}</span>
        </div>
        
        <div class="action-buttons">
          <router-link 
            :to="`/task/${task.id}/edit`" 
            class="btn btn-edit"
          >
            Modifier la tâche
          </router-link>
          
          <button 
            @click="deleteTask" 
            class="btn btn-delete"
            :disabled="deleting"
          >
            {{ deleting ? 'Suppression...' : 'Supprimer la tâche' }}
          </button>
        </div>
      </div>
    </div>

    <div v-else class="error-message">
      <p>Tâche non trouvée</p>
      <router-link to="/" class="btn btn-primary">Retour à l'accueil</router-link>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import api from "../utils/axios";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();

const task = ref(null);
const loading = ref(true);
const deleting = ref(false);

onMounted(async () => {
  const id = route.params.id;
  try {
    const response = await api.get(`http://127.0.0.1:8000/api/task/${id}`);
    task.value = response.data;
  } catch (error) {
    console.error("Erreur lors du chargement:", error);
  } finally {
    loading.value = false;
  }
});

const deleteTask = async () => {
  if (!confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')) return;
  
  deleting.value = true;
  try {
    await axios.delete(`http://127.0.0.1:8000/api/task/${task.value.id}`);
    router.push("/");
  } catch (error) {
    console.error("Erreur lors de la suppression:", error);
    alert('Échec de la suppression de la tâche');
  } finally {
    deleting.value = false;
  }
};
</script>

<style scoped>
.task-show {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 30px;
  border-bottom: 2px solid #eee;
  padding-bottom: 15px;
}

.header h1 {
  color: #2c3e50;
  margin: 0;
}

.back-button {
  color: #3498db;
  text-decoration: none;
  font-weight: 500;
}

.back-button:hover {
  text-decoration: underline;
}

.loading {
  text-align: center;
  padding: 40px;
  font-size: 18px;
  color: #7f8c8d;
}

.detail-card {
  background: white;
  border-radius: 8px;
  box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
  padding: 25px;
  margin-bottom: 20px;
}

.task-title {
  color: #2c3e50;
  margin-top: 0;
  margin-bottom: 20px;
  padding-bottom: 15px;
  border-bottom: 1px solid #eee;
}

.detail-item {
  margin-bottom: 20px;
}

.detail-item label {
  display: block;
  font-weight: 600;
  color: #34495e;
  margin-bottom: 5px;
}

.description {
  color: #555;
  line-height: 1.6;
  margin: 0;
  padding: 10px;
  background: #f8f9fa;
  border-radius: 4px;
  border-left: 4px solid #3498db;
}

.status {
  padding: 4px 12px;
  border-radius: 20px;
  font-weight: 500;
  font-size: 0.9em;
}

.status.completed {
  background-color: #e8f5e9;
  color: #2e7d32;
}

.status.pending {
  background-color: #ffecb3;
  color: #f57c00;
}

.task-id {
  color: #7f8c8d;
  font-family: monospace;
  background: #f8f9fa;
  padding: 4px 8px;
  border-radius: 4px;
}

.action-buttons {
  display: flex;
  gap: 12px;
  margin-top: 25px;
  padding-top: 20px;
  border-top: 1px solid #eee;
}

.btn {
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  text-decoration: none;
  font-weight: 500;
  transition: all 0.2s ease;
  display: inline-block;
  text-align: center;
}

.btn:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.btn-edit {
  background-color: #3498db;
  color: white;
}

.btn-edit:hover:not(:disabled) {
  background-color: #2980b9;
}

.btn-delete {
  background-color: #e74c3c;
  color: white;
}

.btn-delete:hover:not(:disabled) {
  background-color: #c0392b;
}

.btn-primary {
  background-color: #2c3e50;
  color: white;
}

.btn-primary:hover {
  background-color: #1a252f;
}

.error-message {
  text-align: center;
  padding: 40px;
  background: #f8d7da;
  color: #721c24;
  border-radius: 8px;
  border: 1px solid #f5c6cb;
}

.error-message p {
  margin-bottom: 20px;
}

@media (max-width: 768px) {
  .header {
    flex-direction: column;
    gap: 10px;
    text-align: center;
  }
  
  .action-buttons {
    flex-direction: column;
  }
  
  .btn {
    width: 100%;
  }
}
</style>