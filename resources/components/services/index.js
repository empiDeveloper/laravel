import axios from 'axios';

const API = 'api/users';

export async function getData(params) {
    return axios.get(`${API}/listar`, { params });
}
