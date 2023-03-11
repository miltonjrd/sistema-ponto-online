import Link from 'next/link';

const Header = () => {
    return (
        <header className="flex justify-center h-16 bg-gray-100 py-2">
            <nav className="h-full">
                <ul className="flex h-full gap-2">
                    <li className="px-4 h-full hover:bg-gray-200 rounded-md transition-colors duration-200">
                        <Link href="/gerenciar/funcionarios" className="flex items-center h-full w-full">Gerenciar funcionários</Link>
                    </li>
                    <li className="px-4 h-full hover:bg-gray-200 rounded-md transition-colors duration-200">
                        <Link href="/gerenciar/cargos" className="flex items-center h-full w-full">Gerenciar cargos</Link>
                    </li>
                    <li className="px-4 h-full hover:bg-gray-200 rounded-md transition-colors duration-200">
                        <Link href="/pontos" className="flex items-center h-full w-full">Listar pontos</Link>
                    </li>
                </ul>
            </nav>
        </header>
    );
};

export default Header;