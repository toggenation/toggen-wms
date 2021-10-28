import React from 'react';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink, useForm, usePage } from '@inertiajs/inertia-react';
import Layout from '@/Shared/Layout';
import LoadingButton from '@/Shared/LoadingButton';
import TextInput from '@/Shared/TextInput';
import SelectInput from '@/Shared/SelectInput';
import TextAreaInput from '@/Shared/Form/TextAreaInput';
import CheckBox from '@/Shared/Form/CheckBox';

const CheckDigit = props => {
  const { barcode, length } = usePage().props;

  const { data, setData, errors, post, processing } = useForm({
    barcode: ''
  });

  const handleSubmit = e => {
    e.preventDefault();
    post(route('barcode.calc'));
  };

  return (
    <div>
      <h1 className="mb-8 text-3xl font-bold">Barcode Checkdigit Calculator</h1>
      <div className="max-w-3xl overflow-hidden bg-white rounded shadow">
        <form onSubmit={handleSubmit}>
          <div className="p-8 -mb-8 -mr-6 flex">
            <div className="block lg:w-1/3">
              <TextInput
                className="w-full pr-6"
                label="Barcode without checkdigit"
                name="barcode"
                errors={errors.barcode}
                value={data.barcode}
                onChange={e => setData('barcode', e.target.value)}
              />
              <div className="pb-4 text-xs">{data.barcode.length}</div>
            </div>
            <div className="mb-6 lg:w-1/3 block">
              <label>Length</label>
              <div
                style={{ height: '42px' }}
                className="mt-2 border leading-normal border-gray-300 p-2 rounded mr-4"
              >
                {length}
              </div>
            </div>
            <div className="mb-6 lg:w-1/3 block">
              <label>Barcode with checkdigit</label>
              <div
                style={{ height: '42px' }}
                className="mt-2 border leading-normal border-gray-300 p-2 rounded mr-4"
              >
                {barcode}
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
