<template>
    <div class="edit-note-container">
      <h2>Editar Nota</h2>
      <form @submit.prevent="updateNote">
        <div>
          <label for="title">Título:</label>
          <input type="text" v-model="note.title" id="title" required />
        </div>
        <div>
          <label for="description">Descripción:</label>
          <textarea v-model="note.description" id="description" required></textarea>
        </div>
        <div>
          <label for="due_date">Fecha de Vencimiento:</label>
          <input type="date" v-model="note.due_date" id="due_date" />
        </div>
        <button type="submit">Guardar Cambios</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    props: ['id'],
    data() {
      return {
        note: {
          title: '',
          description: '',
          due_date: '',
        },
        error: null,
      };
    },
    async created() {
      try {
        const token = localStorage.getItem('token');
        const response = await axios.get(`http://127.0.0.1:8000/api/notes/${this.id}`, {
          headers: {
            'Authorization': `Bearer ${token}`,
          },
        });
  
        this.note = response.data.data.note;
        
      } catch (error) {
        this.error = error.response?.data?.message || 'Error al cargar la nota';
      }
      console.log('Respuesta:', this.note);
    },
    methods: {
      //agregar metodo de show
      async updateNote() {
        try {
          const token = localStorage.getItem('token');
          await axios.put(`http://127.0.0.1:8000/api/notes/${this.id}`, this.note, {
            headers: {
              'Authorization': `Bearer ${token}`,
            },
          });
          this.$router.push('/notes'); 
        } catch (error) {
          this.error = error.response?.data?.message || 'Error al actualizar la nota';
        }
      },
    },
  };
  </script>
  
  <style scoped>
  .edit-note-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
  }
  
  form {
    display: flex;
    flex-direction: column;
  }
  
  form div {
    margin-bottom: 15px;
  }
  
  button {
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  </style>
  