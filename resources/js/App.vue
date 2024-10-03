<template>
  <div id="app">
    <Navbar />
    <main class="main-content">
      <router-view />
    </main>
  </div>
</template>

<script>
import Navbar from './components/Navbar.vue';

export default {
  components: {
    Navbar,
  },
};
</script>

<style scoped>
#app {
  display: flex;
  flex-direction: column;
  height: 100vh;
}

nav {
  position: fixed;
  top: 0;
  width: 100%;
  height: 60px; /* Ajusta según la altura de tu navbar */
  background-color: #333;
  color: #fff;
  z-index: 1000; /* Para asegurarte de que el navbar esté por encima del contenido */
}

.main-content {
  margin-top: 60px; /* Espacio equivalente a la altura del navbar */
  padding: 20px;
  overflow: auto;
}
</style>
