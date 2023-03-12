import useSWR from 'swr';
import axios from '@/utils/axios';

const useApi = <T>(url: string, options: {} = {}) => {
    const fetcher = async (url: string) => (await axios.get(url)).data;

    const { data, error, mutate } = useSWR<T>(url, fetcher, options);

    return {
        data,
        error,
        mutate,
        isLoading: !data && !error
    };
};

export default useApi;