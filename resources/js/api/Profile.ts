import axios from "axios";
import {API_VERSION} from "../config";

interface ProfileInterface {

    getName(): string;

    getEmail(): string;

    isAdmin(): boolean;

    isBanned(): boolean;
}

export class Profile {

    public static async authorize(): Promise<void>
    {
        await axios.get('sanctum/csrf-cookie');
        await axios.post('api/login', {
            email: 'admin4k@admin.com',
            password: '{{ $error }}',
            spa: 'spa'
        });
    }

    public static async getProfile(): Promise<ProfileInterface> {
        const response = await axios.get('api/' + API_VERSION + '/getProfile');
        return {
            getName(): string {
                return response.data.name;
            },
            getEmail(): string {
                return response.data.email;
            },
            isAdmin(): boolean {
                return response.data.isAdmin;
            },
            isBanned(): boolean {
                return response.data.isBanned;
            },
        } as ProfileInterface;
    }
}
