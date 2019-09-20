import React from "react";
import Fab from "@material-ui/core/Fab";
import AddIcon from "@material-ui/icons/Add";
import DeleteIcon from "@material-ui/icons/Delete";

function Add(props) {
  return (
    <Fab
      color="primary"
      aria-label="add"
      className={" addCarFormContainer " + (props.className || "")}
      onClick={props.onClick}
    >
      <AddIcon />
    </Fab>
  );
}

function Delete(props) {
  return (
    <Fab
      aria-label="delete"
      className={" removeButtonContainer " + (props.className || "")}
      onClick={props.onClick}
    >
      <DeleteIcon />
    </Fab>
  );
}

export { Add, Delete };
