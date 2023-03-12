import { ReactElement, useState } from 'react';
import { GetServerSideProps } from 'next';
import type { NextPageWithLayout } from '../_app';
import axios from '@/utils/axios';
import auth from '@/utils/auth';
import toast from 'react-hot-toast';

// components
import CreateEmployeeModal from '@/components/modules/CreateEmployeeModal';
import EditEmployeeModal from '@/components/modules/EditEmployeeModal';
import Layout from '@/components/common/Layout';

// icons
import { BsTrash } from 'react-icons/bs';
import { TiEdit } from 'react-icons/ti';
import { BiPlus } from 'react-icons/bi';

// custom hooks
import useApi from '@/hooks/useApi';

// interfaces
import Employee from '@/interfaces/Employee';
import { AxiosError } from 'axios';

const ManageEmployees: NextPageWithLayout = () => {
    const [currentlyEditingEmployeeId, setCurrentlyEditingEmployeeId] = useState<number>(-1);
    const [modalsState, setModalsState] = useState({
        CREATE_EMPLOYEE_MODAL_SHOW: false
    });

    const { data: employees, mutate, isLoading } = useApi<Employee[]>('/employees');

    const handleEmployeeDelete = async (employeeId: number) => {
        await toast.promise(axios.delete(`/employees/${employeeId}`), {
            loading: 'Realizando operação...',
            error: 'Não foi possivel completar a operação.',
            success: 'Funcionário deletado com sucesso.'
        });

        // re-render data
        mutate();
    };

    return (
        <main className="container flex flex-col items-center mx-auto px-4 pt-10">
            <h4>Funcionários</h4>
            <div className="max-w-full">
                <button 
                    type="button" 
                    className="flex bg-blue-500 hover:bg-blue-600 active:bg-blue-700 text-white py-2 px-4 rounded-md"
                    onClick={() => setModalsState((state) => ({
                        ...state,
                        CREATE_EMPLOYEE_MODAL_SHOW: true
                    }))}
                >
                    <BiPlus className="mr-2" size={24} />
                    Novo funcionário
                </button>
                <div className="overflow-x-auto w-full mt-5">
                    <table className="w-[900px] table-fixed">
                        <thead>
                            <tr className="bg-gray-100">
                                <th className="text-sm text-gray-600 font-normal py-3">#</th>
                                <th className="text-sm text-gray-600 font-normal py-3">Nome</th>
                                <th className="text-sm text-gray-600 font-normal py-3">Cargo</th>
                                <th className="text-sm text-gray-600 font-normal py-3">Idade</th>
                                <th className="text-sm text-gray-600 font-normal py-3">Nome do gestor</th>
                                <th className="text-sm text-gray-600 font-normal py-3">-</th>
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
                            
                            employees?.map((employee, i) => (
                                <tr>
                                    <td className="text-center py-3">{employee.id}</td>
                                    <td className="text-center py-3">{employee.name}</td>
                                    <td className="text-center py-3">{employee.role}</td>
                                    <td className="text-center py-3">{employee.age}</td>
                                    <td className="text-center py-3">{employee.manager_name}</td>
                                    <td className="py-3">
                                        <div className="flex justify-around">
                                            <button 
                                                type="button" 
                                                title="Excluir" 
                                                className="text-red-500 hover:bg-red-50 active:bg-red-100 p-2 rounded-md"
                                                onClick={() => handleEmployeeDelete(employee.id)}
                                            >
                                                <BsTrash />
                                            </button>
                                            <button 
                                                type="button" 
                                                title="Editar" 
                                                className="text-blue-500 hover:bg-blue-50 active:bg-blue-100 p-2 rounded-md"
                                                onClick={() => setCurrentlyEditingEmployeeId(employee.id)}
                                            >
                                                <TiEdit />
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            </div>
            <CreateEmployeeModal 
                show={modalsState.CREATE_EMPLOYEE_MODAL_SHOW} 
                close={() => setModalsState((state) => ({ 
                    ...state,
                    CREATE_EMPLOYEE_MODAL_SHOW: false
                }))} 
            />
            <EditEmployeeModal
                show={currentlyEditingEmployeeId !== -1}
                close={() => setCurrentlyEditingEmployeeId(-1)}
                employeeId={currentlyEditingEmployeeId}
            />
        </main>
    );
};

ManageEmployees.getLayout = (page: ReactElement) => {
    return (
        <Layout>
            {page}
        </Layout>
    );
};

export default ManageEmployees;

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