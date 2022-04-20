import {authLogin, authLogout, usersGetUser} from "../API/api";

const defaultState = {
    profile: {},
    users: []
}

export default {
    state: {
        isAuth: localStorage.getItem('your_id') != null && localStorage.getItem('my_token') != null,
        ...defaultState},
    getters: {
        getIsAuth(state) {
            return state.isAuth;
        },
        getProfile(state) {
            return state.profile;
        }
    },
    actions: {
        async fetchGetProfile(context, userId) {
            await usersGetUser(userId)
                .then(response => {
                    if (response.status === 200) {
                        context.commit('updateProfile', response.data[0]);
                    }
                })
        },
        async fetchLogout(context) {
            return await authLogout()
                .then(response => {
                    if (response.status === 200) {
                        context.commit('setIsAuth', false);
                    }
                    return response;
                })
        },
        async fetchLogin(context, data) {
            return await authLogin(data)
                .then(response => {
                    if (response.status === 200) {
                        localStorage.setItem('my_token', response.data.token);
                        localStorage.setItem('your_id', response.data.id);
                        context.commit('setIsAuth', true);
                    }
                    return response;
                })
        }
    },
    mutations: {
        setIsAuth(state, isAuth) {
          state.isAuth = isAuth;
        },
        updateProfile(state, profile) {
            state.profile = profile;
        },
        resetState (state) {
            Object.assign(state, defaultState)
        }
    }
}