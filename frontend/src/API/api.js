import axios from 'axios';

const URL = 'https://blog/';

export const authRegister = async (data) => {
    return await axios.post(URL + 'auth/register', data);
}

export const authLogout = async () => {
    return await axios.post(URL + 'auth/logout', '', {
        headers: {
            'Authorization': localStorage.getItem('my_token')
        }
    });
}