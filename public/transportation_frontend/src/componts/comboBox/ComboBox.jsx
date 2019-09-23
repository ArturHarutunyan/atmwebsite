import React, { useEffect } from "react";
import clsx from "clsx";
import Select from "react-select";
import { emphasize, makeStyles, useTheme } from "@material-ui/core/styles";
import Typography from "@material-ui/core/Typography";
import NoSsr from "@material-ui/core/NoSsr";
import TextField from "@material-ui/core/TextField";
import Paper from "@material-ui/core/Paper";
import Chip from "@material-ui/core/Chip";
import MenuItem from "@material-ui/core/MenuItem";
import CancelIcon from "@material-ui/icons/Cancel";

import { FixedSizeList as List } from "react-window";
import Axios from "axios";

const useStyles = makeStyles(theme => ({
  root: {
    flexGrow: 1,
    height: "auto",
    padding: "5px 13px"
  },
  input: {
    display: "flex",
    padding: 0,
    height: "auto"
  },
  valueContainer: {
    display: "flex",
    flexWrap: "wrap",
    flex: 1,
    alignItems: "center",
    overflow: "hidden"
  },
  chip: {
    margin: theme.spacing(0.5, 0.25)
  },
  chipFocused: {
    backgroundColor: emphasize(
      theme.palette.type === "light"
        ? theme.palette.grey[300]
        : theme.palette.grey[700],
      0.08
    )
  },
  noOptionsMessage: {
    padding: theme.spacing(1, 2)
  },
  singleValue: {
    fontSize: 16
  },
  placeholder: {
    position: "absolute",
    left: 2,
    bottom: 6,
    fontSize: 16
  },
  paper: {
    position: "absolute",
    zIndex: 1,
    marginTop: theme.spacing(1),
    left: 0,
    right: 0
  },
  divider: {
    height: theme.spacing(2)
  }
}));

function NoOptionsMessage(props) {
  return (
    <Typography
      color="textSecondary"
      className={props.selectProps.classes.noOptionsMessage}
      {...props.innerProps}
    >
      {props.children}
    </Typography>
  );
}

function inputComponent({ inputRef, ...props }) {
  return <div ref={inputRef} {...props} />;
}

function Control(props) {
  const {
    children,
    innerProps,
    innerRef,
    selectProps: { classes, TextFieldProps }
  } = props;

  return (
    <TextField
      fullWidth
      InputProps={{
        inputComponent,
        inputProps: {
          className: classes.input,
          ref: innerRef,
          children,
          ...innerProps
        }
      }}
      {...TextFieldProps}
    />
  );
}

function Option(props) {
  return (
    <MenuItem
      ref={props.innerRef}
      selected={props.isFocused}
      component="div"
      style={{
        fontWeight: props.isSelected ? 500 : 400
      }}
      {...props.innerProps}
    >
      {props.children}
    </MenuItem>
  );
}

function Placeholder(props) {
  const { selectProps, innerProps = {}, children } = props;
  return (
    <Typography
      color="textSecondary"
      className={selectProps.classes.placeholder}
      {...innerProps}
    >
      {children}
    </Typography>
  );
}

function SingleValue(props) {
  return (
    <Typography
      className={props.selectProps.classes.singleValue}
      {...props.innerProps}
    >
      {props.children}
    </Typography>
  );
}

function ValueContainer(props) {
  return (
    <div className={props.selectProps.classes.valueContainer}>
      {props.children}
    </div>
  );
}

function MultiValue(props) {
  return (
    <Chip
      tabIndex={-1}
      label={props.children}
      className={clsx(props.selectProps.classes.chip, {
        [props.selectProps.classes.chipFocused]: props.isFocused
      })}
      onDelete={props.removeProps.onClick}
      deleteIcon={<CancelIcon {...props.removeProps} />}
    />
  );
}

function Menu(props) {
  return (
    <Paper
      square
      className={props.selectProps.classes.paper}
      {...props.innerProps}
    >
      {props.children}
    </Paper>
  );
}

const height = 45;
let firstLength;
const MenuList = function MenuList(props) {
  const { options, children, maxHeight, getValue } = props;
  const [value] = getValue();
  const initialOffset = options.indexOf(value) * height;

  if (!children.length) {
    return <div className="myClassListName">{children}</div>;
  }

  // console.log(children);
  let lastFeatured = {};
  if (!firstLength) {
    firstLength = children.length;
  }

  children.forEach((elem, index) => {
    if (elem.props.data.is_featured) {
      lastFeatured = elem.props.data;
    }
  });
  return (
    <List
      height={maxHeight}
      itemCount={children.length}
      itemSize={height}
      initialScrollOffset={initialOffset}
    >
      {({ index, style }) => {
        return (
          <div style={style}>
            <span>{children[index]}</span>

            {firstLength == children.length &&
            lastFeatured.label == children[index].props.data.label ? (
              <div className="popular" />
            ) : (
              ""
            )}
          </div>
        );
      }}
    </List>
  );
};

const components = {
  Control,
  Menu,
  MultiValue,
  NoOptionsMessage,
  Option,
  Placeholder,
  SingleValue,
  ValueContainer,
  MenuList
};

export default function ComboBox(props) {
  const classes = useStyles();
  const theme = useTheme();
  const [single, setSingle] = React.useState(null);
  //   const [multi, setMulti] = React.useState(null);
  // const [suggestions, setSuggestions] = React.useState([]);

  let {
    carType,
    input,
    changeInputs,
    inputs,
    cars,
    changeCars,
    makes,
    models,
    index,
    thisCar,
    zeroSelected
  } = props;

  // console.log(makes, models);
  let suggestions = [];

  if (index == 0) {
    suggestions = makes
      .map((suggestion, index) => ({
        value: suggestion.id || index,
        label: suggestion.name,
        is_featured: suggestion.is_featured
      }))
      .sort(function(a, b) {
        if (a.is_featured) {
          return -1;
        }
        return 1;
      });
  } else if (models) {
    suggestions = models
      .map((suggestion, index) => ({
        value: suggestion.id || index,
        label: suggestion.name,
        is_featured: suggestion.is_featured
      }))
      .sort(function(a, b) {
        if (a.is_featured) {
          return -1;
        }
        return 1;
      });
  }

  let [isUserEvent, changeIsUserEvent] = React.useState(false);

  useEffect(() => {
    if (input.selected) {
      input.value = input.selected.value;
      setSingle(input.selected);
      if (index == 1) setSingle(zeroSelected);

      changeInputs([...inputs]);
    }
    changeIsUserEvent(false);
  }, []);

  useEffect(() => {
    if (index == 1 && isUserEvent) {
      input.isValid = false;
      input.value = "";
      input.checkBoxLabel = "";
      inputs[1].selected = "";
      setSingle(null);
    }
  }, [inputs[0].selected, thisCar.models]);

  function handleChangeSingle(event) {
    setSingle(event);

    console.log(event);
    input.value = event && event.value;
    input.isValid = event && true;
    input.checkBoxLabel = event && event.label;

    input.selected = event && event;

    if (index == 0) {
      thisCar.models = null;
      const getCarModels = () => {
        let data = (async () => {
          let res = await Axios("/api/get_models/" + inputs[0].value);
          return res.data;
        })();
        return data;
      };

      getCarModels().then(res => {
        // console.log(res);
        thisCar.models = res;
        inputs[1].isValid = false;
        inputs[1].value = "";
        inputs[1].checkBoxLabel = "";
        inputs[1].selected = "";

        changeCars([...cars]);
        changeInputs([...inputs]);
      });
    }

    // setTimeout(() => {
    // }, 500);
    changeCars([...cars]);
    changeInputs([...inputs]);

    changeIsUserEvent(true);
  }

  const selectStyles = {
    input: base => ({
      ...base,
      color: theme.palette.text.primary,
      "& input": {
        font: "inherit"
      }
    })
  };

  let comboBox = (
    <div className={classes.root + " comboBoxContainer"}>
      <NoSsr>
        <Select
          classes={classes}
          styles={selectStyles}
          inputId="react-select-single"
          isClearable={true}
          TextFieldProps={{
            label: props.label,
            placeholder: props.placeholder,
            InputLabelProps: {
              htmlFor: "react-select-single",
              shrink: index == 1 ? !!zeroSelected : !!single
            }
          }}
          placeholder={props.placeholder}
          options={suggestions}
          components={components}
          value={index == 1 ? zeroSelected : single}
          onChange={handleChangeSingle}
        />
      </NoSsr>
    </div>
  );

  return comboBox;
}
