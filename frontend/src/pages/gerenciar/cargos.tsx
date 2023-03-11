import { ReactElement, useState, useContext } from "react";
import { NextPageWithLayout } from "../_app";

// components
import Layout from "@/components/common/Layout";
import CreateRoleModal from "@/components/modules/CreateRoleModal";

// icons
import { BiPlus } from "react-icons/bi";
import { BsTrash } from "react-icons/bs";
import { TiEdit } from "react-icons/ti";

// custom hooks
import useApi from "@/hooks/useApi";

// interfaces
import Role from "@/interfaces/Role";

const ManageRoles: NextPageWithLayout = () => {
    const [modalsState, setModalsState] = useState({
        CREATE_ROLE_MODAL_SHOW: false
    });

    const { data: roles, isLoading, mutate } = useApi<Role[]>('/roles');

    return (
        <main className="container flex flex-col items-center mx-auto px-4 pt-10">
            <h4>Cargos</h4>
            <div>
                <button 
                    type="button" 
                    className="flex bg-blue-500 hover:bg-blue-600 active:bg-blue-700 text-white py-2 px-4 rounded-md"
                    onClick={() => setModalsState((state) => ({
                        ...state,
                        CREATE_ROLE_MODAL_SHOW: true
                    }))}
                >
                    <BiPlus className="mr-2" size={24} />
                    Novo cargo
                </button>
                <div className="overflow-x-auto max-w-full mt-5">
                    <table className="w-[900px] table-fixed">
                        <thead>
                            <tr className="bg-gray-100">
                                <th className="text-sm text-gray-600 font-normal py-3">#</th>
                                <th className="text-sm text-gray-600 font-normal py-3">Nome do cargo</th>
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
                                </tr>
                            )) :
                            roles?.map((role, i) => (
                                <tr key={role.id}>
                                    <td className="text-center py-3">{role.id}</td>
                                    <td className="text-center py-3">{role.title}</td>
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
            <CreateRoleModal 
                show={modalsState.CREATE_ROLE_MODAL_SHOW} 
                close={() => setModalsState((state) => ({ 
                    ...state,
                    CREATE_ROLE_MODAL_SHOW: false
                }))} 
            />
        </main>
    );
};

ManageRoles.getLayout = (page: ReactElement) => {
    return (
        <Layout>
            {page}
        </Layout>
    );
};

export default ManageRoles;