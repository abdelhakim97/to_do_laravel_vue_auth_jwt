<script setup>
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import api from "../utils/axios";

const route = useRoute();
const router = useRouter();

const task = ref({
  title: "",
  description: "",
  is_completed: false
});

onMounted(async () => {
  const id = route.params.id;
  try {
    const response = await api.get(`/task/${id}`);
    task.value = response.data;
  } catch (error) {
    console.error("Erreur lors du chargement:", error);
    if (error.response?.status === 401) {
      router.push("/login");
    }
  }
});

const updateTask = async () => {
  const id = route.params.id;
  try {
    await api.put(`/task/${id}`, task.value); 
    router.push("/");
  } catch (error) {
    console.error("Erreur lors de la mise à jour:", error);
    
    if (error.response?.status === 401) {
      alert("Non autorisé. Veuillez vous reconnecter.");
      router.push("/login");
    } else {
      alert("Erreur lors de la mise à jour de la tâche");
    }
  }
};
</script>

<template>
  <div class="p-4">
    <h1>Modifier la tâche</h1>
    <form @submit.prevent="updateTask">
      <div class="form-group">
        <label>Titre:</label>
        <input v-model="task.title" class="form-control" required />
      </div>
      <div class="form-group">
        <label>Description:</label>
        <textarea v-model="task.description" class="form-control"></textarea>
      </div>
      <div class="form-group">
        <label>
          <input type="checkbox" v-model="task.is_completed" />
          Complétée
        </label>
      </div>
      <button type="submit" class="btn btn-primary">Enregistrer</button>
      <router-link to="/" class="btn btn-secondary">Annuler</router-link>
    </form>
  </div>
</template>