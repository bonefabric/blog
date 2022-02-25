import axios from "axios";
import {API_VERSION} from "../config";

export interface ProfileInterface {
    readonly isAuthorized: boolean,
    readonly name: string,
    readonly email: string,
    readonly isAdmin: boolean,
    readonly isBanned: boolean,
}

interface AuthData {
    readonly email: string,
    readonly password: string,
    readonly remember: boolean,
}

interface AuthResult {
    readonly status: number
    readonly profile: ProfileInterface
}

export class Profile {

    public static async authorize(authData?: AuthData): Promise<AuthResult> {
        await axios.get('sanctum/csrf-cookie');
        const result = await axios.post('api/' + API_VERSION + '/login', authData);
        return {
            status: result.data.meta.status,
            profile: {
                isAuthorized: result.data.isAuthorized,
                name: result.data.name,
                email: result.data.email,
                isAdmin: result.data.isAdmin,
                isBanned: result.data.isBanned,
            } as ProfileInterface,
        } as AuthResult
    }
}
