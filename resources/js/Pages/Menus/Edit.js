import React from 'react';
import Helmet from 'react-helmet';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink, usePage, useForm } from '@inertiajs/inertia-react';
import Layout from '@/Shared/Layout';
import DeleteButton from '@/Shared/DeleteButton';
import LoadingButton from '@/Shared/LoadingButton';
import TextInput from '@/Shared/TextInput';
import SelectInput from '@/Shared/SelectInput';
import TrashedMessage from '@/Shared/TrashedMessage';
import CheckBox from '@/Shared/Form/CheckBox';

const Edit = () => {
  const { menu, root_menus, icon_list } = usePage().props;
  const { data, setData, errors, put, processing } = useForm({
    active: menu.active,
    name: menu.name || '',
    route_url: menu.route_url || '',
    parent_id: menu.parent_id || '',
    icon: menu.icon || ''
  });

  function handleSubmit(e) {
    e.preventDefault();
    put(route('admin.menus.update', menu.id));
  }

  function destroy() {
    if (confirm('Are you sure you want to delete this menu?')) {
      Inertia.delete(route('admin.menus.destroy', menu.id));
    }
  }

  function restore() {
    if (confirm('Are you sure you want to restore this menu?')) {
      Inertia.put(route('admin.menus.restore', menu.id));
    }
  }

  return (
    <div>
      <Helmet title={data.name} />
      <h1 className="mb-8 text-3xl font-bold">
        <InertiaLink
          href={route('admin.menus')}
          className="text-indigo-600 hover:text-indigo-700"
        >
          Menus
        </InertiaLink>
        <span className="mx-2 font-medium text-indigo-600">/</span>
        {data.name}
      </h1>
      {menu.deleted_at && (
        <TrashedMessage onRestore={restore}>
          This menu has been deleted.
        </TrashedMessage>
      )}
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
              label="Name"
              name="name"
              errors={errors.name}
              value={data.name}
              onChange={e => setData('name', e.target.value)}
            />
            <TextInput
              className="w-full pb-8 pr-6 lg:w-1/2"
              label="Route or URL"
              name="route_url"
              type="text"
              errors={errors.route_url}
              value={data.route_url}
              onChange={e => setData('route_url', e.target.value)}
            />
            <SelectInput
              className="w-full pb-8 pr-6 lg:w-1/2"
              label="Parent"
              name="parent_id"
              errors={errors.parent_id}
              value={data.parent_id}
              onChange={e => setData('parent_id', e.target.value)}
            >
              <option key={0} value="">
                (Is root)
              </option>
              {root_menus &&
                root_menus.map(parentMenu => {
                  return (
                    <option key={parentMenu.id} value={parentMenu.id}>
                      {parentMenu.name}
                    </option>
                  );
                })}
            </SelectInput>
            <SelectInput
              className="w-full pb-8 pr-6 lg:w-1/2"
              label="Icon"
              name="icon"
              errors={errors.icon}
              value={data.icon}
              onChange={e => setData('icon', e.target.value)}
            >
              <option key={0} value="">
                (Select)
              </option>
              {icon_list &&
                icon_list.map(icon => {
                  return (
                    <option key={icon.key} value={icon.key}>
                      {icon.value}
                    </option>
                  );
                })}
            </SelectInput>
          </div>
          <div className="flex items-center px-8 py-4 bg-gray-100 border-t border-gray-200">
            {!menu.deleted_at && (
              <DeleteButton onDelete={destroy}>Delete Menu</DeleteButton>
            )}
            <LoadingButton
              loading={processing}
              type="submit"
              className="ml-auto btn-indigo"
            >
              Update Menu
            </LoadingButton>
          </div>
        </form>
      </div>
    </div>
  );
};

Edit.layout = page => <Layout children={page} />;

export default Edit;
