import React from 'react';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import Layout from '@/Shared/Layout';
import Icon from '@/Shared/Icon';
import SearchFilter from '@/Shared/SearchFilter';
import Pagination from '@/Shared/Pagination';

const Index = () => {
  const { items } = usePage().props;
  const {
    data,
    meta: { links }
  } = items;
  return (
    <div>
      <h1 className="mb-8 text-3xl font-bold">Items</h1>
      <div className="flex items-center justify-between mb-6">
        <SearchFilter />
        <InertiaLink
          className="btn-indigo focus:outline-none"
          href={route('data.items.create')}
        >
          <span>Create</span>
          <span className="hidden md:inline"> Item</span>
        </InertiaLink>
      </div>
      <div className="overflow-x-auto bg-white rounded shadow">
        <table className="w-full whitespace-nowrap">
          <thead>
            <tr className="font-bold text-left">
              <th className="px-6 pt-5 pb-4">Code</th>
              <th className="px-6 pt-5 pb-4">Description</th>
              <th className="px-6 pt-5 pb-4" colSpan="2">
                Boxes per pallet
              </th>
            </tr>
          </thead>
          <tbody>
            {data.map(({ id, code, description, quantity, deleted_at }) => {
              return (
                <tr
                  key={id}
                  className="hover:bg-gray-100 focus-within:bg-gray-100"
                >
                  <td className="border-t">
                    <InertiaLink
                      href={route('data.items.edit', id)}
                      className="flex items-center px-6 py-4 focus:text-indigo-700 focus:outline-none"
                    >
                      {code}
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
                      href={route('data.items.edit', id)}
                      className="flex items-center px-6 py-4 focus:text-indigo focus:outline-none"
                    >
                      {description}
                    </InertiaLink>
                  </td>
                  <td className="border-t">
                    <InertiaLink
                      tabIndex="-1"
                      href={route('data.items.edit', id)}
                      className="flex items-center px-6 py-4 focus:text-indigo focus:outline-none"
                    >
                      {quantity}
                    </InertiaLink>
                  </td>
                  <td className="w-px border-t">
                    <InertiaLink
                      tabIndex="-1"
                      href={route('data.items.edit', id)}
                      className="flex items-center px-4 focus:outline-none"
                    >
                      <Icon
                        name="cheveron-right"
                        className="block w-6 h-6 text-gray-400 fill-current"
                      />
                    </InertiaLink>
                  </td>
                </tr>
              );
            })}
            {data.length === 0 && (
              <tr>
                <td className="px-6 py-4 border-t" colSpan="4">
                  No items found.
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

Index.layout = page => <Layout title="Items" children={page} />;

export default Index;
