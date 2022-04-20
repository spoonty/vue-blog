import {postsAddPost, postsDeletePost, postsGetPost, postsLikePost} from "../API/api";

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
        async fetchGetPosts(context, userId) {
            await postsGetPost(userId)
                .then(response => {
                    if (response.status === 200) {
                        context.commit('updatePosts', response.data);
                    }
                })
        },
        async fetchAddPost(context, params) {
            const data = params.data;
            const userId = params.userId;

            await postsAddPost(data, userId)
                  .then(async response => {
                    if (response.status === 200) {
                      await this.dispatch('fetchGetPosts', userId);
                    }
                  })
        },
        async fetchDeletePost(context, params) {
            const postId = params.postId;
            const userId = params.userId;

            await postsDeletePost(postId)
                .then(async response => {
                    if (response.status === 200) {
                        await this.dispatch('fetchGetPosts', userId);
                    }
                })
        },
        async fetchLikePost(context, params) {
            const postId = params.postId;
            const userId = params.userId;

            await postsLikePost(postId)
                .then(async response => {
                    if (response.status === 200) {
                        await this.dispatch('fetchGetPosts', userId);
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
