export class Profile {

    public static getProfile(): ProfileInterface
    {
        return {
            name: 'Admin',
            email: 'admin@admin.com',
            isAdmin: true,
        } as ProfileInterface
    }
}

export interface ProfileInterface {
    name: string
    email: string
    isAdmin: boolean
}
