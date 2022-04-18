import axios from 'axios';

const URL = 'https://blog/';

export const authRegister = async (data) => {
    console.log(data);
    console.log(URL + 'auth/register');
    return await axios.post(URL + 'auth/register', data);
}