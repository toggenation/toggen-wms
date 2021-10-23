import React from 'react';

export default props => {
  const { label, errors, ...replace } = props;

  const attributes = {
    className: 'form-textarea mt-1 block w-full',
    rows: '3',
    placeholder: 'please enter a comment content.',
    ...replace
  };

  return (
    <div className="w-full pb-6">
      <label className="block text-left w-full pr-6">
        <span className="text-black">{label}</span>
        <textarea {...attributes}></textarea>
      </label>
      {errors && <div className="form-error">{errors}</div>}
    </div>
  );
};
