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
  faBarcode,
  faCaretRight,
  faExternalLinkAlt,
  faArrowUp,
  faArrowDown,
  faArrowLeft,
  faArrowRight,
  faExclamationTriangle
} from '@fortawesome/free-solid-svg-icons';

import PalletLabelIcon from '@/Shared/PalletLabelIcon';

export default ({ name, className }) => {
  const importedIcon =
    {
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
      faBarcode,
      faCaretRight,
      faExternalLinkAlt,
      faArrowUp,
      faArrowDown,
      faArrowLeft,
      faArrowRight,
      faExclamationTriangle
    }[name] || faExclamationTriangle; //default if name isn't in object

  return <FontAwesomeIcon icon={importedIcon} className={className} />;
};
