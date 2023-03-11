import { ChangeEvent, FormEvent, FC, useState, useContext } from 'react';
import axios from '@/utils/axios';
import toast from 'react-hot-toast';

// components
import SpinnerButton from '@/components/common/SpinnerButton';

// custom hooks
import useApi from '@/hooks/useApi';

// interfaces
import Role from '@/interfaces/Role';
import { AxiosError } from 'axios';

type FormProps = {
    name: string,
    age: string,
    role_id: number,
    password: string,
    [key: string]: any
};

type Props = {
    closeModal(): void
};

const Form: FC<Props> = ({ closeModal }) => {
    const [isSubmiting, setIsSubmiting] = useState<boolean>(false);
    const [form, setForm] = useState<FormProps>({
        name: '',
        age: '',
        role_id: 0,
        password: ''
    });

    const { data: roles } = useApi<Role[]>('/roles');

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
            const response = await axios.post('/employees', form);
            toast.success(response.data.message);
            closeModal();
        } catch (err: unknown) {
            if (err instanceof AxiosError) {
                toast.error(err.response?.data.message);
            }
        }

        setIsSubmiting(false);
    };

    return (
        <form className="flex flex-col gap-4 w-full lg:w-[700px]" onSubmit={handleSubmit}>
            <h4>Cadastre um novo funcionário</h4>
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

            <div>
                <label className="text-sm" htmlFor="employee_password">Senha (deverá ser trocada mais tarde pelo funcionário) *:</label>
                <input 
                    id="employee_password" 
                    name="password" 
                    className="block w-full bg-gray-50 focus:bg-white border px-4 py-2 sm:py-3 rounded-md transition-colors"
                    type="password" 
                    value={form.password}
                    onChange={handleInputChange}
                />
            </div>
            
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