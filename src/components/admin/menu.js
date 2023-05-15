import React from "react";
import MenuOption from "./menu-option";

export default function Menu({ onMenuItemClicked }) {
  return <>
    <MenuOption
      id="document"
      label="Documents"
      anchorRef="#documents"
      handleClick={onMenuItemClicked}
    />
    <MenuOption
      id="degree"
      label="Parcours"
      anchorRef="#parcours"
      handleClick={onMenuItemClicked}
    />
    <MenuOption
      id="pathway"
      label="Options"
      anchorRef="#options"
      handleClick={onMenuItemClicked}
    />
    <MenuOption
      id="level"
      label="Niveaux"
      anchorRef="#niveaux"
      handleClick={onMenuItemClicked}
    />
  </>
}