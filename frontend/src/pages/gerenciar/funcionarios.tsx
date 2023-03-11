import { ReactElement, useState } from 'react';

import type { NextPageWithLayout } from '../_app';

// components
import CreateEmployeeModal from '@/components/modules/CreateEmployeeModal.tsx';
import Layout from '@/components/common/Layout';

// icons
import { BsTrash } from 'react-icons/bs';
import { TiEdit } from 'react-icons/ti';
import { BiPlus } from 'react-icons/bi';

const ManageEmployees: NextPageWithLayout = () => {
    const [modalsState, setModalsState] = useState({
        CREATE_EMPLOYEE_MODAL_SHOW: false
    });

    return (
        <main className="container flex flex-col items-center mx-auto px-4 pt-10">
            <h4>Funcionários</h4>
            <div>
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
                <div className="overflow-x-auto max-w-full mt-5">
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
                            {new Array(5).fill(0).map((_, i) => (
                                <tr>
                                    <td className="text-center py-3">{i}</td>
                                    <td className="text-center py-3">Francisco Silva</td>
                                    <td className="text-center py-3">EMPACOTADOR</td>
                                    <td className="text-center py-3">37</td>
                                    <td className="text-center py-3">ZÉ MANÉ</td>
                                    <td className="py-3">
                                        <div className="flex justify-around">
                                            <button type="button" className="text-red-500 hover:bg-red-50 active:bg-red-100 p-2 rounded-md">
                                                <BsTrash />
                                            </button>
                                            <button type="button" className="text-blue-500 hover:bg-blue-50 active:bg-blue-100 p-2 rounded-md">
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