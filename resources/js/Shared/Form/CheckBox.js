import React from 'react';

export default props => {
  const { divClasses, label, name, ...replace } = props;

  return (
    <div className={divClasses}>
      <label className="inline-flex items-center">
        <input
          name={name}
          {...replace}
          type="checkbox"
          className="form-checkbox"
        />
        <span className="ml-2">{label}</span>
      </label>
    </div>
  );
};
