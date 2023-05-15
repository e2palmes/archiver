import React from "react";

const Board = ({ bData }) => {

  return (
    <>
      <div className="grid grid-cols-4 gap-4 w-full text-left">
        {/*  */}
        <div>
          <input type="checkbox" name="all" id="all" />
        </div>
        <div className="col-span-2">Label</div>
        <div>Supprimer</div>

        {/*  */}

        {bData.map(({ id, label }) => {
          return (
            <>
              <div>
                <input type="checkbox" name="all" id={id} />
              </div>
              <div className="">{label}</div>
              <div className="">modifier</div>
              <div>Supprimer</div>
            </>
          )
        })}
      </div>
    </>
  )
}

export default Board