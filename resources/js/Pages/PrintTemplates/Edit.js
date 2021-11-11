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
import FileInput from '@/Shared/FileInput';

const Edit = () => {
  const { print_template } = usePage().props;
  const { data, setData, errors, post, progress, processing } = useForm({
    active: print_template.active ? true : false,
    name: print_template.name || '',
    description: print_template.description || '',
    template: '',
    image: '',
    show_in_ui: print_template.show_in_ui ? true : false,
    print_class: print_template.print_class,
    _method: 'PUT'
  });

  function handleSubmit(e) {
    e.preventDefault();
    post(route('admin.print-templates.update', print_template.id));
  }

  function destroy() {
    if (confirm('Are you sure you want to delete this item?')) {
      Inertia.delete(route('admin.print-templates.destroy', print_template.id));
    }
  }

  function restore() {
    if (confirm('Are you sure you want to restore this item?')) {
      Inertia.put(route('admin.print-templates.restore', print_template.id));
    }
  }

  return (
    <div>
      <Helmet title={data.name} />
      <h1 className="mb-8 text-3xl font-bold">
        <InertiaLink
          href={route('admin.print-templates')}
          className="text-indigo-600 hover:text-indigo-700"
        >
          Print Templates
        </InertiaLink>
        <span className="mx-2 font-medium text-indigo-600">/</span>
        {data.name}
      </h1>
      {/* {print_template.image && (
        <img
          className="block w-8 h-8 ml-4 rounded-full"
          src={print_template.image}
        />
      )} */}
      {print_template.deleted_at && (
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
                errors={errors.active}
                label="Active"
                onChange={e => setData('active', e.target.checked)}
              />
              <CheckBox
                divClasses="mb-6 w-1/2"
                name="show_in_ui"
                checked={data.show_in_ui}
                errors={errors.show_in_ui}
                label="Show in UI"
                onChange={e => setData('show_in_ui', e.target.checked)}
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
                label="Print Class"
                name="print_class"
                type="text"
                errors={errors.print_class}
                value={data.print_class}
                onChange={e => setData('print_class', e.target.value)}
              />
              <FileInput
                className="w-full pb-8 pr-6 lg:w-1/2"
                label="Template"
                name="template"
                accept=".txt, .glabels, .nlbl"
                errors={errors.template}
                value={data.template}
                onChange={template => setData('template', template)}
              />

              <FileInput
                className="w-full pb-8 pr-6 lg:w-1/2"
                label="Image"
                name="image"
                accept="image/*"
                errors={errors.image}
                value={data.image}
                onChange={image => setData('image', image)}
              />
              {progress && (
                <progress value={progress.percentage} max="100">
                  {progress.percentage}%
                </progress>
              )}
            </div>
          </div>
          <div className="flex -mx-4 -mb-4 rounded-b-md items-center px-8 py-4 bg-gray-100 border-t border-gray-200">
            {!print_template.deleted_at && (
              <DeleteButton onDelete={destroy}>Delete Item</DeleteButton>
            )}
            <LoadingButton
              loading={processing}
              type="submit"
              className="ml-auto btn-indigo"
            >
              Update Print Template
            </LoadingButton>
          </div>
        </form>
      </div>
    </div>
  );
};

Edit.layout = page => <Layout children={page} />;

export default Edit;
