<script setup>
import {useUserStore} from '../stores/storeUser';
const store = useUserStore();
const salir = async () =>{
  store.logout();
}
</script>

<template>
  <nav class="navbar navbar-expand-md bg-dark">
    <div class="container">
      <router-link to="/Home">
        <a class="navbar-brand" href="#">
          <img src="/drive.png" alt="Logo" width="20" height="20">
        </a>
      </router-link>
      <button v-if="store.user.token!==null" class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#menu"
        aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="menu">
        <div class="navbar-nav">
          <router-link v-if="store.user.token!==null" to="/Home" class="text-decoration-none">
            <a class="nav-link text-white active me-md-2" aria-current="page" href="#">Inicio</a>
          </router-link>
          <router-link v-if="store.user.role=='admin'" to="/users" class="text-decoration-none">
            <a class="nav-link text-white me-md-2" href="#">Usuarios</a>
          </router-link>
          <template v-if="store.user.token!==null">
            <a class="nav-link text-white d-block d-md-none" href="#" @click="salir">Salir</a>
          </template>
        </div>
      </div>
      <div class="d-none d-md-block" v-if="store.user.token!==null">
        <button type="button" class="btn btn-light border me-3" @click="salir">Salir</button>
      </div>
    </div>
  </nav>
</template>
