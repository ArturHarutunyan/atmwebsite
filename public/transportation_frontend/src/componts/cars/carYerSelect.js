import React from "react";
import { makeStyles } from "@material-ui/core/styles";
import InputLabel from "@material-ui/core/InputLabel";
import MenuItem from "@material-ui/core/MenuItem";
import FormControl from "@material-ui/core/FormControl";
import Select from "@material-ui/core/Select";
import Button from "@material-ui/core/Button";

const useStyles = makeStyles(theme => ({
  formControl: {
    margin: "16px  0 0 ",

    minWidth: "100%"
  }
}));
let counter = 0;
export default function CarYearSelect(props) {
  const classes = useStyles();
  const [year, setYear] = React.useState("");
  const [open, setOpen] = React.useState(false);
  const currentYear = new Date().getFullYear();

  React.useMemo(() => {
    setYear(props.value || "");
  }, []);
  function handleChange(event) {
    setYear(event.target.value);
    props.handleChange(event);
  }

  function handleClose() {
    setOpen(false);
  }

  function handleOpen() {
    setOpen(true);
  }

  return (
    <FormControl className={classes.formControl}>
      <InputLabel htmlFor="demo-controlled-open-select">
        արտադրման տարեթիվ
      </InputLabel>
      <Select
        open={open}
        onClose={handleClose}
        onOpen={handleOpen}
        value={year}
        onChange={handleChange}
        //   inputProps={{
        //     name: "year",
        //     id: "demo-controlled-open-select"
        //   }}
      >
        <MenuItem value="">
          <em>None</em>
        </MenuItem>

        {(() => {
          let optionItems = [];
          for (let i = 0; i < 21; i++) {
            optionItems.push(
              <MenuItem
                value={currentYear - i}
                key={"carYearSelect" + counter++}
              >
                {currentYear - i}
              </MenuItem>
            );
          }
          return optionItems;
        })()}
      </Select>
    </FormControl>
  );
}
