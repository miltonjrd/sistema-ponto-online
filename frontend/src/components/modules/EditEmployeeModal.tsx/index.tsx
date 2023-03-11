import { FC } from 'react';
import { Modal } from 'flowbite-react';

import Form from './Form';

type Props = {
    show: boolean,
    close(): void
};

const EditEmployeeModal: FC<Props> = () => {
    return (
        <Modal>
            <Modal.Header />
            <Modal.Body>
                <Form />
            </Modal.Body>
        </Modal>
    );
};

export default EditEmployeeModal;