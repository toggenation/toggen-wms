import React from 'react';
import { usePage } from '@inertiajs/inertia-react';
import TopMenuListItem from '@/Shared/Menus/TopMenuListItem';

export default props => {
  const { app_menus } = usePage().props;
  const { menus } = app_menus;

  const childMenus = menus.filter(menu => {
    // console.log(menu);
    // console.log({ rtbl: menu.route_url, rc: route().current() });
    return route().current().indexOf(menu.route_url) !== -1;
  });

  const renderMenus = childMenus[0] ? childMenus[0].children : [];

  return (
    <ul className="flex">
      {renderMenus &&
        renderMenus.map((data, index) => {
          // console.log(route().current(), data.route_url);
          const attributes = {
            text: data.name,
            title: data.description || '',
            route_url: data.route_url,
            icon: data.icon,
            isActive: data.route_url === route().current()
          };
          return <TopMenuListItem key={data.id} {...attributes} />;
        })}
    </ul>
  );
};
