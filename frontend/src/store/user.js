import {usersGetUser} from "../API/api";

const defaultState = {
    isAuth: false,
    profile: {},
    users: []
}

export default {
    state: {...defaultState},
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
        }
    },
    mutations: {
        updateProfile(state, profile) {
            state.profile = profile;
        },
        resetState (state) {
            Object.assign(state, defaultState)
        }
    }
}