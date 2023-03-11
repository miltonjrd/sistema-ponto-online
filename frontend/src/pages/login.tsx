import { ChangeEvent, FormEvent, ReactElement, useState } from "react";
import axios from '@/utils/axios';

import SpinnerButton from "@/components/common/SpinnerButton";
import Link from "next/link";
import { NextPage } from "next";
import ToasterLayout from "@/components/common/ToasterLayout";
import { NextPageWithLayout } from "./_app";

type FormProps = {
    code: string,
    password: string
};

const Login: NextPageWithLayout = () => {
    const [isPasswordVisible, setIsPasswordVisible] = useState(false);
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
            const response = await axios.post('/admin/login', form);
        } catch (err: unknown) {
            
        }
    };

    return (
        <main className="absolute inset-0 flex justify-center items-center">
            <form className="flex flex-col gap-4 w-96 shadow-md p-4" onSubmit={handleSubmit}>
                <div>
                    <h4 className="m-0">Faça login no sistema...</h4>
                    <div className="text-end text-sm">
                        <span className="px-1 bg-blue-400 text-white rounded">...como funcionário</span>
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
                    <div className="flex w-full border border-gray-400 focus:border-gray-500 py-2 px-4 rounded-md">
                        <input 
                            id="password" 
                            name="password"
                            className="flex-grow"
                            type={isPasswordVisible ? 'text':'password'}
                            value={form.password}
                            onChange={handleInputChange}
                        />
                        <button type="button">
                            
                        </button>
                    </div>
                </div>

                <SpinnerButton active={isSubmiting} disabled={isSubmiting}>
                    Login
                </SpinnerButton>
                <small>É um administrador? Faça login <Link href="/admin/login" className="text-blue-500 hover:text-blue-600">aqui</Link>.</small>
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