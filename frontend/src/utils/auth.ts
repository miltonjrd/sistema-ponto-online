import { Agent } from "http";
import axios from "./axios";

// helper para checar se o usuário está autenticado
const auth = async (token: string): Promise<boolean> => {
    // force ipv4
    const httpAgent = new Agent({ family: 4 });

    try {
        await axios({
            url: '/admin/me', 
            method: 'get',
            headers: {
                Authorization: 'Bearer ' + token
            },
            httpAgent
        });
    } catch (err: unknown) {
        return false;
    }
    return true;
};

export default auth;