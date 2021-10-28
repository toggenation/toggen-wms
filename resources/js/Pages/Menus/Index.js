import React from 'react';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import Layout from '@/Shared/Layout';
import Icon from '@/Shared/Icon';
import SearchFilter from '@/Shared/SearchFilter';
import Pagination from '@/Shared/Pagination';

const Index = () => {
  const { menus } = usePage().props;
  const {
    data,
    meta: { links }
  } = menus;

  function moveUp(event, id) {
    event.preventDefault();
    if (confirm('Are you sure you want to move this menu up?')) {
      Inertia.put(route('admin.menus.up', id));
    }
  }

  function moveDown(event, id) {
    event.preventDefault();
    if (confirm('Are you sure you want to move this menu down?')) {
      Inertia.put(route('admin.menus.down', id));
    }
  }

  function makeParent(event, id) {
    event.preventDefault();
    if (confirm('Are you sure you want to make this a top level menu')) {
      Inertia.put(route('admin.menus.parent', id));
    }
  }

  return (
    <div>
      <h1 className="mb-8 text-3xl font-bold">Menus</h1>
      <div className="flex items-center justify-between mb-6">
        <SearchFilter />
        <InertiaLink
          className="btn-indigo focus:outline-none"
          href={route('admin.menus.create')}
        >
          <span>Create</span>
          <span className="hidden md:inline"> Menu</span>
        </InertiaLink>
      </div>
      <div className="overflow-x-auto bg-white rounded shadow">
        <table className="w-full whitespace-nowrap">
          <thead>
            <tr className="font-bold text-left">
              <th className="px-6 pt-5 pb-4">Name</th>
              <th className="px-6 pt-5 pb-4">Route</th>
              <th className="px-6 pt-5 pb-4">Actions</th>
              <th className="px-6 pt-5 pb-4"></th>
            </tr>
          </thead>
          <tbody>
            {data.map(({ id, name, route_url, depth, deleted_at }) => {
              const child = depth > 0 ? <div className="ml-8" /> : null;
              return (
                <tr
                  key={id}
                  className="hover:bg-gray-100 focus-within:bg-gray-100"
                >
                  <td className="border-t">
                    <InertiaLink
                      href={route('admin.menus.edit', id)}
                      className="flex items-center px-6 py-4 focus:text-indigo-700 focus:outline-none"
                    >
                      {child} {name}
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
                      href={route('admin.menus.edit', id)}
                      className="flex items-center px-6 py-4 focus:text-indigo focus:outline-none"
                    >
                      {route_url}
                    </InertiaLink>
                  </td>
                  <td className="w-px border-t">
                    <a href="#" onClick={e => moveUp(e, id)}>
                      <Icon
                        name="faArrowUp"
                        className="flex-shrink-0 w-3 h-3 ml-2 text-gray-400 fill-current"
                      />
                    </a>{' '}
                    <a href="#" onClick={e => moveDown(e, id)}>
                      <Icon
                        name="faArrowDown"
                        className="flex-shrink-0 w-3 h-3 ml-2 text-gray-400 fill-current"
                      />
                    </a>{' '}
                    {depth > 0 && (
                      <a href="#" onClick={e => makeParent(e, id)}>
                        <Icon
                          name="faArrowLeft"
                          className="flex-shrink-0 w-3 h-3 ml-2 text-gray-400 fill-current"
                        />
                      </a>
                    )}
                  </td>
                  <td className="w-px border-t">
                    <InertiaLink
                      tabIndex="-1"
                      href={route('admin.menus.edit', id)}
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
                  No menus found.
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

Index.layout = page => <Layout title="Menus" children={page} />;

export default Index;
