import { ChangeEvent, FormEvent, ReactElement, useState } from "react";
import toast from 'react-hot-toast';
import axios from '@/utils/axios';
import jsCookie from 'js-cookie';

// components
import ToasterLayout from "@/components/common/ToasterLayout";
import SpinnerButton from "@/components/common/SpinnerButton";
import Link from "next/link";
import { NextPageWithLayout } from "../_app";
import { AxiosError } from "axios";

type FormProps = {
    code: string,
    password: string
};

const Login: NextPageWithLayout = () => {
    const [isSubmiting, setIsSubmiting] = useState(false);
    const [form, setForm] = useState<FormProps>({
        code: '',
        password: ''
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
            const response = await axios.post<{ message: string, token: string }>('/admin/login', form);
            toast.success(response.data.message);
            sessionStorage.setItem('jwt_token', response.data.token);

            window.location.href = '/';
        } catch (err: unknown) {
            if (err instanceof AxiosError) {
                toast.error(err.response?.data.message);
            }
        }

        setIsSubmiting(false);
    };

    return (
        <main className="absolute inset-0 flex justify-center items-center">
            <form className="flex flex-col gap-4 w-96 shadow-md p-4" onSubmit={handleSubmit}>
                <div>
                    <h4 className="m-0">Faça login no sistema...</h4>
                    <div className="text-end text-sm">
                        <span className="px-1 bg-blue-400 text-white rounded">...como administrador</span>
                    </div>
                </div>
                <div>
                    <label htmlFor="code" className="block">Código:</label>
                    <input 
                        id="code" 
                        name="code"
                        type="text" 
                        className="w-full border border-gray-400 focus:border-gray-500 py-2 px-4 rounded-md"
                        value={form.code}
                        onChange={handleInputChange}
                    />
                </div>

                <div>
                    <label htmlFor="password" className="block">Senha:</label>
                    <input 
                        id="password" 
                        name="password"
                        type="password" 
                        className="w-full border border-gray-400 focus:border-gray-500 py-2 px-4 rounded-md" 
                        value={form.password}
                        onChange={handleInputChange}
                    />
                </div>

                <SpinnerButton active={isSubmiting} disabled={isSubmiting}>
                    Login
                </SpinnerButton>
                <small>É um funcionário? Faça login <Link href="/login" className="text-blue-500 hover:text-blue-600">aqui</Link>.</small>
            </form>
        </main>
    );
};

Login.getLayout = (page: ReactElement) => {
    return (
        <ToasterLayout>
            {page}
        </ToasterLayout>
    );
};

export default Login;