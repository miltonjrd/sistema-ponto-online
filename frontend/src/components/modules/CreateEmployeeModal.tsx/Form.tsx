import { ChangeEvent, FormEvent, FC, useState } from 'react';
import axios from '@/utils/axios';

// components
import SpinnerButton from '@/components/common/SpinnerButton';

type FormProps = {
    name: string,
    age: number,
    role: number,
    [key: string]: any
};

const Form: FC = () => {
    const [isSubmiting, setIsSubmiting] = useState<boolean>(false);
    const [form, setForm] = useState<FormProps>({
        name: '',
        age: 0,
        role: 0
    });

    const handleInputChange = (evt: ChangeEvent<HTMLInputElement>) => {
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
            const response = await axios.post('/api/employees');
            
        } catch (err: unknown) {

        }
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
                    name="role" 
                    className="block border px-4 py-2 rounded-md"
                >
                    <option selected disabled>Selecione</option>
                    <option>EMPACOTADOR</option>
                </select>
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