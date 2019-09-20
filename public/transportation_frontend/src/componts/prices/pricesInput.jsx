import React, { useState, useEffect } from "react";

import TextField from "@material-ui/core/TextField";
import Grid from "@material-ui/core/Grid";

// import InputAdornment from "@material-ui/core/InputAdornment";

const PricesInput = props => {
  const {
    input,
    inputsArray,
    index,
    classes,
    handleChange,
    thisPrices
  } = props;

  let [val, changeValue] = useState(inputsArray[index].value || "");

  // console.log(578989)

  useEffect(() => {
    // console.log(inputsArray)

    changeValue(inputsArray[index].value || "");
    // console.log(val)
  }, [inputsArray[index].value]);

  return (
    <Grid key={index} style={{ width: "50%" }}>
      <TextField
        // xs={6}
        id="standard-name"
        className={classes.textField}
        label={input.label + " (AMD)"}
        placeholder={"AMD " + input.label}
        margin="normal"
        value={val}
        // type={"number"}
        onChange={handleChange(input, changeValue, thisPrices)}
        // multiline={false}
        // InputProps={{
        //   startAdornment: <InputAdornment position="start"></InputAdornment>,
        //   shrink: true
        // }}
      />
    </Grid>
  );
};

export default PricesInput;
