import axios from "./axios";

// helper para checar se o usuário está autenticado
const auth = async (token: string): Promise<boolean> => {
    console.log(axios)
    try {
        await axios.get('/admin/me', {
            headers: {
                Authorization: 'Bearer' + token
            }
        });
    } catch (err: unknown) {
        return false;
    }
    return true;
};

export default auth;