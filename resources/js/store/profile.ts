import {AuthData, Profile, ProfileInterface} from "../api/Profile";
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
            state.isAuthorized = profile.isAuthorized;
            state.name = profile.name;
            state.email = profile.email;
            state.isAdmin = profile.isAdmin;
            state.isBanned = profile.isBanned;
        },
    },
    actions: {
        async init(context: Store<any>) {
            const result = await Profile.authorize();
            if (result.status === 200) {
                context.commit('setProfile', result.profile);
            }
        },
        async login(context: Store<any>, data: AuthData) {
            const result = await Profile.authorize(data)
            context.commit('setProfile', result.profile);
            return result;
        }
    }
}
