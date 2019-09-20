import React from "react";

const SectionTitle = props => {
  return (
    <legend style={props.style || null}>
      <span className="icon">{props.number}</span> {props.title}
    </legend>
  );
};

export default SectionTitle;
