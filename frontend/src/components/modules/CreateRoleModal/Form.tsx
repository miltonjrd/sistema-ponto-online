import { ChangeEvent, FormEvent, FC, useState, useContext } from 'react';
import axios from '@/utils/axios';
import { AxiosError } from 'axios';
import toast from 'react-hot-toast';

// components
import SpinnerButton from '@/components/common/SpinnerButton';

type FormProps = {
    title: string,
    [key: string]: any
};

type Props = {
    closeModal(): void
};

const Form: FC<Props> = ({ closeModal }) => {
    const [isSubmiting, setIsSubmiting] = useState<boolean>(false);
    const [form, setForm] = useState<FormProps>({
        title: '',
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
            const response = await axios.post('/roles', form);
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
        <form className="flex flex-col gap-4 w-full lg:w-[700px] my-10" onSubmit={handleSubmit}>
            <h4>Registre um novo cargo</h4>
            <div>
                <label className="text-sm" htmlFor="role_name">Nome do cargo *:</label>
                <input 
                    id="role_name" 
                    name="title"
                    className="block w-full bg-gray-50 focus:bg-white border px-4 py-2 sm:py-3 rounded-md transition-colors" 
                    type="text" 
                    value={form.name}
                    onChange={handleInputChange}
                />
            </div>
            
            <div className="flex justify-between">
                <button type="reset" className="text-red-500 hover:bg-red-50 active:bg-red-100 px-4 py-2 rounded-md transition-colors">
                    Resetar
                </button>
                <SpinnerButton active={isSubmiting}>
                    Salvar
                </SpinnerButton>
            </div>
        </form>
    );
};

export default Form;