import React from 'react';

export default props => {
  const { errors, divClasses, label, name, ...replace } = props;

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
      <div className="text-xs text-red-700 ml-5">{errors}</div>
    </div>
  );
};
