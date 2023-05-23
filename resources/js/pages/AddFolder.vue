<script setup>
import { useUserStore } from '../stores/storeUser';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import { ref } from 'vue';
const store = useUserStore();
const addFolder = async () => {
    folder.value.startDate = formatearFecha(new Date(folder.value.startDate));
    folder.value.endDate = formatearFecha(new Date(folder.value.endDate));
    if (await store.newFolder(folder.value) || true) {
        bootstrap.Modal.getInstance(document.getElementById('addFolder')).hide();
    }
}
const folder = ref({
    name: '',
    description: '',
    startDate: '',
    endDate: '',
})
const formatearFecha = (fecha) => {
    const day = fecha.getDate();
    const month = fecha.getMonth() + 1;
    const year = fecha.getFullYear();
    return `${day}-${month}-${year}`;
}
</script>
<template>
    <div class="modal fade" id="addFolder" tabindex="-1" aria-labelledby="addFolderLabel" aria-hidden="true">
        <div class="modal-dialog" role="form">
            <div class="modal-content">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h1 class="fw-bold mb-0 fs-2">Crear Carpeta</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5 pt-0">
                    <form class="">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" v-model="folder.name">
                            <label for="name">Nombre</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" v-model="folder.description">
                            <label for="description">descripcion</label>
                        </div>
                        <div class="form-floating mb-3">
                            <div class="col-6">
                                <label for="startDate">Fecha de inicio</label>
                                <VueDatePicker id="startDate" v-model="folder.startDate" :format="formatearFecha" auto-apply
                                    :enable-time-picker="false" />
                            </div>
                            <div class="col-6">
                                <label for="endDate">Fecha de fin</label>
                                <VueDatePicker id="endDate" v-model="folder.endDate" :format="formatearFecha" auto-apply
                                    :enable-time-picker="false" />
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="file" ref="fileInput" accept="image/*">
                        </div>
                        <div class="form-group m-5">
                            <button @click.prevent="addFolder" class="w-100 mb-2 btn btn-lg rounded-3 btn-primary"
                                type="submit">Agregar</button>
                        </div>
                        <hr class="my-4">
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>