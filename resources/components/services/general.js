import axios from 'axios';

const API = 'api/general';

export async function getGeneralStatistics(){
    return axios.get(`${API}/statistics`);
}
