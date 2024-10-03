<template>
    <div class="login-container">
      <h2>Iniciar Sesión</h2>
      <form @submit.prevent="handleSubmit">
        <div class="form-group">
          <label for="email">Correo Electrónico:</label>
          <input id="email" v-model="email" type="email" required>
        </div>
        <div class="form-group">
          <label for="password">Contraseña:</label>
          <input id="password" v-model="password" type="password" required>
        </div>
        <button type="submit">Iniciar Sesión</button>
      </form>
      <p v-if="error" class="error-message">{{ error }}</p>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  import axios from 'axios'
  
  const email = ref('')
  const password = ref('')
  const error = ref('')
  
  const handleSubmit = async () => {
    try {
      const response = await axios.post('/login', {
        email: email.value,
        password: password.value
      })
      console.log('Login exitoso', response.data)
      // Aquí puedes redirigir al usuario o actualizar el estado de la aplicación
    } catch (err) {
      error.value = 'Error en el inicio de sesión. Por favor, intenta de nuevo.'
      console.error('Error en el login', err)
    }
  }
  </script>