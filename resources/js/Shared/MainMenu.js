import React from 'react';
import MainMenuItem from '@/Shared/MainMenuItem';

export default ({ className }) => {
  return (
    <div className={className}>
      <MainMenuItem text="Dashboard" link="dashboard" icon="dashboard" />
      <MainMenuItem text="Organizations" link="organizations" icon="office" />
      <MainMenuItem text="Contacts" link="contacts" icon="users" />
      <MainMenuItem text="Warehouse" link="reports" icon="faWarehouse" />
      <MainMenuItem text="Labels" link="reports" icon="faTags" />
      <MainMenuItem text="Items" link="reports" icon="faTable" />
      <MainMenuItem text="Reports" link="reports" icon="printer" />
      <MainMenuItem text="Dispatch" link="reports" icon="faTruck" />
    </div>
  );
};
