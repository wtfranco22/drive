import { ref } from 'vue';
import axios from 'axios';
import { defineStore } from 'pinia';
import router from '../routes/index';
import { useRoute } from 'vue-router';

export const useUserStore = defineStore('user', () => {
    const user = ref({
        name: sessionStorage.getItem('name'),
        role: sessionStorage.getItem('role'),
        token: sessionStorage.getItem('token'),
    });
    const route = useRoute();
    const folders = ref(false);
    const users = ref(false);
    const files = ref(false);
    const loading = ref(false);
    const login = async (userFormData) => {
        let access = false;
        await axios({
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Access-Control-Allow-Origin': '*',
                'Access-Control-Allow-Methods': 'GET, POST',
                'Access-Control-Allow-Headers': 'Origin, Content-Type, X-Auth-Token'
            },
            method: 'POST',
            url: 'http://localhost:8000/api/login',
            data: {
                email: userFormData.email,
                password: userFormData.password
            }
        })
            .then(response => {
                if (response.data.status) {
                    access = true;
                    user.value.token = response.data.access_token;
                    user.value.role = response.data.role;
                    user.value.name = response.data.name;
                    sessionStorage.setItem('name', response.data.name);
                    sessionStorage.setItem('role', response.data.role);
                    sessionStorage.setItem('token', user.value.token);
                    router.push('/Home');
                }
            })
            .catch(error => {
                console.log(error);
            });
        return access;
    };
    const getFolders = async () => {
        loading.value = true;
        console.log(user.value.role == 'admin', user.value.role);
        let urlFolders = (user.value.role == 'admin') ? 'http://localhost:8000/api/folders' : 'http://localhost:8000/api/my-folders';
        await axios({
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Access-Control-Allow-Origin': '*',
                'Access-Control-Allow-Methods': 'GET, POST',
                'Access-Control-Allow-Headers': 'Origin, Content-Type, X-Auth-Token',
                'Authorization': 'Bearer ' + user.value.token
            },
            method: 'GET',
            url: urlFolders,
        })
            .then(response => {
                if (response.data) {
                    let data = response.data.folders;
                    folders.value = data
                    console.log(response.data);
                }
            })
            .catch(error => {
                console.log(error);
            });
        loading.value = false;
    };
    const getFiles = async () => {
        loading.value = true;
        let folderId = route.params.id;
        let urlFiles = (user.value.role == 'admin') ? 'http://localhost:8000/api/folders/' + folderId : 'http://localhost:8000/api/my-files/' + folderId;
        await axios({
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Access-Control-Allow-Origin': '*',
                'Access-Control-Allow-Methods': 'GET, POST',
                'Access-Control-Allow-Headers': 'Origin, Content-Type, X-Auth-Token',
                'Authorization': 'Bearer ' + user.value.token
            },
            method: 'GET',
            url: urlFiles,
        })
            .then(response => {
                if (response.data) {
                    if (user.value.role == 'user') {
                        let data = response.data;
                        files.value = data;
                    } else {
                        let dataFiles = response.data.files;
                        let dataUsers = response.data.users;
                        users.value = dataUsers;
                        files.value = dataFiles;
                    }
                }
            })
            .catch(error => {
                console.log(error);
            });
        loading.value = false;
    };
    const addUserToFolder = async (userId) => {
        loading.value = true;
        let folderId = route.params.id;
        await axios({
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Access-Control-Allow-Origin': '*',
                'Access-Control-Allow-Methods': 'GET, POST',
                'Access-Control-Allow-Headers': 'Origin, Content-Type, X-Auth-Token',
                'Authorization': 'Bearer ' + user.value.token
            },
            method: 'POST',
            url: 'http://localhost:8000/api/folder-user/add-user',
            data: {
                id_user: userId,
                id_folder: folderId
            }
        })
            .then(response => {
                if (response.data) {
                    console.log(response.data);
                }
            })
            .catch(error => {
                console.log(error);
            });
        loading.value = false;
    }
    const getUsers = async () => {
        loading.value = true;
        const route = useRoute();
        let folderId = route.params.id;
        await axios({
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Access-Control-Allow-Origin': '*',
                'Access-Control-Allow-Methods': 'GET, POST',
                'Access-Control-Allow-Headers': 'Origin, Content-Type, X-Auth-Token',
                'Authorization': 'Bearer ' + user.value.token
            },
            method: 'GET',
            url: 'http://localhost:8000/api/folders/no-access/' + folderId,
        })
            .then(response => {
                if (response.data) {
                    let data = response.data;
                    users.value = data.users;
                }
            })
            .catch(error => {
                console.log(error);
            });
        loading.value = false;
    };
    const downloadFile = async (fileId) => {
        loading.value = true;
        let folderId = route.params.id;
        let urlFiles = 'http://localhost:8000/api/status-file';
        await axios({
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Access-Control-Allow-Origin': '*',
                'Access-Control-Allow-Methods': 'GET, POST',
                'Access-Control-Allow-Headers': 'Origin, Content-Type, X-Auth-Token',
                'Authorization': 'Bearer ' + user.value.token
            },
            method: 'POST',
            url: urlFiles,
            data: {
                id_file: fileId,
                id_folder: folderId
            }
        })
            .then(response => {
                if (response.data) {
                    let data = response.data;
                    console.log(data)
                    location.reload();
                }
            })
            .catch(error => {
                console.log(error);
            });
        loading.value = false;
    }
    const logout = () => {
        axios({
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                refresh: true,
                'Access-Control-Allow-Origin': '*',
                'Access-Control-Allow-Methods': 'GET, POST',
                'Access-Control-Allow-Headers': 'Origin, Content-Type, X-Auth-Token',
                'Authorization': 'Bearer ' + user.value.token
            },
            method: 'GET',
            url: 'http://localhost:8000/api/logout'
        })
            .then(response => {
                console.log(response.data);
                user.value.token = null;
                user.value.name = null;
                user.value.role = null;
                sessionStorage.removeItem('token');
                sessionStorage.removeItem('name');
                sessionStorage.removeItem('role');
                router.push('/Login');
            })
            .catch(error => {
                console.log(error);
            });
    };
    const registerUser = async (usuario) => {
        var registrado = false;
        await axios({
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Access-Control-Allow-Origin': '*',
                'Access-Control-Allow-Methods': 'GET, POST, PUT, DELETE, OPTIONS',
                'Access-Control-Allow-Headers': 'Origin, Content-Type, X-Auth-Token'
            },
            method: 'POST',
            url: 'http://localhost:8000/api/register',
            data: {
                name: usuario.nombre,
                lastname: usuario.apellido,
                dni: usuario.documento,
                email: usuario.correo,
                phone: usuario.celular,
                password: usuario.contrasenia,
                password_confirmation: usuario.contrasenia2
            }
        })
            .then(response => {
                if (response.data.status) {
                    registrado = true;
                }
            })
            .catch(error => {
                if (error.response) {
                    //el servidor avisa que hubo un error de datos
                    console.log('llego al servidor pero devolvio error');
                    console.log('Data', error.response.data);
                    console.log('Status', error.response.status);
                    console.log('Headers', error.response.headers);
                } else if (error.request) {
                    //se solicita la peticion pero el servidor no responde
                    console.log('Se envio pero no hubo respuesta');
                    console.log('Request', error.request);
                } else {
                    console.log('Falllo por otra cosa');
                    console.log('message!', error.message);
                }
                console.log(error.config);
            });
        return registrado;
    };
    const newFolder = async (folderData) => {
        await axios({
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'multipart/form-data',
                'Content-Type': 'application/json',
                'Access-Control-Allow-Origin': '*',
                'Access-Control-Allow-Methods': 'GET, POST, PUT, DELETE, OPTIONS',
                'Access-Control-Allow-Headers': 'Origin, Content-Type, X-Auth-Token',
                'Authorization': 'Bearer ' + user.value.token
            },
            method: 'POST',
            url: 'http://localhost:8000/api/folders',
            data: {
                name: folderData.name,
                url: folderData.url,
                description: folderData.description,
                start_date: folderData.startDate,
                end_date: folderData.endDate
            }
        })
            .then(response => {
                if (response.data.status) {
                    router.push('/');
                }
            })
            .catch(error => {
                console.log(error);
            });
    };
    return {
        user,
        users,
        files,
        folders,
        loading,
        login,
        getFolders,
        getFiles,
        getUsers,
        newFolder,
        registerUser,
        logout,
        addUserToFolder,
        downloadFile,
    };
});