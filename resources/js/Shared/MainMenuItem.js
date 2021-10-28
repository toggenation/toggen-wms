import React from 'react';
import { InertiaLink } from '@inertiajs/inertia-react';
import classNames from 'classnames';
import Icon from '@/Shared/Icon';
import { resolveRoute } from './util';

export default ({ icon, link, text }) => {
  const { linkRoute, external } = resolveRoute(link);

  const isActive = route().current(link + '*');

  const iconClasses = classNames('w-4 h-4 mr-2', {
    'text-white fill-current': isActive,
    'text-indigo-400 group-hover:text-white fill-current': !isActive
  });

  const textClasses = classNames({
    'text-white': isActive,
    'text-indigo-200 group-hover:text-white': !isActive
  });

  if (external) {
    return (
      <div className="mb-4">
        <a href={linkRoute} className="flex items-center group py-3">
          <Icon name={icon} className={iconClasses} />
          <div className={textClasses}>{text}</div>
        </a>
      </div>
    );
  }

  return (
    <div className="mb-4">
      <InertiaLink href={linkRoute} className="flex items-center group py-3">
        <Icon name={icon} className={iconClasses} />
        <div className={textClasses}>{text}</div>
      </InertiaLink>
    </div>
  );
};
