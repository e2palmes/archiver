import React from "react";


function MenuOption({ id, anchorRef, label, handleClick }) {
  return (
    < a href={anchorRef} >
      <div id={id} className="py-3 border-b-2 text-center option" onClick={handleClick}>
        {label}
      </div>
    </a >
  )
};


export default MenuOption;