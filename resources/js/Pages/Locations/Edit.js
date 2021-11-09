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
  const { setting } = usePage().props;
  const { data, setData, errors, put, processing } = useForm({
    active: setting.active,
    name: setting.name || '',
    setting: setting.setting || '',
    comment: setting.comment || ''
  });

  function handleSubmit(e) {
    e.preventDefault();
    put(route('admin.settings.update', setting.id));
  }

  function destroy() {
    if (confirm('Are you sure you want to delete this item?')) {
      Inertia.delete(route('admin.settings.destroy', setting.id));
    }
  }

  function restore() {
    if (confirm('Are you sure you want to restore this item?')) {
      Inertia.put(route('admin.settings.restore', setting.id));
    }
  }

  return (
    <div>
      <Helmet title={data.name} />
      <h1 className="mb-8 text-3xl font-bold">
        <InertiaLink
          href={route('admin.settings')}
          className="text-indigo-600 hover:text-indigo-700"
        >
          Settings
        </InertiaLink>
        <span className="mx-2 font-medium text-indigo-600">/</span>
        {data.name}
      </h1>
      {setting.deleted_at && (
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
                label="Setting"
                name="setting"
                type="text"
                errors={errors.setting}
                value={data.setting}
                onChange={e => setData('setting', e.target.value)}
              />

              <TextAreaInput
                name="comment"
                className="border border-1 border-gray-300 border-solid p-2 p-y-2 pb-8 pr-6 rounded-md w-full w-full pb-8 pr-6 rounded-sm border-gray border-solid border-1"
                errors={errors.comment}
                value={data.comment}
                onChange={e => setData('comment', e.target.value)}
                label="Item comment"
                placeholder="Please enter a comment"
              />
            </div>
          </div>
          <div className="flex items-center px-8 py-4 bg-gray-100 border-t border-gray-200">
            {!setting.deleted_at && (
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
