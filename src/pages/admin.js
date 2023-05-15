import React, { useEffect, useState } from "react";
import Menu from "../components/admin/menu";
import Board from "../components/admin/board";

const Admin = () => {

  const [activeMenuOption, setactiveMenuOption] = useState("pathway")
  // On recupere le contenu à afficher dans le Board 
  // Selon l'option de menu selectionnée
  useEffect(() => {
    fetch("http://localhost:8000/" + activeMenuOption, {
      method: "GET"
    })
      .then(response => { return response.json() })
      .then(data => {
        console.log(data);
        setBoardData(data);
      })
  }, [activeMenuOption])

  const [boardData, setBoardData] = useState();
  //

  // On gère le changement de menu
  // en cas de click sur une des options du menu
  function handleChangeMenu(menuId) {
    setactiveMenuOption(menuId.target.id);
  }
  // 

  return <div>
    <div className="flex mt-24 gap-8">
      <div className="w-2/12 bg-secondary">
        <Menu onMenuItemClicked={handleChangeMenu} />
      </div>
      <div className="w-full">
        <Board bData={boardData} />
      </div>
    </div>
  </div>
}

export default Admin;