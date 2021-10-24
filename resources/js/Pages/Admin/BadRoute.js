import React from 'react';
import Layout from '@/Shared/Layout';
import { Link } from '@inertiajs/inertia-react';

const Index = prop => {
  console.log(location.search);
  return (
    <div>
      <h1 className="mb-8 text-3xl font-bold">You have found a bad menu</h1>
      <p>
        Please go to admin =&gt;{' '}
        <Link
          className="hover:underline text-indigo-400 hover:text-indigo-700"
          href={route('admin.menus')}
        >
          menus
        </Link>{' '}
        and edit this menu item to point to a valid route
      </p>
      <p className="mt-6">Contact IT support</p>
    </div>
  );
};

Index.layout = page => <Layout title="Bad route" children={page} />;

export default Index;
