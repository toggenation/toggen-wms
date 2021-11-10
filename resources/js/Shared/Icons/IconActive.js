import React from 'react';
import FaIcon from './FaIcon';

export default ({ isActive }) => {
  const icon = isActive ? 'faCheck' : 'faTimes';
  return <FaIcon name={icon} />;
};
