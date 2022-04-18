import axios from 'axios';

const URL = 'https://blog/';
const headers = {
    headers: {
        'Authorization': 'Bearer ' + localStorage.getItem('my_token')
    }
};

export const authRegister = async (data) => {
    return await axios.post(URL + 'auth/register', data, headers);
}

export const authLogout = async () => {
    return await axios.post(URL + 'auth/logout', '', headers);
}

export const authLogin = async (data) => {
    return await axios.post(URL + 'auth/login', data, headers);
}