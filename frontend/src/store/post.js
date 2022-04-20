import {postsGetPost} from "../API/api";

const defaultState = {
    posts: []
}

export default {
    state: {...defaultState},
    getters: {
        getPosts(state) {
            return state.posts.reverse();
        }
    },
    actions: {
        async fetchPosts(context, userId) {
            await postsGetPost(userId)
                .then(response => {
                    if (response.status === 200) {
                        context.commit('updatePosts', response.data);
                    }
                })
        }
    },
    mutations: {
        updatePosts(state, posts) {
            state.posts = posts;
        },
        resetState(state) {
            Object.assign(state, defaultState);
        }
    }
}
