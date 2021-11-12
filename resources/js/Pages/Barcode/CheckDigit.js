import React, { useEffect, useState } from 'react';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink, useForm, usePage } from '@inertiajs/inertia-react';
import Layout from '@/Shared/Layout';
import LoadingButton from '@/Shared/LoadingButton';
import TextInput from '@/Shared/TextInput';
import SelectInput from '@/Shared/SelectInput';
import TextAreaInput from '@/Shared/Form/TextAreaInput';
import CheckBox from '@/Shared/Form/CheckBox';

const CheckDigit = props => {
  let { barcode: barcodeCalced } = usePage().props;

  const { data, setData, errors, post, processing } = useForm({
    barcode: ''
  });

  let [bcc, setBcc] = useState(barcodeCalced);

  useEffect(() => {
    setBcc(barcodeCalced);
  }, [barcodeCalced]);

  const handleSubmit = e => {
    e.preventDefault();
    post(route('admin.barcode.calc'));
  };

  const handleUpdate = e => {
    setBcc('');
    setData(values => ({
      ...values,
      [e.target.name]: e.target.value
    }));
  };

  return (
    <div>
      <h1 className="mb-8 text-3xl font-bold">Barcode Checkdigit Calculator</h1>
      <div className="lg:max-w-3xl sm:w-full overflow-hidden bg-white rounded shadow">
        <form onSubmit={handleSubmit}>
          <div className="p-8 -mb-8 -mr-6 flex flex-wrap">
            <div className="lg:w-1/2 sm:w-full pr-5 ">
              <div className="mb-2">
                <label htmlFor="ig">Barcode without checkdigit</label>
              </div>
              <div className="flex flex-wrap items-stretch w-full mb-4 relative">
                <input
                  name="barcode"
                  onChange={e => handleUpdate(e)}
                  type="text"
                  value={data.barcode}
                  className="py-2 flex-shrink rounded flex-grow flex-auto rounded-r-none leading-normal w-px flex-1 border h-10 border-gray-300 px-3 relative"
                />
                <div className="flex -mr-px">
                  <span className="flex items-center leading-normal bg-grey-lighter rounded rounded-l-none border border-l-0 border-gray-300 px-3 whitespace-no-wrap text-grey-dark text-sm">
                    {data.barcode.length}
                  </span>
                </div>
              </div>
              {errors.barcode && <div>{errors.barcode}</div>}
            </div>
            <div className="lg:w-1/2 sm:w-full pr-5 ">
              <div className="mb-2">Barcode with checkdigit</div>
              <div className="flex flex-wrap items-stretch w-full mb-4 relative">
                <div className="py-2 flex-shrink rounded flex-grow flex-auto rounded-r-none leading-normal w-px flex-1 border h-10 border-gray-300 px-3 relative">
                  {bcc}
                </div>
                <div className="flex -mr-px">
                  <span className="flex items-center leading-normal bg-grey-lighter rounded rounded-l-none border border-l-0 border-gray-300 px-3 whitespace-no-wrap text-grey-dark text-sm">
                    {bcc ? bcc.length : 0}
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div className="flex items-center justify-end px-8 py-4 bg-gray-100 border-t border-gray-200">
            <LoadingButton
              loading={processing}
              type="submit"
              className="btn-indigo"
            >
              Calculate Checkdigit
            </LoadingButton>
          </div>
        </form>
      </div>
    </div>
  );
};

CheckDigit.layout = page => (
  <Layout title="Calculate check digit" children={page} />
);

export default CheckDigit;
