import { ReactElement } from "react";

// components
import Layout from "@/components/common/Layout";
import useApi from "@/hooks/useApi";

import auth from "@/utils/auth";
import { GetServerSideProps } from "next";

interface ClockIn { 
    id: number, 
    employee_name: string, 
    role: string, 
    age: number, 
    manager_name: string, 
    created_at: string 
}

const Checked = () => {
    const { data: checks, isLoading } = useApi<ClockIn[]>('/employees/clockin');

    return (
        <main className="container flex flex-col items-center mx-auto px-4 pt-10">
            <h4>Pontos batidos</h4>
            <table className="w-[900px] table-fixed">
                <thead>
                    <tr className="bg-gray-100">
                        <th className="text-sm text-gray-600 font-normal py-3">#</th>
                        <th className="text-sm text-gray-600 font-normal py-3">Nome</th>
                        <th className="text-sm text-gray-600 font-normal py-3">Cargo</th>
                        <th className="text-sm text-gray-600 font-normal py-3">Idade</th>
                        <th className="text-sm text-gray-600 font-normal py-3">Gestor</th>
                        <th className="text-sm text-gray-600 font-normal py-3">Hora / Data</th>
                    </tr>
                </thead>
                <tbody className="divide-y border">
                    {isLoading ?
                    new Array(10).fill(0).map((_, i) => (
                        <tr key={i} className="animate-pulse">
                            <td className="py-3">
                                <div className="mx-4 py-3 bg-gray-300 rounded-md" />
                            </td>
                            <td className="py-3">
                                <div className="mx-4 py-3 bg-gray-300 rounded-md" />
                            </td>
                            <td className="py-3">
                                <div className="mx-4 py-3 bg-gray-300 rounded-md" />
                            </td>
                            <td className="py-3">
                                <div className="mx-4 py-3 bg-gray-300 rounded-md" />
                            </td>
                            <td className="py-3">
                                <div className="mx-4 py-3 bg-gray-300 rounded-md" />
                            </td>
                            <td className="py-3">
                                <div className="mx-4 py-3 bg-gray-300 rounded-md" />
                            </td>

                        </tr>
                    )) :
                    checks?.map((check, i) => (
                        <tr key={check.id}>
                            <td className="text-center py-3">{check.id}</td>
                            <td className="text-center py-3">{check.employee_name}</td>
                            <td className="text-center py-3">{check.role}</td>
                            <td className="text-center py-3">{check.age}</td>
                            <td className="text-center py-3">{check.manager_name}</td>
                            <td className="text-center py-3">{check.created_at}</td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </main>
    );
};

Checked.getLayout = (page: ReactElement) => {
    return (
        <Layout>
            {page}
        </Layout>
    );
};

export default Checked;

export const getServerSideProps: GetServerSideProps = async (context) => {
    if (!context.req.cookies?.jwt_token || !await auth(context.req.cookies.jwt_token)) {
        return {
            redirect: {
                destination: '/admin/login',
                permanent: true
            }
        };
    }

    return {
        props: {}
    };
};