import React from 'react';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink, useForm, usePage } from '@inertiajs/inertia-react';
import Layout from '@/Shared/Layout';
import LoadingButton from '@/Shared/LoadingButton';
import TextInput from '@/Shared/TextInput';
import SelectInput from '@/Shared/SelectInput';
import TextAreaInput from '@/Shared/Form/TextAreaInput';
import CheckBox from '@/Shared/Form/CheckBox';

const Create = () => {
  const { product_types } = usePage().props;
  const { data, setData, errors, post, processing } = useForm({
    active: true,
    name: '',
    description: '',
    capacity: '',
    product_type_id: ''
  });

  function handleSubmit(e) {
    e.preventDefault();
    post(route('admin.locations.store'));
  }

  return (
    <div>
      <h1 className="mb-8 text-3xl font-bold">
        <InertiaLink
          href={route('admin.locations')}
          className="text-indigo-600 hover:text-indigo-700"
        >
          Location
        </InertiaLink>
        <span className="font-medium text-indigo-600"> /</span> Create
      </h1>
      <div className="max-w-3xl overflow-hidden bg-white rounded shadow">
        <form onSubmit={handleSubmit}>
          <div className="flex flex-wrap p-8 -mb-8 -mr-6">
            <CheckBox
              divClasses="mb-6"
              name="active"
              checked={data.active}
              label="Active"
              errors={errors.active}
              onChange={e => setData('active', e.target.checked)}
            />
            <TextInput
              className="w-full pb-8 pr-6"
              label="Name"
              name="name"
              errors={errors.name}
              value={data.name}
              onChange={e => setData('name', e.target.value)}
            />
            <TextInput
              className="w-full pb-8 pr-6"
              label="Description"
              name="description"
              type="text"
              errors={errors.description}
              value={data.description}
              onChange={e => setData('description', e.target.value)}
            />
            <TextInput
              className="w-full pb-8 pr-6"
              label="Capacity"
              name="capacity"
              type="text"
              errors={errors.capacity}
              value={data.capacity}
              onChange={e => setData('capacity', e.target.value)}
            />
            {/* 
            <TextAreaInput
              name="comment"
              errors={errors.comment}
              value={data.comment}
              onChange={e => setData('comment', e.target.value)}
              label="Item comment"
              placeholder="Please enter a comment"
            /> */}
            <SelectInput
              className="w-full pb-8 pr-6 lg:w-1/2"
              label="Product type"
              name="product_type_id"
              errors={errors.product_type_id}
              value={data.product_type_id}
              onChange={e => setData('product_type_id', e.target.value)}
            >
              <option key={0} value="">
                (select)
              </option>
              {product_types &&
                product_types.map(productType => {
                  return (
                    <option key={productType.id} value={productType.id}>
                      {productType.name}
                    </option>
                  );
                })}
            </SelectInput>
          </div>

          <div className="flex items-center justify-end px-8 py-4 bg-gray-100 border-t border-gray-200">
            <LoadingButton
              loading={processing}
              type="submit"
              className="btn-indigo"
            >
              Create Item
            </LoadingButton>
          </div>
        </form>
      </div>
    </div>
  );
};

Create.layout = page => <Layout title="Create Setting" children={page} />;

export default Create;
