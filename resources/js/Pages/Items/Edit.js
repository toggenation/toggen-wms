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
  const { item, product_types, units_of_measure } = usePage().props;
  const { data, setData, errors, put, processing } = useForm({
    active: item.active,
    code: item.code || '',
    description: item.description || '',
    quantity: item.quantity || '',
    trade_unit_barcode: item.trade_unit_barcode || '',
    consumer_unit_barcode: item.consumer_unit_barcode || '',
    product_type_id: item.product_type_id || '',
    unit_of_measure_id: item.unit_of_measure_id || '',
    unit_net_contents: item.unit_net_contents || '',
    days_life: item.days_life || '',
    min_days_life: item.min_days_life || '',
    variant: item.variant || '',
    brand: item.brand || '',
    comment: item.comment || '',
    code_description: item.code_description || ''
  });

  function handleSubmit(e) {
    e.preventDefault();
    put(route('data.items.update', item.id));
  }

  function destroy() {
    if (confirm('Are you sure you want to delete this item?')) {
      Inertia.delete(route('data.items.destroy', item.id));
    }
  }

  function restore() {
    if (confirm('Are you sure you want to restore this item?')) {
      Inertia.put(route('data.items.restore', item.id));
    }
  }

  return (
    <div>
      <Helmet title={data.description} />
      <h1 className="mb-8 text-3xl font-bold">
        <InertiaLink
          href={route('data')}
          className="text-indigo-600 hover:text-indigo-700"
        >
          Items
        </InertiaLink>
        <span className="mx-2 font-medium text-indigo-600">/</span>
        {data.code_description} {item.id}
      </h1>
      {item.deleted_at && (
        <TrashedMessage onRestore={restore}>
          This item has been deleted.
        </TrashedMessage>
      )}
      <div className="max-w-5xl p-4 bg-white rounded shadow">
        <form onSubmit={handleSubmit}>
          <div className="flex mb-8">
            <div className="w-1/3 bg-transparent">
              <CheckBox
                divClasses="mb-6 w-1/2"
                name="active"
                checked={data.active}
                label="Active"
                onChange={e => setData('active', e.target.checked)}
              />
              <TextInput
                className="w-full pb-8 pr-6"
                label="Code"
                name="code"
                errors={errors.code}
                value={data.code}
                onChange={e => setData('code', e.target.value)}
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
                label="Boxes per pallet"
                name="quantity"
                type="text"
                errors={errors.quantity}
                value={data.quantity}
                onChange={e => setData('quantity', e.target.value)}
              />
              <TextInput
                className="w-full pb-8 pr-6"
                label="Trade Unit Barcode"
                name="trade_unit_barcode"
                type="text"
                errors={errors.trade_unit_barcode}
                value={data.trade_unit_barcode}
                onChange={e => setData('trade_unit_barcode', e.target.value)}
              />
            </div>
            <div className="w-1/3">
              <TextInput
                className="w-full pb-8 pr-6"
                label="Consumer Unit Barcode"
                name="consumer_unit_barcode"
                type="text"
                errors={errors.consumer_unit_barcode}
                value={data.consumer_unit_barcode}
                onChange={e => setData('consumer_unit_barcode', e.target.value)}
              />
              <TextInput
                className="w-full pb-8 pr-6"
                label="Unit net contents"
                name="unit_net_contents"
                type="text"
                errors={errors.unit_net_contents}
                value={data.unit_net_contents}
                onChange={e => setData('unit_net_contents', e.target.value)}
              />
              <SelectInput
                className="w-full pb-8 pr-6"
                label="Product Type"
                name="product_type_id"
                errors={errors.product_type_id}
                value={data.product_type_id}
                onChange={e => setData('product_type_id', e.target.value)}
              >
                <option key={0} value=""></option>
                {product_types &&
                  product_types.map(productType => {
                    return (
                      <option key={productType.id} value={productType.id}>
                        {productType.name}
                      </option>
                    );
                  })}
              </SelectInput>

              <SelectInput
                className="w-full pb-8 pr-6"
                label="Unit of measure"
                name="unit_of_measure_id"
                errors={errors.unit_of_measure_id}
                value={data.unit_of_measure_id}
                onChange={e => setData('unit_of_measure_id', e.target.value)}
              >
                <option key={0} value=""></option>
                {units_of_measure &&
                  units_of_measure.map(uom => {
                    return (
                      <option key={uom.id} value={uom.id}>
                        {uom.name}
                      </option>
                    );
                  })}
              </SelectInput>
            </div>
            <div className="w-1/3">
              <TextInput
                className="w-full pb-8 pr-6"
                label="Brand"
                name="brand"
                type="text"
                errors={errors.brand}
                value={data.brand}
                onChange={e => setData('brand', e.target.value)}
              />
              <TextInput
                className="w-full pb-8 pr-6"
                label="Variant"
                name="variant"
                type="text"
                errors={errors.variant}
                value={data.variant}
                onChange={e => setData('variant', e.target.value)}
              />
              <TextInput
                className="w-full pb-8 pr-6"
                label="Days life"
                name="days_life"
                type="text"
                errors={errors.days_life}
                value={data.days_life}
                onChange={e => setData('days_life', e.target.value)}
              />

              <TextInput
                className="w-full pb-8 pr-6"
                label="Min days life"
                name="min_days_life"
                type="text"
                errors={errors.min_days_life}
                value={data.min_days_life}
                onChange={e => setData('min_days_life', e.target.value)}
              />

              <TextAreaInput
                name="comment"
                errors={errors.comment}
                value={data.comment}
                onChange={e => setData('comment', e.target.value)}
                label="Item comment"
                placeholder="Please enter a comment"
              />
            </div>
          </div>
          <div className="flex items-center px-8 py-4 bg-gray-100 border-t border-gray-200">
            {!item.deleted_at && (
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
