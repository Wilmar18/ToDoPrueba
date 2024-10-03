<template>
  <div>
    <h2>Iniciar sesión</h2>
    <form @submit.prevent="login">
      <div>
        <label for="email">Email:</label>
        <input type="email" v-model="email" required />
      </div>
      <div>
        <label for="password">Contraseña:</label>
        <input type="password" v-model="password" required />
      </div>
      <button type="submit">Iniciar sesión</button>
      <p v-if="error">{{ error }}</p>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      email: '',
      password: '',
      error: null,
    };
  },
  methods: {
    async login() {
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/login', {
          email: this.email,
          password: this.password,
        });

        // Guardar el token en localStorage
        localStorage.setItem('token', response.data.data.jwt); // Asegúrate de que esta ruta es correcta

        // Redireccionar o mostrar un mensaje de éxito
        this.$router.push('/notes'); 
      } catch (error) {
        // Manejar errores
        if (error.response && error.response.data) {
          this.error = error.response.data.message || 'Error de inicio de sesión';
        } else {
          this.error = 'Error de conexión. Por favor, intenta de nuevo más tarde.';
        }
      }
    },
  },
};
</script>
