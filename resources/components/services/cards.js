import axios from 'axios';

export async function getDataCards(){
    return axios.get('api/cards');
}
