import axios from 'axios';

const API = 'api/graphics';

export async function getGraphicsLastYears(){
    return axios.get(`${API}/last-years`);
}
