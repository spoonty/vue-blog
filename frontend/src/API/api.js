import axios from 'axios';

const URL = 'https://blog/';

const getHeaders = () => {
    return {
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('my_token')
        }
    };
}

export const authRegister = async (data) => {
    return await axios.post(URL + 'auth/register', data, getHeaders());
}

export const authLogout = async () => {
    return await axios.post(URL + 'auth/logout', '', getHeaders());
}

export const authLogin = async (data) => {
    return await axios.post(URL + 'auth/login', data, getHeaders());
}

export const usersGetUser = async (id) => {
    return await axios.get(URL + 'users/' + id, getHeaders());
}

export const postsGetPost = async (id) => {
    return await axios.get(URL + 'posts/' + id, getHeaders());
}