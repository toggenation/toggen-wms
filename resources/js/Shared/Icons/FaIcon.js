import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import {
  faCheck,
  faPlus,
  faWarehouse,
  faTags,
  faCog,
  faTimes,
  faCogs,
  faTable,
  faListAlt,
  faTruckLoading,
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
      faArrowDown,
      faArrowLeft,
      faArrowRight,
      faArrowUp,
      faBarcode,
      faCalendarDay,
      faCaretRight,
      faChartLine,
      faCheck,
      faCog,
      faCogs,
      faExclamation,
      faExclamationTriangle,
      faExternalLinkAlt,
      faFileAlt,
      faListAlt,
      faPallet,
      faPlus,
      faTable,
      faTags,
      faTimes,
      faTruck,
      faTruckLoading,
      faWarehouse
    }[name] || faExclamationTriangle; //default if name isn't in object

  return <FontAwesomeIcon icon={importedIcon} className={className} />;
};
