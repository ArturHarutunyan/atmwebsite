import React from "react";
import PropTypes from "prop-types";
import deburr from "lodash/deburr";
import Downshift from "downshift";
import { makeStyles } from "@material-ui/core/styles";
import TextField from "@material-ui/core/TextField";
import Popper from "@material-ui/core/Popper";
import Paper from "@material-ui/core/Paper";
import MenuItem from "@material-ui/core/MenuItem";
import Chip from "@material-ui/core/Chip";

let suggestions = [];

function renderInput(inputProps) {
  const { InputProps, classes, ref, ...other } = inputProps;

  return (
    <TextField
      InputProps={{
        inputRef: ref,
        classes: {
          root: classes.inputRoot,
          input: classes.inputInput
        },
        ...InputProps
      }}
      {...other}
      inputProps={{
        ...other.inputProps
      }}
    />
  );
}

renderInput.propTypes = {
  /**
   * Override or extend the styles applied to the component.
   */
  classes: PropTypes.object.isRequired,
  InputProps: PropTypes.object
};

function renderSuggestion(suggestionProps) {
  const {
    suggestion,
    index,
    itemProps,
    highlightedIndex,
    selectedItem
  } = suggestionProps;
  const isHighlighted = highlightedIndex === index;
  const isSelected = (selectedItem || "").indexOf(suggestion.label) > -1;

  return (
    <MenuItem
      {...itemProps}
      key={suggestion.label}
      selected={isHighlighted}
      component="div"
      style={{
        fontWeight: isSelected ? 500 : 400
      }}
    >
      {suggestion.label}
    </MenuItem>
  );
}

renderSuggestion.propTypes = {
  highlightedIndex: PropTypes.oneOfType([
    PropTypes.oneOf([null]),
    PropTypes.number
  ]).isRequired,
  index: PropTypes.number.isRequired,
  itemProps: PropTypes.object.isRequired,
  selectedItem: PropTypes.string.isRequired,
  suggestion: PropTypes.shape({
    label: PropTypes.string.isRequired
  }).isRequired
};

function getSuggestions(value, { showEmpty = false } = {}, sug) {
  const inputValue = deburr(value.trim()).toLowerCase();
  const inputLength = inputValue.length;
  let count = 0;

  return inputLength === 0 && !showEmpty
    ? []
    : sug.filter(suggestion => {
        const keep =
          suggestion.label.slice(0, inputLength).toLowerCase() === inputValue;

        if (keep) {
          count += 1;
        }

        return keep;
      });
}

const useStyles = makeStyles(theme => ({
  root: {
    flexGrow: 1,
    height: 250
  },
  container: {
    flexGrow: 1,
    position: "relative",
    margin: 15,
    marginLeft: 20,
    width: "90%"
  },
  paper: {
    position: "absolute",
    zIndex: 1,
    marginTop: theme.spacing(1),
    left: 0,
    right: 0
  },
  chip: {
    margin: theme.spacing(0.5, 0.25)
  },
  inputRoot: {
    flexWrap: "wrap"
  },
  inputInput: {
    width: "auto",
    flexGrow: 1
  },
  divider: {
    height: theme.spacing(2)
  }
}));

let popperNode;

let optionsKeys = {};

export default function IntegrationDownshift(props) {
  const classes = useStyles();
  const [inputVal, changeInputValue] = React.useState("");

  const [labelUp, setLabelUp] = React.useState(false);
  const [sug, changeSug] = React.useState([]);

  const {
    routes,
    index,
    callBack,
    formObject,
    thisPrices,
    changeInvalidItems,
    invalidItems,
    changeRoutes,
    someLength
  } = props;

  React.useEffect(() => {
    // console.log(formObject);

    changeSug(
      formObject.CarsRoutes.map((elem, index) => {
        optionsKeys[elem.name] = elem.id;
        return { label: elem.name, id: elem.id };
      })
    );

    changeInputValue(routes[index].stringValue || "");
    // console.log(suggestions);
  }, [routes.length, routes, routes[index], formObject.CarsRoutes.length]);

  function handleChange(newValue) {
    routes[index].value = optionsKeys[newValue.trim()] || newValue;

    routes[index].stringValue = newValue;
    callBack(
      routes[index],
      changeInvalidItems,
      invalidItems,
      routes,
      thisPrices
    );

    changeRoutes([...routes]);
  }

  return (
    <Downshift
      id="downshift-options"
      onStateChange={({ inputValue }) => {
        if (!inputValue) return;
        handleChange(inputValue);

        return inputValue && changeInputValue(inputValue);
      }}
      selectedItem={inputVal}
      onChange={(selection, index) => {
        handleChange(selection || "");
        return changeInputValue(selection);
      }}
    >
      {({
        clearSelection,
        getInputProps,
        getItemProps,
        getLabelProps,
        getMenuProps,
        highlightedIndex,
        inputValue,
        isOpen,
        openMenu,
        selectedItem
      }) => {
        const { onBlur, onChange, onFocus, ...inputProps } = getInputProps({
          onChange: event => {
            if (event.target.value === "") {
              clearSelection();
            }
          },
          onFocus: () => {
            openMenu();
            setLabelUp(true);
          },

          onBlur: event => {
            inputProps.value = event.target.value;
            setLabelUp(false);
          },
          placeholder: "Երթուղի"
        });

        // console.log(inputVal);
        return (
          <div
            className={
              classes.container +
              (formObject.isAdded &&
              !routes[index].isValid &&
              !routes[index].value
                ? " invalid"
                : "")
            }
          >
            {renderInput({
              fullWidth: true,
              classes,

              label: "Երթուղի",
              InputLabelProps: getLabelProps({
                shrink: !!inputVal || labelUp
              }),
              InputProps: { onBlur, onChange, onFocus },
              inputProps: { ...inputProps }
            })}

            <div {...getMenuProps()}>
              {isOpen ? (
                <Paper className={classes.paper} square>
                  {getSuggestions(inputValue, { showEmpty: true }, sug).map(
                    (suggestion, index) =>
                      renderSuggestion({
                        suggestion,
                        index,
                        itemProps: getItemProps({ item: suggestion.label }),
                        highlightedIndex,
                        selectedItem
                      })
                  )}
                </Paper>
              ) : null}
            </div>
          </div>
        );
      }}
    </Downshift>
  );
}
