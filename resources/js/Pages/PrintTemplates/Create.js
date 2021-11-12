import React from 'react';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink, useForm, usePage } from '@inertiajs/inertia-react';
import Layout from '@/Shared/Layout';
import LoadingButton from '@/Shared/LoadingButton';
import TextInput from '@/Shared/TextInput';
import SelectInput from '@/Shared/SelectInput';
import TextAreaInput from '@/Shared/Form/TextAreaInput';
import CheckBox from '@/Shared/Form/CheckBox';
import FileInput from '@/Shared/FileInput';

const Create = () => {
  const { data, setData, errors, post, progress, processing } = useForm({
    active: true,
    name: '',
    setting: '',
    comment: '',
    name: '',
    description: '',
    template: '',
    templateCurrent: '',
    image: '',
    image_current: '',
    show_in_ui: '',
    print_class: '',
    imageUrl: ''
    // _method: 'PUT'
  });

  function handleSubmit(e) {
    e.preventDefault();
    post(route('admin.print-templates.store'));
  }

  return (
    <div>
      <h1 className="mb-8 text-3xl font-bold">
        <InertiaLink
          href={route('admin.settings')}
          className="text-indigo-600 hover:text-indigo-700"
        >
          Setting
        </InertiaLink>
        <span className="font-medium text-indigo-600"> /</span> Create
      </h1>
      <div className="max-w-3xl overflow-hidden bg-white rounded shadow">
        <form onSubmit={handleSubmit}>
          <div className="flex mb-8 w-full">
            <div className="w-3/4 p-6 bg-transparent">
              <CheckBox
                divClasses="mb-6"
                name="active"
                checked={data.active}
                errors={errors.active}
                label="Active"
                onChange={e => setData('active', e.target.checked)}
              />
              <CheckBox
                divClasses="mb-6"
                name="show_in_ui"
                checked={data.show_in_ui}
                errors={errors.show_in_ui}
                label="Show in UI"
                onChange={e => setData('show_in_ui', e.target.checked)}
              />

              <TextInput
                className="pb-8 pr-6"
                label="Name"
                name="name"
                errors={errors.name}
                value={data.name}
                onChange={e => setData('name', e.target.value)}
              />
              <TextInput
                className="pb-8 pr-6"
                label="Description"
                name="description"
                type="text"
                errors={errors.description}
                value={data.description}
                onChange={e => setData('description', e.target.value)}
              />

              <TextInput
                className="pb-8 pr-6"
                label="Print Class"
                name="print_class"
                type="text"
                errors={errors.print_class}
                value={data.print_class}
                onChange={e => setData('print_class', e.target.value)}
              />
              <FileInput
                className="w-full pb-8 pr-6"
                label="Template"
                name="template"
                accept=".txt, .glabels, .nlbl"
                errors={errors.template}
                value={data.template}
                onChange={template => {
                  setData(values => ({
                    ...values,
                    template: template,
                    templateCurrent: template === null ? '' : template.name
                  }));
                }}
              />
              <div className="mt-0">{data.templateCurrent}</div>
              <FileInput
                className="w-full pb-8 pr-6"
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
            <div className="w-1/4">
              {data.imageUrl && (
                <img src={data.imageUrl} className="mx-auto mt-6" />
              )}
            </div>
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
