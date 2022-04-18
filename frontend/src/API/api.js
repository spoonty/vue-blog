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

export const usersGetUsers = async () => {
    return await axios.get(URL + 'users', getHeaders());
}

export const usersGetUser = async (id) => {
    return await axios.get(URL + 'users/' + id, getHeaders());
}

export const usersFollowUser = async (id) => {
    return await axios.post(URL + 'users/' + id + '/follow', '', getHeaders());
}

export const postsGetPost = async (id) => {
    return await axios.get(URL + 'posts/' + id, getHeaders());
}

export const postsAddPost = async (data, id) => {
    return await axios.post(URL + 'posts/' + id, data, getHeaders());
}

export const postsDeletePost = async (id) => {
    return await axios.delete(URL + 'posts/' + id, getHeaders());
}

export const postsLikePost = async (id) => {
    return await axios.post(URL + 'posts/' + id + '/like', '', getHeaders());
}