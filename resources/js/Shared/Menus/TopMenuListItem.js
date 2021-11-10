import React from 'react';
import classNames from 'classnames';
import { Link } from '@inertiajs/inertia-react';
import { usePage } from '@inertiajs/inertia-react';
import Icon from '@/Shared/Icon';
import { resolveRoute } from '../util';
const TopMenuListItem = ({
  disabled,
  isActive,
  route_url,
  text,
  title,
  icon
}) => {
  // console.log(usePage().props);
  const { external, linkRoute } = resolveRoute(route_url);
  const textClasses = classNames({
    flex: true,
    'text-gray-400 cursor-not-allowed': disabled,
    'text-indigo-300 hover:text-indigo-700': !isActive && !disabled,
    'text-black hover:text-indigo-800': isActive
  });
  const iconClasses = classNames('w-4 h-4 mr-2', {
    'text-black fill-current': isActive,
    'text-indigo-400 group-hover:text-white fill-current': !isActive
  });

  if (disabled) {
    return <span className={textClasses}>{text}</span>;
  }

  if (external) {
    return (
      <li className="flex mr-6">
        <a target="_blank" className={textClasses} href={linkRoute}>
          <Icon name={icon} className={iconClasses} />
          {text}
        </a>
      </li>
    );
  }

  return (
    <li className="flex mr-6">
      <Link
        disabled={disabled}
        className={textClasses}
        href={linkRoute}
        title={title}
      >
        <Icon name={icon} className={iconClasses} />
        {text}
      </Link>
    </li>
  );
};

export default TopMenuListItem;
