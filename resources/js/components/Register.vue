<template>
  <div>
    <h2>Registro</h2>
    <form @submit.prevent="register">
      <div>
        <label for="name">Nombre:</label>
        <input type="text" v-model="name" required />
      </div>
      <div>
        <label for="email">Email:</label>
        <input type="email" v-model="email" required />
      </div>
      <div>
        <label for="password">Contraseña:</label>
        <input type="password" v-model="password" required />
      </div>
      <div>
        <label for="password_confirmation">Confirmar Contraseña:</label>
        <input type="password" v-model="password_confirmation" required />
      </div>
      <button type="submit">Registrar</button>
      <p v-if="error">{{ error }}</p>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
      error: null,
    };
  },
  methods: {
    async register() {
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/register', {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.password_confirmation,
        });

        // Puedes redirigir o mostrar un mensaje de éxito
        this.$router.push('/login'); // Redirige a la página de inicio de sesión
      } catch (error) {
        // Manejar errores
        this.error = error.response.data.message || 'Error de registro';
      }
    },
  },
};
</script>

<style scoped>
/* Estilos opcionales */
</style>
