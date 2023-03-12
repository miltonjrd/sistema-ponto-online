import { ReactElement } from "react";
import { NextPageWithLayout } from "./_app";
import axios from '@/utils/axios';
import toast from 'react-hot-toast';

import Layout from "@/components/common/Layout";

const Home: NextPageWithLayout = () => {
    const handleButtonClick = () => {
        toast.promise(axios.post('/employees/clockin'), {
            loading: 'Enviando requisição...',
            error: 'Não foi possível registrar o seu ponto, tente novamente.',
            success: 'Você bateu o ponto de hoje. Retorne amanhã.'
        });
    };

    return (
        <main className="pt-10 text-center">
            <h3>Bem vindo, funcionário!</h3>
            <p>Utilize o botão abaixo para bater o ponto de hoje.</p>
            <button type="button" className="bg-blue-500 hover:bg-blue-600 py-2 px-4 text-white mt-4" onClick={handleButtonClick}>
                Bater ponto
            </button>
        </main>
    );
};

Home.getLayout = (page: ReactElement) => {
    return (
        <Layout>
            {page}
        </Layout>
    );
};

export default Home;