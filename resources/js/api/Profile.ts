import axios, {AxiosResponse} from "axios";
import {API_VERSION} from "../config";

export interface ProfileInterface {
    isAuthorized: boolean,
    name: string,
    email: string,
    isAdmin: boolean,
    isBanned: boolean,
}

export interface AuthData {
    readonly email: string,
    readonly password: string,
    readonly remember: boolean,
}

interface AuthResult {
    readonly status: number,
    readonly profile: ProfileInterface,
    readonly errors: string[],
}

export class Profile {

    public static async check(): Promise<AuthResult> {
        await axios.get('sanctum/csrf-cookie');
        return this._bindResponse(await axios.post('api/' + API_VERSION + '/auth/check'));
    }

    public static async authorize(authData?: AuthData): Promise<AuthResult> {
        return this._bindResponse(await axios.post('api/' + API_VERSION + '/auth/login', authData)) as AuthResult;
    }

    private static _bindResponse(response: AxiosResponse): AuthResult {
        let status: number = 404;
        let profile: ProfileInterface;
        let errors: string[] = [];

        if (typeof response.data.meta === 'object' && typeof response.data.meta.status === 'number') {
            status = response.data.meta.status;
        }

        if (typeof response.data.profile === "object") {
            profile = {
                isAuthorized: typeof response.data.profile.isAuthorized === 'boolean' ? response.data.profile.isAuthorized : false,
                name: typeof response.data.profile.isAuthorized === 'string' ? response.data.profile.name : '',
                email: typeof response.data.profile.email === 'string' ? response.data.profile.email : '',
                isAdmin: typeof response.data.profile.isAdmin === 'boolean' ? response.data.profile.isAdmin : '',
                isBanned: typeof response.data.profile.isBanned === 'boolean' ? response.data.profile.isBanned : '',
            } as ProfileInterface
        } else {
            profile = {
                isAuthorized: false,
                name: '',
                email: '',
                isAdmin: false,
                isBanned: false,
            } as ProfileInterface
        }

        if (response.data.errors instanceof Array) {
            errors = response.data.errors;
        }

        return {
            status: status,
            profile: profile as ProfileInterface,
            errors: errors,
        } as AuthResult
    }
}
