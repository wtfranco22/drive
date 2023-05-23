<script setup>
import { useUserStore } from '../stores/storeUser';
import { ref } from 'vue';
const store = useUserStore();
const addFileToFolder = async () => {
    if (await store.newFile(file.value) || true) {
        bootstrap.Modal.getInstance(document.getElementById('addFile')).hide();
        location.reload();
    }
}
const file = ref({
    name:'',
    format:'',
})
</script>
<template>
    <div class="modal fade" id="addFile" tabindex="-1" aria-labelledby="addFileLabel" aria-hidden="true">
        <div class="modal-dialog" role="form">
            <div class="modal-content">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h1 class="fw-bold mb-0 fs-2">Subir nuevo archivo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5 pt-0">
                    <form class="">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" v-model="file.name">
                            <label for="name">Nombre</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" v-model="file.format">
                            <label for="format">Formato</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="file" ref="fileInput" accept="*/*">
                        </div>
                        <div class="form-group m-5">
                            <button @click.prevent="addFileToFolder" class="w-100 mb-2 btn btn-lg rounded-3 btn-primary"
                                type="submit">Agregar</button>
                        </div>
                        <hr class="my-4">
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>