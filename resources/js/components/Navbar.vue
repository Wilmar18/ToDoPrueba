<template>
  <nav class="navbar">
    <div class="navbar-container">
      <div class="navbar-logo">
        <RouterLink to="/">Mi App</RouterLink>
      </div>
      
      <div class="navbar-menu" :class="{ 'is-active': isOpen }">
        <RouterLink to="/" class="navbar-item">Inicio</RouterLink>
        <RouterLink to="/Register" class="navbar-item">Registro</RouterLink>
        <RouterLink to="/Notes" class="navbar-item">Notas</RouterLink>
        
      </div>
      
      <div class="navbar-burger" @click="toggleMenu" :class="{ 'is-active': isOpen }">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref } from 'vue'
import { RouterLink } from 'vue-router'

const isOpen = ref(false)

const toggleMenu = () => {
  isOpen.value = !isOpen.value
}
</script>

<style scoped>
.navbar {
  background-color: #333;
  color: white;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 1000;
}

.navbar-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem;
  max-width: 1200px;
  margin: 0 auto;
}

.navbar-logo a {
  color: white;
  text-decoration: none;
  font-weight: bold;
  font-size: 1.2rem;
}

.navbar-menu {
  display: flex;
}

.navbar-item {
  color: #ccc;
  text-decoration: none;
  padding: 0.5rem 1rem;
  transition: color 0.3s ease;
}

.navbar-item:hover {
  color: white;
}

.navbar-burger {
  display: none;
  flex-direction: column;
  justify-content: space-around;
  width: 2rem;
  height: 2rem;
  cursor: pointer;
}

.navbar-burger span {
  display: block;
  width: 100%;
  height: 2px;
  background-color: white;
  transition: all 0.3s ease-in-out;
}

@media (max-width: 768px) {
  .navbar-menu {
    display: none;
    flex-direction: column;
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background-color: #333;
  }

  .navbar-menu.is-active {
    display: flex;
  }

  .navbar-item {
    padding: 1rem;
    border-top: 1px solid #444;
  }

  .navbar-burger {
    display: flex;
  }

  .navbar-burger.is-active span:nth-child(1) {
    transform: translateY(8px) rotate(45deg);
  }

  .navbar-burger.is-active span:nth-child(2) {
    opacity: 0;
  }

  .navbar-burger.is-active span:nth-child(3) {
    transform: translateY(-8px) rotate(-45deg);
  }
}
</style>