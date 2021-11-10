import React from 'react';
import Helmet from 'react-helmet';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink, usePage, useForm } from '@inertiajs/inertia-react';
import Layout from '@/Shared/Layout';
import DeleteButton from '@/Shared/DeleteButton';
import LoadingButton from '@/Shared/LoadingButton';
import TextInput from '@/Shared/TextInput';
import TextAreaInput from '@/Shared/Form/TextAreaInput';
import SelectInput from '@/Shared/SelectInput';
import TrashedMessage from '@/Shared/TrashedMessage';
import CheckBox from '@/Shared/Form/CheckBox';

const Edit = () => {
  const { location, product_types } = usePage().props;
  const { data, setData, errors, put, processing } = useForm({
    active: location.active,
    capacity: location.capacity || '',
    name: location.name || '',
    description: location.description || '',
    product_type_id: location.product_type_id || ''
  });

  function handleSubmit(e) {
    e.preventDefault();
    put(route('admin.locations.update', location.id));
  }

  function destroy() {
    if (confirm('Are you sure you want to delete this item?')) {
      Inertia.delete(route('admin.locations.destroy', location.id));
    }
  }

  function restore() {
    if (confirm('Are you sure you want to restore this item?')) {
      Inertia.put(route('admin.locations.restore', location.id));
    }
  }

  return (
    <div>
      <Helmet title={data.name} />
      <h1 className="mb-8 text-3xl font-bold">
        <InertiaLink
          href={route('admin.locations')}
          className="text-indigo-600 hover:text-indigo-700"
        >
          Locations
        </InertiaLink>
        <span className="mx-2 font-medium text-indigo-600">/</span>
        {data.name}
      </h1>
      {location.deleted_at && (
        <TrashedMessage onRestore={restore}>
          This item has been deleted.
        </TrashedMessage>
      )}
      <div className="max-w-5xl p-4 bg-white rounded shadow">
        <form onSubmit={handleSubmit}>
          <div className="flex mb-8">
            <div className="w-full bg-transparent">
              <CheckBox
                divClasses="mb-6 w-1/2"
                name="active"
                checked={data.active}
                label="Active"
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
          </div>
          <div className="flex -ml-4 -mb-4 -mr-4 rounded items-center px-8 py-4 bg-gray-100 border-t border-gray-200">
            {!location.deleted_at && (
              <DeleteButton onDelete={destroy}>Delete Item</DeleteButton>
            )}
            <LoadingButton
              loading={processing}
              type="submit"
              className="ml-auto btn-indigo"
            >
              Update Item
            </LoadingButton>
          </div>
        </form>
      </div>
    </div>
  );
};

Edit.layout = page => <Layout children={page} />;

export default Edit;
