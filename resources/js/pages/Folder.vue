<script setup>
import { useUserStore } from '../stores/storeUser';
import Users from './AddUsers.vue';
import File from './AddFile.vue';
import { onMounted } from 'vue';
const store = useUserStore();
onMounted(async () => {
    await store.getFiles();
});
const downloadFile = async (id) => {
    await store.downloadFile(id);
}
</script>
<template>
    <div v-if="store.loading">
        <div class="d-flex justify-content-center vh-100">
            <div class="spinner-border text-danger m-5" style="width: 9rem; height: 9rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <div v-else class="d-flex justify-content-between align-items-center mt-5">
        <h1 class="m-3">Listado de archivos</h1>
        <button v-if="store.user.role == 'admin'" type="button" class="btn btn-light border me-3" data-bs-toggle="modal"
            data-bs-target="#addUser">Agregar
            usuario</button>
    </div>

    <div v-if="store.files !== false && store.user.role == 'user'">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Nombre</th>
                    <template v-if="store.user.role == 'user'">
                        <th scope="col">Status</th>
                        <th scope="col">Opciones</th>
                    </template>
                    <template v-else>
                        <th scope="col">descargas</th>
                        <th scope="col">total</th>
                    </template>
                </tr>
            </thead>
            <tbody>
                <template v-for="file in store.files" :key="file.id">
                    <tr>
                        <th scope="row">{{ file.format }}</th>
                        <td>{{ file.name }}</td>
                        <template v-if="store.user.role == 'user'">
                            <td>{{ file.pivot.download }}</td>
                            <td><button type="button" @click="downloadFile(file.id)"
                                    :class="[file.pivot.download ? 'btn btn-success border me-3' : 'btn btn-light border me-3']">Descarga</button>
                            </td>
                        </template>
                        <template v-else>
                            <td>1</td>
                            <td>{{ store.files.length }}</td>
                        </template>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
    <div v-if="store.files !== false && store.user.role == 'admin'">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Archivos de la carpeta</th>
                    <th scope="col">total en carpeta</th>
                    <th scope="col">{{ store.files.length }}</th>
                </tr>
            </thead>
            <tbody>
                <template v-for="file in store.files" :key="file.id">
                    <tr>
                        <th scope="row">{{ file.format }}</th>
                        <td colspan="3">{{ file.name }}</td>
                    </tr>
                </template>
            </tbody>
        </table>
        <table class="table">
            <thead>
                <tr>
                    <th colspan="3">Usuarios con permisos</th>
                    <th scope="col">total: {{ store.users.length }}</th>
                </tr>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Estatus</th>
                    <th scope="col">descargas</th>
                </tr>
            </thead>
            <tbody>
                <template v-for="user in store.users" :key="user.id">
                    <tr>
                        <td>{{ user.user.name }}</td>
                        <td>{{ user.user.email }}</td>
                        <td>{{ user.user.pivot.status }}</td>
                        <td>{{ user.download }}</td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
    <Users />
    <File />
</template>