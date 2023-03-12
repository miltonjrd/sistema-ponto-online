import { ChangeEvent, FormEvent, FC, useState, useContext, useEffect } from 'react';
import { AxiosError } from 'axios';
import axios from '@/utils/axios';
import toast from 'react-hot-toast';

// components
import SpinnerButton from '@/components/common/SpinnerButton';

// custom hooks
import useApi from '@/hooks/useApi';

// interfaces
import Role from '@/interfaces/Role';
import Employee from '@/interfaces/Employee';

type FormProps = {
    name: string,
    age: number,
    role_id: number,
    [key: string]: any
};

type Props = {
    employeeId: number
    closeModal(): void
};

const Form: FC<Props> = ({ closeModal, employeeId }) => {
    const [isSubmiting, setIsSubmiting] = useState<boolean>(false);
    const [form, setForm] = useState<FormProps>({
        name: '',
        age: 0,
        role_id: 0,
    });

    const { data: roles } = useApi<Role[]>('/roles', { revalidateOnFocus: false });
    const { data: employee, isLoading } = useApi<Employee>(`/employees/${employeeId}`, { revalidateOnFocus: false });

    const handleInputChange = (evt: ChangeEvent<HTMLInputElement>) => {
        const key = evt.target.name;
        const value = evt.target.value;

        setForm((state) => ({
            ...state,
            [key]: value
        }));
    };

    const handleSelectChange = (evt: ChangeEvent<HTMLSelectElement>) => {
        const key = evt.target.name;
        const value = evt.target.value;

        setForm((state) => ({
            ...state,
            [key]: value
        }));
    };

    const handleSubmit = async (evt: FormEvent) => {
        evt.preventDefault();

        try {
            setIsSubmiting(true);
            const response = await axios.put(`/employees/${employeeId}`, form);
            toast.success(response.data.message);
            closeModal();
        } catch (err: unknown) {
            if (err instanceof AxiosError) {
                toast.error(err.response?.data.message);
            }
        }

        setIsSubmiting(false);
    };

    useEffect(() => {
        if (employee)
            setForm(() => ({
                name: employee.name,
                age: employee.age,
                role_id: employee.role_id
            }));
    }, [employee]);

    return (
        <form className="flex flex-col gap-4 w-full lg:w-[700px]" onSubmit={handleSubmit}>
            <h4>Editando funcionário...</h4>
            {
                isLoading ?
                
                <>
                    <div className="py-8 bg-gray-300 mr-16 rounded-md animate-pulse" />
                    <div className="py-8 bg-gray-300 mr-16 rounded-md animate-pulse" />
                    <div className="py-8 bg-gray-300 mr-16 rounded-md animate-pulse" />
                </> :
                
                <>
                    <div>
                        <label className="text-sm" htmlFor="employee_name">Nome *:</label>
                        <input 
                            id="employee_name" 
                            name="name"
                            className="block w-full bg-gray-50 focus:bg-white border px-4 py-2 sm:py-3 rounded-md transition-colors" 
                            type="text" 
                            value={form.name}
                            onChange={handleInputChange}
                        />
                    </div>

                    <div>
                        <label className="text-sm" htmlFor="employee_age">Idade *:</label>
                        <input 
                            id="employee_age" 
                            name="age" 
                            className="block w-full bg-gray-50 focus:bg-white border px-4 py-2 sm:py-3 rounded-md transition-colors"
                            type="number" 
                            value={form.age}
                            onChange={handleInputChange}
                        />
                    </div>

                    <div>
                        <label className="text-sm" htmlFor="employee_role">Cargo *:</label>
                        <select 
                            id="employee_role" 
                            name="role_id" 
                            className="block border px-4 py-2 rounded-md"
                            onChange={handleSelectChange}
                            value={form.role_id}
                        >
                            <option selected disabled value={0}>Selecione</option>
                            {roles?.map((role) => (
                                <option key={role.id} value={role.id}>{role.title}</option>
                            ))}
                        </select>
                    </div>
                </>
            }
            
            <div className="flex justify-between">
                <button type="reset" className="text-red-500 hover:bg-red-50 active:bg-red-100 px-4 py-2 rounded-md transition-colors">
                    Resetar
                </button>
                <SpinnerButton active={isSubmiting} disabled={isSubmiting}>
                    Salvar
                </SpinnerButton>
            </div>
        </form>
    );
};

export default Form;