import React, { useContext, useState, useEffect } from "react";
import { makeStyles } from "@material-ui/core/styles";
import TextField from "@material-ui/core/TextField";
import Grid from "@material-ui/core/Grid";
import UserContext from "../../contextBigForm";

import { isEmail, isRequirers } from "../../helper/valdators";

const useStyles = makeStyles(theme => ({
  container: {
    display: "flex",
    flexWrap: "wrap",
    textAlign: "center"
  },
  textField: {
    marginLeft: theme.spacing(1),
    marginRight: theme.spacing(1),
    width: "90%"
  },
  dense: {
    marginTop: 19
  },
  menu: {
    width: 300
  }
}));

export default function Partner(props) {
  let { formObject } = useContext(UserContext);
  // let changeFormObject = useContext(UserContext)[1];

  const classes = useStyles();

  const [inputs, changeInputs] = useState([

    {
      label: "Անվանում *",
      name: "name",
      validators: [isRequirers],
      value: ""
    },
    {
      label: "Իրավաբանական Անուն *",
      name: " legal_name",
      validators: [isRequirers],
      value: ""
    },
    {
      label: "Հեռախոսահամար *",
      name: "phone_number",
      validators: [isRequirers],
      value: ""
    },

    {
      label: "Գործունեության հասցե *",
      name: "business_address",
      validators: [isRequirers],
      value: ""
    },
    {
      label: "Իրավաբանական հասցե *",
      name: "legal_address",
      validators: [isRequirers],
      value: ""
    },
    {
      label: "Էլ հասցե *",
      name: "Email",
      validators: [isEmail, isRequirers],
      value: ""
    },
    {
      label: "Տնօրենի անուն *",
      name: "directors_name",
      validators: [isRequirers],
      value: ""
    },
    {
      label: "ՀՎՀՀ *",
      name: "AVC",
      validators: [isRequirers],
      value: ""
    },








  ]);

  // _______________________________________________________________________________________ karoxa sxal ta
  useEffect(() => {
    formObject.partnerInfoValidArray = inputs;
  }, [inputs]);
  const handleValueChange = input => event => {
    // changeHandler({ ...values, value: event.target.value });
    input.value = event.target.value;
    input.isValid = true;

    input.validators.forEach(validator => {
      if (!validator(input.value)) {
        input.isValid = false;
      }
    });

    changeInputs([...inputs]);
    formObject.partnerInfo[input.name] = input.value;
  };

  return (
    <div className="Partner" style={{ textAlign: "left" }}>
      <div className={classes.container}>
        {inputs.map((input, index) => {
          return (
            <Grid
              item
              xs={6}
              key={index}
              className={!input.isValid && formObject.isAdded ? "invalid" : ""}
            >
              <TextField
                key={index}
                id="standard-name"
                value={input.value}
                className={classes.textField}
                label={input.label}
                placeholder={input.label}
                onChange={handleValueChange(input)}
                margin="normal"
              />
            </Grid>
          );
        })}
      </div>
    </div>
  );
}
