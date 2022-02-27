import {ActionContext, createStore} from "vuex";
import {ProfileInterface} from "./modules/profile";
import {AuthData, AuthResult, Profile} from "../api/Profile";


interface StoreState {
    profile: ProfileInterface,
}

export const store = createStore<StoreState>({
    state: {
        profile: {
            isAuthorized: false,
            name: '',
            email: '',
            isAdmin: false,
            isBanned: false,
        }
    },
    mutations: {
        setProfile(state: StoreState, profile: ProfileInterface) {
            state.profile = {...profile};
        },
        clearProfile(state: StoreState) {
            state.profile = {
                isAuthorized: false,
                name: '',
                email: '',
                isAdmin: false,
                isBanned: false,
            }
        }
    },
    actions: {
        async init(context: ActionContext<StoreState, StoreState>): Promise<void> {
            const result = await Profile.check();
            if (result.status === 200) {
                context.commit('setProfile', result.profile);
            }
        },
        async login(context: ActionContext<StoreState, StoreState>, data: AuthData): Promise<AuthResult> {
            context.commit('clearProfile');
            const result = await Profile.authorize(data);
            if (result.status === 200) {
                context.commit('setProfile', result.profile);
            }
            return result;
        }
    }
});
