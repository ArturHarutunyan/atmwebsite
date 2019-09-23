import React, { useState, useEffect, useContext, memo, useMemo } from "react";

import PricesInput from "./pricesInput";

import PricesCheckbox from "./PricesCheckbox";
import { makeStyles } from "@material-ui/core/styles";
import Grid from "@material-ui/core/Grid";
import Button from "@material-ui/core/Button";

import UserContext from "../../contextBigForm";
import { Add, Delete } from "../addDelete/AddDelete";
import {
  addingCarPrices,
  addPrice,
  setCheckboxesState,
  deletePrice,
  handleChange
} from "./handleFunctions";
import { Paper } from "@material-ui/core";

import { staticPrices } from "../../helper/carRantePrices";
import RoutePrice from "./RoutePrice";

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
  button: {
    margin: 35
  },
  input: {
    display: "none"
  },
  marginLeft: {
    marginLeft: theme.spacing(1)
  }
}));
let keyCount = 0;

export default memo(function({ index, thisPriceForm }) {
  let { prices, changePrices, cars: carFromeOut, formObject } = useContext(
    UserContext
  );

  const classes = useStyles();
  let [thisPrices] = useState(thisPriceForm);
  let [cars, changeCars] = useState([]);
  let [checkboxes, changeCheckboxes] = useState([]);

  useEffect(() => {
    thisPrices.prices = {};
    thisPrices.cars = [];

    thisPrices.routesAreValid = true;

    changeCars(carFromeOut);
  }, []);

  useEffect(() => {
    changeCars(carFromeOut);
    setCheckboxesState(true, changeCheckboxes, carFromeOut, checkboxes);
  }, [carFromeOut]);

  const [showPrices, ChangeShowPrices] = useState(false);

  let [pricesForm, changePricesForm] = useState([
    ...JSON.parse(JSON.stringify(staticPrices))
  ]);
  let [routes, changeRoutesForm] = useState([]);

  useEffect(() => {
    thisPriceForm.pricesForm = thisPriceForm.pricesForm || [
      ...JSON.parse(JSON.stringify(staticPrices))
    ];
    thisPriceForm.routes = thisPriceForm.routes || [{ value: "" }];

    changePricesForm(thisPriceForm.pricesForm);
    changeRoutesForm(thisPriceForm.routes);

    if (!pricesForm.length) {
      setCheckboxesState(true, changeCheckboxes, carFromeOut, checkboxes);
    }
  }, [prices.length]);

  let routesCB = useMemo(() => {
    return routes.map((route, index) => {
      keyCount++;
      return (
        <RoutePrice
          kye={"routePrice" + keyCount}
          route={route}
          pricesForm={pricesForm}
          index={index}
          thisPrices={thisPrices}
          formObject={formObject}
          routes={routes}
          changeRoutes={changeRoutesForm}
          classes={classes}
          changeRoutesForm={changeRoutesForm}
        />
      );
    });
  }, [routes.length, formObject.isAdded]);

  let pricesCB = useMemo(() => {
    return pricesForm.map((priceInput, index) => {
      keyCount++;
      return (
        <PricesInput
          key={keyCount + "unique_inputRoot"}
          input={priceInput}
          inputsArray={pricesForm}
          index={index}
          thisPrices={thisPrices}
          handleChange={addingCarPrices}
          prices={prices}
          currentComponent={thisPrices}
          classes={classes}
        />
      );
    });
  }, [pricesForm]);

  return (
    <div className="priceFormContainer">
      <Paper>
        <div className="Prices" style={{ textAlign: "left", width: "100%" }}>
          <div className={"absoluteCounter priceCounter"}>{index + 1}</div>
          {cars.length > 1 && index === 0 ? (
            <Add onClick={() => addPrice(prices, changePrices)} />
          ) : null}
          <div>
            {prices.length > 1 && index !== 0 ? (
              <Delete
                onClick={() =>
                  deletePrice(
                    prices,
                    changePrices,
                    index,
                    setCheckboxesState,
                    changeCheckboxes,
                    carFromeOut,
                    checkboxes,
                    deletePrice
                  )
                }
              />
            ) : null}

            <div className={"checkboxesContainer"}>
              {checkboxes.map((checkbox, index) => {
                // console.log(thisPrices === cars[index].priceForm)
                // if(!!car.inputs[0].value ) return null;
                return (
                  <>
                    {checkbox.car.inputs[0].value ||
                    checkbox.car.inputs[1].value ? (
                      <PricesCheckbox
                        index={index}
                        car={checkbox.car}
                        classes={classes}
                        thisPrices={thisPrices}
                        checkbox={checkbox}
                        changeCars={changeCars}
                        cars={cars}
                        handleChange={handleChange}
                      />
                    ) : null}
                  </>
                );
              })}
            </div>

            <div className={classes.container + " price-inputs"}>
              {pricesCB}

              {routesCB}
            </div>
          </div>
        </div>
      </Paper>
    </div>
  );
});
