import axios, {AxiosResponse} from "axios";
import {API_VERSION} from "../config";
import {ProfileInterface} from "../store/modules/profile";

export interface AuthData {
    readonly email: string,
    readonly password: string,
    readonly remember: boolean,
}

export interface AuthResult {
    readonly status: number,
    readonly profile: ProfileInterface,
    readonly errors: readonly string[],
}

export class Profile {

    public static async check(): Promise<AuthResult> {
        await axios.get('sanctum/csrf-cookie');
        return this._bindResponse(await axios.post(this._buildLink('auth/check')));
    }

    public static async authorize(authData?: AuthData): Promise<AuthResult> {
        return this._bindResponse(await axios.post(this._buildLink('auth/login'), authData));
    }

    public static async logout(): Promise<void> {
        await axios.post(this._buildLink('auth/logout'));
        return;
    }

    private static _buildLink(link: string): string {
        return 'api/' + API_VERSION + '/' + link.trim();
    }

    private static _bindResponse(response: AxiosResponse): AuthResult {
        let status: number = 404;
        let profile: ProfileInterface;
        let errors: readonly string[] = [];

        if (typeof response.data.meta === 'object' && typeof response.data.meta.status === 'number') {
            status = response.data.meta.status;
        }

        if (typeof response.data.profile === "object") {
            profile = {
                isAuthorized: typeof response.data.profile.isAuthorized === 'boolean' ? response.data.profile.isAuthorized : false,
                name: typeof response.data.profile.name === 'string' ? response.data.profile.name : '',
                email: typeof response.data.profile.email === 'string' ? response.data.profile.email : '',
                isAdmin: typeof response.data.profile.isAdmin === 'boolean' ? response.data.profile.isAdmin : '',
                isBanned: typeof response.data.profile.isBanned === 'boolean' ? response.data.profile.isBanned : '',
            }
        } else {
            profile = {
                isAuthorized: false,
                name: '',
                email: '',
                isAdmin: false,
                isBanned: false,
            }
        }

        if (response.data.errors instanceof Array) {
            errors = response.data.errors;
        }

        return {
            status: status,
            profile: profile,
            errors: errors,
        }
    }
}
