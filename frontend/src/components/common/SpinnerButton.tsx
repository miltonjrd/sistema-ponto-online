import { ButtonHTMLAttributes, ReactNode, FC } from "react";

type Props = ButtonHTMLAttributes<HTMLButtonElement> & {
    active: boolean,
    children: ReactNode
};

const SpinnerButton: FC<Props> = ({ active, children }) => {
    return (
        <button type="submit" className="flex items-center justify-center bg-blue-500 text-white enabled:hover:bg-blue-600 active:bg-blue-700 disabled:opacity-80 px-4 py-2 rounded-md transition-colors">
            {active &&
            <div className="w-4 h-4 border-2 border-white border-b-gray-300 mr-2 rounded-full animate-spin" />}
            {children}
        </button>
    );
};

export default SpinnerButton;