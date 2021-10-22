import React from 'react';
import Layout from '@/Shared/Layout';

const Index = () => {
  const rt = route().current();
  const ucRoute = rt.charAt(0).toUpperCase() + rt.slice(1);

  return (
    <div>
      <h1 className="mb-8 text-3xl font-bold">Route: {ucRoute}</h1>
      <p>Blank Index placeholder to be replaced</p>
    </div>
  );
};

Index.layout = page => <Layout title="Blank" children={page} />;

export default Index;
