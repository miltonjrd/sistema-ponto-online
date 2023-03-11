import Head from "next/head";
import { ReactNode, FC } from "react";

import ToasterLayout from "./ToasterLayout";
import Header from "./Header";

type Props = {
    children: ReactNode
};

const Layout: FC<Props> = ({ children }) => {
    return (
        <ToasterLayout>
            <Head>
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            </Head>
            <Header />
            {children}
        </ToasterLayout>
    );
};

export default Layout;