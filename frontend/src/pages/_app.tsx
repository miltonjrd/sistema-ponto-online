import '@/styles/globals.css';
import type { NextPage } from 'next';
import type { AppProps } from 'next/app';

import Layout from '@/components/common/Layout';
import { ReactElement, ReactNode } from 'react';

export type NextPageWithLayout<P = {}, IP = P> = NextPage<P, IP> & { 
  getLayout?: (page: ReactElement) => ReactNode
};

type AppPropsWithLayout = AppProps & {
  Component: NextPageWithLayout
};

const App = ({ Component, pageProps }: AppPropsWithLayout) => {
  const getLayout = Component.getLayout ?? ((page) => page);

  return getLayout(<Component {...pageProps} />);
};

export default App;