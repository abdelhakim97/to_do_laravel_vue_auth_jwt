<template>
  <div class="p-4">
    <h1>📚 Liste des Tâches</h1>
    <router-link to="/create" class="btn btn-primary">Ajouter tâche</router-link>
    
    <div v-if="loading" class="loading">Chargement...</div>
    
    <table v-else border="1" cellpadding="10" cellspacing="0">
      <thead>
        <tr>
          <th>ID</th>
          <th>Titre</th>
          <th>Description</th>
          <th>Complétée</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="task in tasks" :key="task.id">
          <td>{{ task.id }}</td>
          <td>{{ task.title }}</td>
          <td>{{ task.description }}</td>
          <td>{{ task.is_completed ? 'Oui' : 'Non' }}</td>
          <td>
            <router-link :to="`/task/${task.id}`" class="btn btn-view">Voir</router-link>
            <router-link :to="`/task/${task.id}/edit`" class="btn btn-edit">Modifier</router-link>
            <button @click="deleteTask(task.id)" class="btn btn-delete">Supprimer</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import api from "../utils/axios";

const tasks = ref([]);
const loading = ref(true);

onMounted(async () => {
  try {
    const response = await api.get("/task");
    tasks.value = response.data;
  } catch (error) {
    console.error("Erreur API:", error);
  } finally {
    loading.value = false;
  }
});

const deleteTask = async (id) => {
  if (!confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')) return;
  
  try {
    await api.delete(`/task/${id}`);
    tasks.value = tasks.value.filter(task => task.id !== id);
  } catch (error) {
    console.error("Erreur lors de la suppression:", error);
  }
};
</script>