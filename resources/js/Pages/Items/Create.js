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
  const { product_types, units_of_measure } = usePage().props;

  const { data, setData, errors, post, processing } = useForm({
    active: '',
    code: '',
    description: '',
    quantity: '',
    trade_unit_barcode: '',
    consumer_unit_barcode: '',
    product_type_id: '',
    unit_of_measure_id: '',
    unit_net_contents: '',
    days_life: '',
    min_days_life: '',
    variant: '',
    brand: '',
    comment: '',
    code_description: ''
  });

  function handleSubmit(e) {
    e.preventDefault();
    post(route('data.items.store'));
  }

  return (
    <div>
      <h1 className="mb-8 text-3xl font-bold">
        <InertiaLink
          href={route('organizations')}
          className="text-indigo-600 hover:text-indigo-700"
        >
          Item
        </InertiaLink>
        <span className="font-medium text-indigo-600"> /</span> Create
      </h1>
      <div className="max-w-3xl overflow-hidden bg-white rounded shadow">
        <form onSubmit={handleSubmit}>
          <div className="flex flex-wrap p-8 -mb-8 -mr-6">
            <CheckBox
              divClasses="mb-6 w-1/2"
              name="active"
              checked={data.active}
              label="Active"
              onChange={e => setData('active', e.target.checked)}
            />
            <TextInput
              className="w-full pb-8 pr-6 lg:w-1/2"
              label="Code"
              name="code"
              errors={errors.code}
              value={data.code}
              onChange={e => setData('code', e.target.value)}
            />
            <TextInput
              className="w-full pb-8 pr-6 lg:w-1/2"
              label="Description"
              name="description"
              type="text"
              errors={errors.description}
              value={data.description}
              onChange={e => setData('description', e.target.value)}
            />
            <TextInput
              className="w-full pb-8 pr-6 lg:w-1/2"
              label="Quantity"
              name="quantity"
              type="text"
              errors={errors.quantity}
              value={data.quantity}
              onChange={e => setData('quantity', e.target.value)}
            />
            <TextInput
              className="w-full pb-8 pr-6 lg:w-1/2"
              label="Trade Unit Barcode"
              name="trade_unit_barcode"
              type="text"
              errors={errors.trade_unit_barcode}
              value={data.trade_unit_barcode}
              onChange={e => setData('trade_unit_barcode', e.target.value)}
            />
            <TextInput
              className="w-full pb-8 pr-6 lg:w-1/2"
              label="Consumer Unit Barcode"
              name="consumer_unit_barcode"
              type="text"
              errors={errors.consumer_unit_barcode}
              value={data.consumer_unit_barcode}
              onChange={e => setData('consumer_unit_barcode', e.target.value)}
            />
            <TextInput
              className="w-full pb-8 pr-6 lg:w-1/2"
              label="Unit net contents"
              name="unit_net_contents"
              type="text"
              errors={errors.unit_net_contents}
              value={data.unit_net_contents}
              onChange={e => setData('unit_net_contents', e.target.value)}
            />
            <SelectInput
              className="w-full pb-8 pr-6 lg:w-1/2"
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
              className="w-full pb-8 pr-6 lg:w-1/2"
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

            <TextInput
              className="w-full pb-8 pr-6 lg:w-1/2"
              label="Brand"
              name="brand"
              type="text"
              errors={errors.brand}
              value={data.brand}
              onChange={e => setData('brand', e.target.value)}
            />

            <TextInput
              className="w-full pb-8 pr-6 lg:w-1/2"
              label="Variant"
              name="variant"
              type="text"
              errors={errors.variant}
              value={data.variant}
              onChange={e => setData('variant', e.target.value)}
            />
            <TextInput
              className="w-full pb-8 pr-6 lg:w-1/2"
              label="Days life"
              name="days_life"
              type="text"
              errors={errors.days_life}
              value={data.days_life}
              onChange={e => setData('days_life', e.target.value)}
            />

            <TextInput
              className="w-full pb-8 pr-6 lg:w-1/2"
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

Create.layout = page => <Layout title="Create Item" children={page} />;

export default Create;
