import {Profile, ProfileInterface} from "../api/Profile";
import {Store} from "vuex";

export default {
    state: {
        isAuthorized: false,
        name: '',
        email: '',
        isAdmin: false,
        isBanned: false,
    } as ProfileInterface,
    getters: {},
    mutations: {
        setProfile(state: ProfileInterface, profile: ProfileInterface): void {
            state = {...profile};
        },
    },
    actions: {
        async init(context: Store<any>) {
            context.commit('setProfile', await Profile.authorize());
        }
    }
}
