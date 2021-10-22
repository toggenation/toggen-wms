import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import {
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
  faPallet
} from '@fortawesome/free-solid-svg-icons';

import PalletLabelIcon from '@/Shared/PalletLabelIcon';

export default ({ name, className }) => {
  const importedIcon = {
    faPallet: faPallet,
    faChartLine: faChartLine,
    faWarehouse: faWarehouse,
    faCalendarDay: faCalendarDay,
    faFileAlt: faFileAlt,
    faTags: faTags,
    faTable: faTable,
    faTruck: faTruck,
    faListAlt: faListAlt,
    faCog: faCog,
    faCogs: faCogs
  }[name];
  return <FontAwesomeIcon icon={importedIcon} className={className} />;
};
