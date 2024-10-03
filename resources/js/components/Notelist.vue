<template>
  <div class="notes-list-container">
    <h2>Mis Notas</h2>
    <router-link to="/Notelist" class="create-note-btn">Crear Nueva Nota</router-link>
    <div v-if="notes.length === 0" class="no-notes">
      No hay notas creadas aún.
    </div>
    <div v-else class="notes-grid">
      <div v-for="note in notes" :key="note.id" class="note-card">
       
        <p>{{ truncateDescription(note.description) }}</p>
        <p><strong>Fecha de vencimiento:</strong> {{ formatDate(note.due_date) }}</p>
        <div class="tags">
          <h3>{{ note.tags }}</h3>
        </div>
        <img v-if="note.image" :src="note.image" alt="Imagen de la nota" class="note-image">
        <div class="note-actions">
          <router-link :to="`/notes/${note.id}/edit`" class="edit-btn">Editar</router-link>
          <button @click="deleteNote(note.id)" class="delete-btn">Borrar</button>
        </div>
      </div>
    </div>
  </div>
</template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        notes: [],
        error: null,
      };
    },
    async created() {
      try {
        const token = localStorage.getItem('token');
        const response = await axios.get('http://127.0.0.1:8000/api/notes', {
          headers: {
            'Authorization': `Bearer ${token}`,
          },
        });
  
        this.notes = response.data.data;
      } catch (error) {
        this.error = error.response.data.message || 'Error al cargar las notas';
      }
    //  console.log('respuesta:', this.notes);
    },
     methods: {
    truncateDescription(description) {
      // Truncar la descripción a un cierto número de caracteres
      const maxLength = 100; // Puedes cambiar este valor
      if (description.length > maxLength) {
        return description.substring(0, maxLength) + '...';
      }
      return description;
    },
    formatDate(date) {
      // Formatear la fecha según tus preferencias
      if (date) {
        return new Date(date).toLocaleDateString();
      }
      return 'Sin fecha';
    },
    async deleteNote(noteId) {
      try {
        const token = localStorage.getItem('token');
        await axios.delete(`http://127.0.0.1:8000/api/notes/${noteId}`, {
          headers: {
            'Authorization': `Bearer ${token}`,
          },
        });
        // Eliminar la nota de la lista localmente después de eliminarla del servidor
        this.notes = this.notes.filter(note => note.id !== noteId);
      } catch (error) {
        this.error = error.response?.data?.message || 'Error al borrar la nota';
      }
    },
  },
};
 
  </script>
  <style scoped>
  .notes-list-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
  }
  
  h2 {
    text-align: center;
    margin-bottom: 20px;
  }
  
  .create-note-btn {
    display: inline-block;
    margin: 0 auto 20px;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    font-size: 16px;
  }
  
  .notes-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
  }
  
  .note-card {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }
  
  .note-card h3 {
    margin-top: 0;
    margin-bottom: 10px;
  }
  
  .tags {
    margin-top: 10px;
  }
  
  .tag {
    background-color: #e0e0e0;
    padding: 2px 6px;
    border-radius: 4px;
    font-size: 12px;
    margin-right: 5px;
  }
  
  .note-image {
    max-width: 100%;
    height: auto;
    margin-top: 10px;
    border-radius: 4px;
  }
  
  .note-actions {
    margin-top: 15px;
    display: flex;
    justify-content: space-between;
  }
  
  .edit-btn, .delete-btn {
    padding: 5px 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-decoration: none;
  }
  
  .edit-btn {
    background-color: #2196F3;
    color: white;
  }
  
  .delete-btn {
    background-color: #f44336;
    color: white;
  }
  
  .no-notes {
    text-align: center;
    margin-top: 20px;
    font-style: italic;
    color: #666;
  }
  </style>
  