import React, { useState } from 'react';
import Layout from '@/Shared/Layout';
import SelectInput from '@/Shared/SelectInput';
import { InertiaLink, useForm, usePage } from '@inertiajs/inertia-react';
import Icon from '@/Shared/Icon';
import classNames from 'classnames';
import { set } from 'lodash';
import CheckBox from '@/Shared/Form/CheckBox';
import LoadingButton from '@/Shared/LoadingButton';

const LabelPrint = () => {
  const { batchNos, items, productionLines } = usePage().props;
  const { data, setData, errors, post, processing } = useForm({
    item_id: '',
    production_line_id: '',
    batch_no: '',
    quantity: 0,
    part_pallet: false
  });

  const [quantityMax, setQuantityMax] = useState(0);

  const isActive = true;
  const iconClasses = classNames('w-4 h-4 mr-2', {
    'text-white fill-current': isActive,
    'text-indigo-400 group-hover:text-white fill-current': !isActive
  });

  function handleSubmit(e) {
    e.preventDefault();

    if (confirm('Are you sure want to send a print?')) {
      post(route('print.pallet-print'));
    }
  }

  function getCurrentQty(items, itemId) {
    const item = items.filter(item => {
      return item.id === itemId;
    });

    let quantity = 0;

    if (item.length > 0) {
      quantity = item[0]['quantity'];
    }
    return quantity;
  }

  function handleItemChange(field, event) {
    const itemId = parseInt(event.target.value) || 0;
    const quantity = getCurrentQty(items, itemId);
    setQuantityMax(quantity);
    setData(formState => {
      return {
        ...formState,
        [field]: itemId,
        quantity: quantity
        // part_pallet: false
      };
    });
  }

  function handlePartPalletChange(field, checked) {
    const quantity = checked ? 0 : getCurrentQty(items, data.item_id);
    setData(formState => {
      return {
        ...formState,
        [field]: checked,
        quantity: quantity
      };
    });
  }
  const quantityList = Array(quantityMax).fill(1);
  const panelClasses =
    'w-full md:w-1/2 border border-gray-400 bg-gray-100 rounded-xl p-4 mb-4';
  return (
    <div>
      <h1 className="mb-8 text-3xl font-bold">Pallet Label Print</h1>
      <div className="md:flex md:space-x-4">
        <div className={panelClasses}>
          <form onSubmit={handleSubmit}>
            <h4 className="mb-4 font-bold">Print</h4>
            <p>{data.quantityMax}</p>
            <SelectInput
              className="w-full pb-8"
              label="Item"
              name="item_id"
              errors={errors.item_id}
              value={data.item_id}
              onChange={e => handleItemChange('item_id', e)}
            >
              <option key={0} value={null}>
                (select)
              </option>
              {items &&
                items.map(item => {
                  return (
                    <option key={item.id} value={item.id}>
                      {item.code_description}
                    </option>
                  );
                })}
            </SelectInput>
            <SelectInput
              className="w-full pb-8"
              label="Production line"
              name="production_line_id"
              errors={errors.production_line_id}
              value={data.production_line_id}
              onChange={e => setData('production_line_id', e.target.value)}
            >
              <option key={0} value={null}>
                (select)
              </option>
              {productionLines &&
                productionLines.map(productionLine => {
                  return (
                    <option key={productionLine.id} value={productionLine.id}>
                      {productionLine.name}
                    </option>
                  );
                })}
            </SelectInput>
            <div className="flex">
              <CheckBox
                divClasses="mb-6 w-1/2"
                name="part_pallet"
                checked={data.part_pallet}
                label="Part Pallet"
                onChange={e =>
                  handlePartPalletChange('part_pallet', e.target.checked)
                }
              />

              {data.part_pallet && (
                <SelectInput
                  className="w-1/2 pb-8"
                  label="Part pallet quantity"
                  name="quantity"
                  errors={errors.quantity}
                  value={data.quantity}
                  onChange={e =>
                    setData('quantity', parseInt(e.target.value) || 0)
                  }
                >
                  <option key={0} value={null}>
                    (select)
                  </option>
                  {quantityList &&
                    quantityList.map((quanityItem, idx) => {
                      const number = idx + 1;
                      return (
                        <option key={number} value={number}>
                          {number}
                        </option>
                      );
                    })}
                </SelectInput>
              )}
            </div>

            <SelectInput
              className="w-full pb-8"
              label={`Batch no ${data.batch_no}`}
              name="batch_no"
              errors={errors.batch_no}
              value={data.batch_no}
              onChange={e => setData('batch_no', e.target.value)}
            >
              <option key={0} value={null}>
                (select)
              </option>
              {batchNos &&
                batchNos.map(batchNo => {
                  return (
                    <option key={batchNo.batch} value={batchNo.batch}>
                      {batchNo.description}
                    </option>
                  );
                })}
            </SelectInput>

            <div className="">
              <LoadingButton
                loading={processing}
                type="submit"
                className="ml-auto btn-indigo"
              >
                <Icon name="printer" className={iconClasses} />
                Print...{' '}
              </LoadingButton>
            </div>
          </form>
        </div>
        {/* <div className={panelClasses}>
          <h4>Label 2</h4>
        </div> */}
      </div>
    </div>
  );
};

LabelPrint.layout = page => (
  <Layout title="Pallet Label Print" children={page} />
);

export default LabelPrint;
