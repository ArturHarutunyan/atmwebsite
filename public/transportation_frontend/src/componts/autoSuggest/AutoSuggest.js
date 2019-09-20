import React from "react";
import deburr from "lodash/deburr";
import Autosuggest from "react-autosuggest";
import match from "autosuggest-highlight/match";
import parse from "autosuggest-highlight/parse";
import TextField from "@material-ui/core/TextField";
import Paper from "@material-ui/core/Paper";
import MenuItem from "@material-ui/core/MenuItem";
import { makeStyles } from "@material-ui/core/styles";

function renderInputComponent(inputProps) {
  const { classes, inputRef = () => {}, ref, ...other } = inputProps;

  return (
    <TextField
      fullWidth
      InputProps={{
        inputRef: node => {
          ref(node);
          inputRef(node);
        },
        classes: {
          input: classes.input
        }
      }}
      {...other}
    />
  );
}

function renderSuggestion(suggestion, { query, isHighlighted }) {
  const matches = match(suggestion.label, query);
  const parts = parse(suggestion.label, matches);

  return (
    <MenuItem selected={isHighlighted} component="div">
      <div>
        {parts.map(part => (
          <span
            key={part.text}
            style={{ fontWeight: part.highlight ? 500 : 400 }}
          >
            {part.text}
          </span>
        ))}
      </div>
    </MenuItem>
  );
}

function getSuggestions(value, suggestions) {
  const inputValue = deburr(value.trim()).toLowerCase();
  const inputLength = inputValue.length;
  let count = 0;

  return inputLength === 0
    ? []
    : suggestions.filter(suggestion => {
        const keep =
          count < 5 &&
          suggestion.label.slice(0, inputLength).toLowerCase() === inputValue;

        if (keep) {
          count += 1;
        }

        return keep;
      });
}

const getSuggestionValue = rout => suggestion => {
  rout.value = suggestion.id;
  rout.suggestion = suggestion;
  return suggestion.label;
};

const useStyles = makeStyles(theme => ({
  root: {
    height: "auto",
    flexGrow: 1,
    margin: "15px"
  },
  container: {
    position: "relative"
  },
  suggestionsContainerOpen: {
    position: "absolute",
    zIndex: 1,
    marginTop: theme.spacing(1),
    left: 0,
    right: 0
  },
  suggestion: {
    display: "block"
  },
  suggestionsList: {
    margin: 0,
    padding: 0,
    listStyleType: "none"
  },
  divider: {
    height: theme.spacing(2)
  }
}));
let suggestions = [];
export default function IntegrationAutosuggest(props) {
  const classes = useStyles();

  const {
    routes,
    index,
    callBack,
    formObject,
    thisPrices,
    changeInvalidItems,
    invalidItems
  } = props;
  const [state, setState] = React.useState({
    single: "",
    popper: ""
  });
  if (formObject.CarsRoutes && !suggestions.length) {
    suggestions = formObject.CarsRoutes.map((elem, index) => {
      return { label: elem.name, id: elem.id };
    });
  }

  React.useEffect(() => {
    setState({
      ...state,
      single: routes[index].value
    });
  }, [routes]);

  const [stateSuggestions, setSuggestions] = React.useState([]);

  const handleSuggestionsFetchRequested = ({ value }) => {
    setSuggestions(getSuggestions(value, suggestions));
  };

  const handleSuggestionsClearRequested = () => {
    setSuggestions([]);
  };

  const handleChange = name => (event, { newValue }) => {
    setState({
      ...state,
      [name]: newValue
    });

    let suggestedValue =
      (routes[index].suggestion && routes[index].suggestion.label) || "";

    if (suggestedValue && suggestedValue.trim() == newValue.trim())
      routes[index].value = routes[index].suggestion.id;
    else routes[index].value = newValue;

    callBack(
      routes[index],
      changeInvalidItems,
      invalidItems,
      routes,
      thisPrices
    );
  };

  const autosuggestProps = {
    renderInputComponent,
    suggestions: stateSuggestions,
    onSuggestionsFetchRequested: handleSuggestionsFetchRequested,
    onSuggestionsClearRequested: handleSuggestionsClearRequested,
    getSuggestionValue: getSuggestionValue(routes[index]),
    renderSuggestion
  };

  return (
    <div
      className={
        classes.root +
        " " +
        (formObject.isAdded && invalidItems.value ? "invalid" : "")
      }
      style={{ marginLeft: "20px" }}
    >
      <Autosuggest
        {...autosuggestProps}
        inputProps={{
          classes,
          id: "react-autosuggest-simple",
          label: "Երթուղի",
          placeholder: "Երթուղի",
          value: state.single,
          onChange: handleChange("single")
        }}
        theme={{
          container: classes.container,
          suggestionsContainerOpen: classes.suggestionsContainerOpen,
          suggestionsList: classes.suggestionsList,
          suggestion: classes.suggestion
        }}
        renderSuggestionsContainer={options => {
          return (
            <Paper {...options.containerProps} square>
              {options.children}
            </Paper>
          );
        }}
      />
      {/* <div className={classes.divider} /> */}
      {/* <Autosuggest
        {...autosuggestProps}
        inputProps={{
          classes,
          id: 'react-autosuggest-popper',
          label: 'Country',
          placeholder: 'With Popper',
          value: state.popper,
          onChange: handleChange('popper'),
          inputRef: node => {
            setAnchorEl(node);
          },
          InputLabelProps: {
            shrink: true,
          },
        }}
        theme={{
          suggestionsList: classes.suggestionsList,
          suggestion: classes.suggestion,
        }}
        renderSuggestionsContainer={options => (
          <Popper anchorEl={anchorEl} open={Boolean(options.children)}>
            <Paper
              square
              {...options.containerProps}
              style={{ width: anchorEl ? anchorEl.clientWidth : undefined }}
            >
              {options.children}
            </Paper>
          </Popper>
        )}
      /> */}
    </div>
  );
}
