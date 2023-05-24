import axios from 'axios';

export async function getSellers(params){
    return axios.get('api/sellers', { params });
}
