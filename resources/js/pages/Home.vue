<script setup>
import { useUserStore } from '../stores/storeUser';
import { useRouter } from 'vue-router';
import Folder from './AddFolder.vue';
const router = useRouter();
import moment from 'moment';
const store = useUserStore();
const fetchFolders = async () =>{
    await store.getFolders();
}
const showFolder = (id) =>{
    router.push('/Folders/'+id);
}
</script>
<template>
    <div class="container">
        <div v-if="store.loading">
            <div class="d-flex justify-content-center vh-100">
                <div class="spinner-border text-danger m-5" style="width: 9rem; height: 9rem;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <div v-else class="d-flex justify-content-between align-items-center mt-5">
            <h1 class="m-3">Listado de repositorios</h1>
            <button v-if="store.user.role == 'admin'" type="button" class="btn btn-light border me-3" data-bs-toggle="modal"
            data-bs-target="#addFolder">+ nueva</button>
            <button class="btn btn-primary" @click="fetchFolders">Ver carpetas</button>
        </div>
        <div>
            <div v-if="store.folders !== false" class="album py-5 bg-body-tertiary">
                <div class="container">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        <template v-for="(folder) in store.folders" :key="folder.id">
                            <div class="col">
                                <div class="card shadow-sm">
                                    <img src="..." alt="..." class="bd-placeholder-img card-img-top" width="100%"
                                        height="225">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ folder.name }}</h5>
                                        <p class="card-text">{{ folder.description }} <br>
                                            <span v-if="store.user.role=='user'">Estado: {{folder.pivot.status}}</span></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <button @click="showFolder(folder.id)" type="button" class="btn btn-sm btn-outline-secondary">Entrar</button>
                                            </div>
                                            <small class="text-body-secondary">{{ moment(folder.created_at).format('DD-MM') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <Folder />
</template>