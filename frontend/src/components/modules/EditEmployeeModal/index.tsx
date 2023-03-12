import { FC, useEffect } from 'react';
import { Dialog } from '@headlessui/react';

import Form from './Form';

type Props = {
    show: boolean,
    close(): void,
    employeeId: number
};

const EditEmployeeModal: FC<Props> = ({ show, close, employeeId }) => {

    return (
        <Dialog open={show} onClose={close} className="relative z-50">
            <Dialog.Backdrop className="fixed inset-0 backdrop-blur-sm" />
            <div className="fixed inset-0 flex items-center justify-center">
                <Dialog.Panel className="bg-white border border-gray-400 p-4 rounded-lg">
                    <div className="flex justify-end">
                        <button 
                            type="button" 
                            className="bg-gradient-to-r from-gray-200 via-gray-100 to-gray-200 border-4 border-gray-300 border-t-0 text-gray-600 text-xs px-1 rounded"
                            onClick={close}
                        >
                            ESC
                        </button>
                    </div>
                    <Form closeModal={close} employeeId={employeeId} />
                </Dialog.Panel>
            </div>
        </Dialog>
    );
};

export default EditEmployeeModal;