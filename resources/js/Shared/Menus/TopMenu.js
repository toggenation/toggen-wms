import React from 'react';
import classNames from 'classnames';
import { Link } from '@inertiajs/inertia-react';

const TgnListItem = props => {
  const classes = classNames({
    'text-gray-400 cursor-not-allowed': props.disabled,
    'text-indigo-300 hover:text-indigo-700': !props.active && !props.disabled,
    'text-indigo-500 hover:text-indigo-800': props.active
  });

  if (props.disabled) {
    return <span className={classes}>{props.text}</span>;
  }

  return (
    <li className="mr-6">
      <Link
        disabled={props.disabled}
        className={classes}
        href={route(props.route)}
        title={props.title}
      >
        {props.text}
      </Link>
    </li>
  );
};

export default props => {
  const items = [
    {
      text: 'Pallet Print',
      title: 'Print Pallet Labels Active',
      route: 'reports',
      active: true,
      disabled: false
    },
    {
      text: 'Pallet Re-Print',
      title: 'Reprint a pallet label Not Active',
      route: 'contacts.create',
      active: false,
      disabled: false
    },
    {
      text: 'Disabled',
      title: 'Example of disabled link',
      route: 'organizations',
      active: false,
      disabled: true
    }
  ];

  return (
    <ul className="flex">
      {items &&
        items.map((data, index) => {
          return <TgnListItem key={index} {...data} />;
        })}
    </ul>
  );
};
