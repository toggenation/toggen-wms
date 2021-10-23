import React from 'react';
import classNames from 'classnames';
import { Link } from '@inertiajs/inertia-react';
import { usePage } from '@inertiajs/inertia-react';
import Icon from '@/Shared/Icon';
const TopMenuListItem = props => {
  const classes = classNames({
    flex: true,
    'text-gray-400 cursor-not-allowed': props.disabled,
    'text-indigo-300 hover:text-indigo-700': !props.isActive && !props.disabled,
    'text-black hover:text-indigo-800': props.isActive
  });
  const { isActive } = props;
  const iconClasses = classNames('w-4 h-4 mr-2', {
    'text-black fill-current': isActive,
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

export default TopMenuListItem;
