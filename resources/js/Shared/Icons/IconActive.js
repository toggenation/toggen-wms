import React from 'react';
import FaIcon from './FaIcon';

export default ({ isActive }) => {
  const icon = isActive ? 'faCheck' : 'faTimes';
  console.log('Isactive', isActive, icon);
  return <FaIcon name={icon} />;
};
