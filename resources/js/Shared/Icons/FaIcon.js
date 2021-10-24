import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import {
  faPlus,
  faWarehouse,
  faTags,
  faCog,
  faCogs,
  faTable,
  faListAlt,
  faTruck,
  faFileAlt,
  faCalendarDay,
  faChartLine,
  faPallet,
  faExclamation,
  faBarcode
} from '@fortawesome/free-solid-svg-icons';

import PalletLabelIcon from '@/Shared/PalletLabelIcon';

export default ({ name, className }) => {
  const importedIcon =
    {
      faBarcode,
      faPallet,
      faChartLine,
      faWarehouse,
      faCalendarDay,
      faFileAlt,
      faTags,
      faTable,
      faTruck,
      faListAlt,
      faCog,
      faCogs,
      faPlus
    }[name] || faExclamation;

  return <FontAwesomeIcon icon={importedIcon} className={className} />;
};
