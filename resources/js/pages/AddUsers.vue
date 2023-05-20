<script setup>
import { useUserStore } from '../stores/storeUser';
import { ref, onMounted } from 'vue';
const store = useUserStore();
const selectedUser = ref();
onMounted(async () => {
    if(store.user.role=='admin'){
        await store.getUsers()
        console.log(store.users)
    };
});
const addUserToFolder = async () => {
    if (await store.addUserToFolder(selectedUser.value) || true ){
        bootstrap.Modal.getInstance(document.getElementById('addUser')).hide();
    }
}
</script>
<template>
    <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="AddUserLabel" aria-hidden="true">
        <div class="modal-dialog" role="form">
            <div class="modal-content">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h1 class="fw-bold mb-0 fs-2">Seleccione al usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5 pt-0">
                    <form class="">
                        <div class="form-group m-5">
                            <label for="usuario">Usuario:</label>
                            <select class="form-select" id="usuario" v-model="selectedUser">
                                <option v-for="usuario in store.users" :value="usuario.id" :key="usuario.id">
                                    {{ usuario.name }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group m-5">
                            <button @click.prevent="addUserToFolder" class="w-100 mb-2 btn btn-lg rounded-3 btn-primary"
                                type="submit">Agregar</button>
                        </div>
                        <hr class="my-4">
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>