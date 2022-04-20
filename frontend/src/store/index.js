import {createStore} from "vuex";
import post from './post';
import user from './user'

export default createStore({
    modules: {
        post,
        user
    }
})