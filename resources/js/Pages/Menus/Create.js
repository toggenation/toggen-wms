import React from 'react';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink, useForm, usePage } from '@inertiajs/inertia-react';
import Layout from '@/Shared/Layout';
import LoadingButton from '@/Shared/LoadingButton';
import TextInput from '@/Shared/TextInput';
import SelectInput from '@/Shared/SelectInput';
import CheckBox from '@/Shared/Form/CheckBox';
const Create = () => {
  const { root_menus, icon_list } = usePage().props;
  const { data, setData, errors, post, processing } = useForm({
    active: true,
    name: '',
    route_url: '',
    parent_id: '',
    icon: ''
  });

  function handleSubmit(e) {
    e.preventDefault();
    post(route('admin.menus.store'));
  }

  return (
    <div>
      <h1 className="mb-8 text-3xl font-bold">
        <InertiaLink
          href={route('admin.menus')}
          className="text-indigo-600 hover:text-indigo-700"
        >
          Menus
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
              label="Name"
              name="name"
              errors={errors.name}
              value={data.name}
              onChange={e => setData('name', e.target.value)}
            />
            <TextInput
              className="w-full pb-8 pr-6 lg:w-1/2"
              label="Route"
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

            {/* <TextInput
              className="w-full pb-8 pr-6 lg:w-1/2"
              label="Icon"
              name="icon"
              type="text"
              errors={errors.icon}
              value={data.icon}
              onChange={e => setData('icon', e.target.value)}
            /> */}
          </div>
          <div className="flex items-center justify-end px-8 py-4 bg-gray-100 border-t border-gray-200">
            <LoadingButton
              loading={processing}
              type="submit"
              className="btn-indigo"
            >
              Create Setting
            </LoadingButton>
          </div>
        </form>
      </div>
    </div>
  );
};

Create.layout = page => <Layout title="Create Setting" children={page} />;

export default Create;
