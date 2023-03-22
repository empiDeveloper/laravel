import axios from 'axios';

const API = 'api/publicaciones';

export async function getData(params) {
    return axios.get(`${API}/listar`, { params });
}
