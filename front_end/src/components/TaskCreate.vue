<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import api from "../utils/axios";

const router = useRouter();

const task = ref({
  title: "",
  description: "",
  is_completed: false
});

const createTask = async () => {
  try {
    console.log("Creating task:", task.value);
    const response = await api.post("/task", task.value); 
    console.log("Task created:", response.data);
    router.push("/");
  } catch (error) {
    console.error("Erreur lors de la création:", error);
    

    if (error.response?.status === 401) {
      alert("Non autorisé. Veuillez vous reconnecter.");
      router.push("/login");
    } else if (error.response?.data?.errors) {
      const errors = error.response.data.errors;
      alert("Erreurs de validation: " + JSON.stringify(errors));
    } else {
      alert("Erreur lors de la création de la tâche");
    }
  }
};
</script>

<template>
  <div class="p-4">
    <h1>Nouvelle tâche</h1>
    <form @submit.prevent="createTask">
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
      <button type="submit" class="btn btn-primary">Créer</button>
      <router-link to="/" class="btn btn-secondary">Annuler</router-link>
    </form>
  </div>
</template>