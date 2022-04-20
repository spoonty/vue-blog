import {
    authLogin,
    authLogout,
    authRegister,
    usersEditUser,
    usersFollowUser,
    usersGetUser,
    usersGetUsers
} from "../API/api";

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
        },
        getFollowedUsers(state) {
            const yourId = localStorage.getItem('your_id');
            return state.users.filter(u => u.followed === true && u.userId != yourId);
        },
        getUnfollowedUsers(state) {
            const yourId = localStorage.getItem('your_id');
            return state.users.filter(u => u.followed === false && u.userId != yourId);
        }
    },
    actions: {
        async fetchGetProfile(context, params) {
            const userId = params.userId;
            const returnData = params.returnData;

            return await usersGetUser(userId)
                .then(response => {
                    if (response.status === 200 && returnData === false) {
                        context.commit('updateProfile', response.data[0]);
                    }
                    else {
                        return response;
                    }
                })
        },
        async fetchGetUsers(context) {
            await usersGetUsers()
                .then(response => {
                    if (response.status === 200) {
                        context.commit('updateUsers', response.data);
                    }
                })
        },
        async fetchFollowUser(context, userId) {
            await usersFollowUser(userId)
                .then(async response => {
                    if (response.status === 200) {
                        await this.dispatch('fetchGetUsers');
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
        },
        async fetchRegister(context, data) {
            return await authRegister(data)
                .then(response => {
                    if (response.status === 200) {
                        localStorage.setItem('my_token', response.data.token);
                        localStorage.setItem('your_id', response.data.id);
                        context.commit('setIsAuth', true);
                    }
                    return response;
                })
        },
        async fetchEdit(context, params) {
            const userId = params.userId;
            const data = params.data;

            return await usersEditUser(data, userId);
        }
    }
    ,
    mutations: {
        setIsAuth(state, isAuth) {
          state.isAuth = isAuth;
        },
        updateProfile(state, profile) {
            state.profile = profile;
        },
        updateUsers(state, users) {
          state.users = users;
        },
        resetState (state) {
            Object.assign(state, defaultState)
        }
    }
}