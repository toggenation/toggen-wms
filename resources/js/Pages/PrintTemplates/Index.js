import React from 'react';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import Layout from '@/Shared/Layout';
import Icon from '@/Shared/Icon';
import Search from '@/Shared/Search/Search';
import SearchActive from '@/Shared/Search/SearchActive';
import Pagination from '@/Shared/Pagination';
import IconActive from '@/Shared/Icons/IconActive';

const Index = () => {
  const { print_templates } = usePage().props;
  const {
    data,
    meta: { links }
  } = print_templates;
  return (
    <div>
      <h1 className="mb-8 text-3xl font-bold">Print Templates</h1>
      <div className="flex items-center justify-between mb-6">
        <SearchActive />
        <InertiaLink
          className="btn-indigo focus:outline-none"
          href={route('admin.print-templates.create')}
        >
          <span>Create</span>
          <span className="hidden md:inline"> Print Template</span>
        </InertiaLink>
      </div>
      <div className="overflow-x-auto bg-white rounded shadow">
        <table className="w-full whitespace-nowrap">
          <thead>
            <tr className="font-bold text-left">
              <th className="px-6 pt-5 pb-4">Active</th>
              <th className="px-6 pt-5 pb-4">Name</th>
              <th className="px-6 pt-5 pb-4">Description</th>
            </tr>
          </thead>
          <tbody>
            {data.map(
              ({ id, name, active, deleted_at, description, imageUrl }) => {
                return (
                  <tr
                    key={id}
                    className="hover:bg-gray-100 focus-within:bg-gray-100"
                  >
                    <td className="border-t">
                      <InertiaLink
                        tabIndex="-1"
                        href={route('admin.print-templates.edit', id)}
                        className="flex items-center px-6 py-4 focus:text-indigo focus:outline-none"
                      >
                        <IconActive isActive={active} />
                      </InertiaLink>
                    </td>
                    <td className="border-t">
                      <InertiaLink
                        href={route('admin.print-templates.edit', id)}
                        className="flex items-center px-6 py-4 focus:text-indigo-700 focus:outline-none"
                      >
                        {imageUrl && (
                          <img
                            src={imageUrl}
                            className="block w-6 h-7 mr-2 -my-2"
                          />
                        )}

                        {name}
                        {deleted_at && (
                          <Icon
                            name="trash"
                            className="flex-shrink-0 w-3 h-3 ml-2 text-gray-400 fill-current"
                          />
                        )}
                      </InertiaLink>
                    </td>
                    <td className="border-t">
                      <InertiaLink
                        tabIndex="-1"
                        href={route('admin.print-templates.edit', id)}
                        className="flex items-center px-6 py-4 focus:text-indigo focus:outline-none"
                      >
                        {description}
                      </InertiaLink>
                    </td>
                  </tr>
                );
              }
            )}
            {data.length === 0 && (
              <tr>
                <td className="px-6 py-4 border-t" colSpan="4">
                  No Print Templates Found.
                </td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
      <Pagination links={links} />
    </div>
  );
};

Index.layout = page => <Layout title="Settings" children={page} />;

export default Index;
