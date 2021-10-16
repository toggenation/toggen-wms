import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import {
  faWarehouse,
  faTags,
  faTable,
  faTruck
} from '@fortawesome/free-solid-svg-icons';

import PalletLabelIcon from '@/Shared/PalletLabelIcon';

export default ({ name, className }) => {
  const importedIcon = {
    faWarehouse: faWarehouse,
    faTags: faTags,
    faTable: faTable,
    faTruck: faTruck
  }[name];
  return <FontAwesomeIcon icon={importedIcon} className={className} />;
};
