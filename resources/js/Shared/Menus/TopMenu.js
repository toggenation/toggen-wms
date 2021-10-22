import React from 'react';
import classNames from 'classnames';
import { Link } from '@inertiajs/inertia-react';
import { usePage } from '@inertiajs/inertia-react';
import Icon from '@/Shared/Icon';

const TgnListItem = props => {
  const classes = classNames({
    flex: true,
    'text-gray-400 cursor-not-allowed': props.disabled,
    'text-indigo-300 hover:text-indigo-700': !props.active && !props.disabled,
    'text-indigo-500 hover:text-indigo-800': props.active
  });
  const { isActive } = props;
  const iconClasses = classNames('w-4 h-4 mr-2', {
    'text-indigo fill-current': isActive,
    'text-indigo-400 group-hover:text-white fill-current': !isActive
  });

  if (props.disabled) {
    return <span className={classes}>{props.text}</span>;
  }

  return (
    <li className="flex mr-6">
      <Link
        disabled={props.disabled}
        className={classes}
        href={route(props.route)}
        title={props.title}
      >
        <Icon name={props.icon} className={iconClasses} />
        {props.text}
      </Link>
    </li>
  );
};

export default props => {
  const { app_menus } = usePage().props;
  const { menus } = app_menus;

  const childMenus = menus.filter(menu => {
    // console.log(menu);
    // console.log({ rtbl: menu.route_url, rc: route().current() });
    return route().current().indexOf(menu.route_url) !== -1;
  });

  const renderMenus = childMenus[0] ? childMenus[0].children : [];

  // const items = [
  //   {
  //     text: 'Pallet Print',
  //     title: 'Print Pallet Labels Active',
  //     route: 'reports',
  //     active: false,
  //     disabled: false
  //   },
  //   {
  //     text: 'Pallet Re-Print',
  //     title: 'Reprint a pallet label Not Active',
  //     route: 'contacts.create',
  //     active: false,
  //     disabled: false
  //   },
  //   {
  //     text: 'Menus',
  //     title: 'Menus',
  //     route: 'menus',
  //     active: true,
  //     disabled: false
  //   },
  //   {
  //     text: 'Disabled',
  //     title: 'Example of disabled link',
  //     route: 'organizations',
  //     active: false,
  //     disabled: true
  //   }
  // ];

  return (
    <ul className="flex">
      {renderMenus &&
        renderMenus.map((data, index) => {
          const attributes = {
            text: data.name,
            title: data.description || '',
            route: data.route_url,
            active: true,
            disabled: false,
            icon: data.icon,
            isActive: data.route_url === route().current()
          };
          return <TgnListItem key={data.id} {...attributes} />;
        })}
    </ul>
  );
};
