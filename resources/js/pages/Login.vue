<script setup>
import { useUserStore } from '../stores/storeUser';
const store = useUserStore();
var dataLogin = {
    email: '',
    password: ''
}
const login = async () => {
    if (!dataLogin.email || !dataLogin.password) {
        alert('Ingrese los datos');
    } else {
        if (!await store.login(dataLogin)) {
            alert('Datos incorrectos');
        }
    }
}
</script>
<template>
    <div class="text-center">
        <div class="form-signin w-50 m-auto my-5">
            <form>
                <img class="mb-4" src="/drive.png" alt="" width="70" height="65">
                <h1 class="h3 mb-3 fw-normal">Repositorio</h1>

                <div class="form-floating">
                    <input type="email" class="form-control" id="floatingInput" v-model="dataLogin.email">
                    <label for="floatingInput">correo electronico</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" v-model="dataLogin.password">
                    <label for="floatingPassword">contraseña</label>
                </div>

                <div class="checkbox mb-3">
                    <button @click.prevent="login" class="w-100 btn btn-lg btn-primary" type="submit">Ingresar</button>
                </div>
            </form>
        </div>
    </div>
</template>