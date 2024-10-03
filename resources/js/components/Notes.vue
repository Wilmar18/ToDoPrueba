<template>
  <div>
    <h2>Crear Nota</h2>
    <form @submit.prevent="createNote">
      <div>
        <label for="title">Título:</label>
        <input type="text" v-model="note.title" required />
      </div>
      <div>
        <label for="description">Descripción:</label>
        <textarea v-model="note.description" required></textarea>
      </div>
      <div>
        <label for="tags">Etiquetas:</label>
        <input type="text" v-model="note.tags" />
      </div>
      <div>
        <label for="due_date">Fecha de vencimiento:</label>
        <input type="date" v-model="note.due_date" />
      </div>
      <button type="submit">Crear Nota</button>
      <p v-if="error">{{ error }}</p>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      note: {
        title: '',
        description: '',
        tags: '',
        due_date: null,
      },
      error: null,
    };
  },
  methods: {
    async createNote() {
      try {
        const token = localStorage.getItem('token');
        const response = await axios.post('http://127.0.0.1:8000/api/notes', this.note, {
          headers: {
            'Authorization': `Bearer ${token}`,
          },
        });

        // Redireccionar o mostrar mensaje de éxito
        this.$router.push('/Notes'); // Cambia esto según tu lógica
      } catch (error) {
        // Manejar errores
        this.error = error.response.data.message || 'Error al crear la nota';
      }
    },
  },
};
</script>
