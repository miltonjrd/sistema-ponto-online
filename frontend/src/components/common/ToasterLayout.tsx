import { FC, ReactNode } from 'react';
import { Toaster } from 'react-hot-toast';

type Props = {
    children: ReactNode
};

const ToasterLayout: FC<Props> = ({ children }) => {
    return (
        <>
            <Toaster />
            {children}
        </>  
    );
};

export default ToasterLayout;