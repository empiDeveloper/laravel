import axios from 'axios';

const API = 'api/graphics';

export async function getGraphicsLastYears(){
    return axios.get(`${API}/last-years`);
}

export function getGraphicCatalog(){
    return axios.get(`${API}/catalog`);
}

export function getGraphicStores() {
    return axios.get(`${API}/stores`);
}
