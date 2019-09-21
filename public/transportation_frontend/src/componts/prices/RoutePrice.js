import React, { useMemo } from "react";
import { Grid, TextField, InputAdornment } from "@material-ui/core";
import IntegrationAutosuggest from "../autoSuggest/AutoSuggest";
import { Add, Delete } from "../addDelete/AddDelete";

function checkValidation(
  route,
  changeInvalidItems,
  invalidItems,
  routes,
  thisPrices
) {
  if (!route.value && !route.price) {
    route.isValid = true;
    invalidItems.value = false;
    invalidItems.price = false;
  } else if (!route.value) {
    route.isValid = false;
    invalidItems.value = true;

    invalidItems.price = false;
  } else if (!route.price) {
    route.isValid = false;
    invalidItems.price = true;

    invalidItems.value = false;
  } else {
    route.isValid = true;
    invalidItems.value = false;
    invalidItems.price = false;
  }

  changeInvalidItems({ ...invalidItems });
  checkRoutesValidation(thisPrices, routes);
}

function checkRoutesValidation(thisPrices, routes) {
  thisPrices.routesAreValid = true;

  thisPrices.hasRoutePrice = false;
  try {
    routes.forEach(route => {
      if (route.value) thisPrices.hasRoutePrice = true;
      if (!route.isValid) throw new Error();
    });
  } catch (e) {
    thisPrices.routesAreValid = false;
    thisPrices.hasRoutePrice = false;
  }
}

const RoutePrice = props => {
  const {
    route,
    pricesForm,
    index,
    thisPrices,
    routes,
    classes,
    changeRoutesForm,
    formObject,
    changeRoutes
  } = props;

  route.price = route.price || "";

  const [price, changePrice] = React.useState(route.price || "");

  const [invalidItems, changeInvalidItems] = React.useState({
    price: false,
    value: false
  });

  React.useEffect(() => {
    route.isValid = true;
  }, []);
  React.useEffect(() => {
    changePrice(route.price);
  }, [route]);

  const autoSuggest = (
    <Grid style={{ width: "50%" }}>
      {/* rout name */}
      <IntegrationAutosuggest
        xs={6}
        input={route}
        inputsArray={pricesForm}
        index={index}
        thisPrices={thisPrices}
        formObject={formObject}
        invalidItems={invalidItems}
        changeInvalidItems={changeInvalidItems}
        callBack={checkValidation}
        routes={routes}
        changeRoutes={changeRoutes}
        currentComponent={thisPrices}
        carsRoutes={formObject.CarsRoutes}
      />
    </Grid>
  );
  const routePrice = useMemo(
    () => (
      <Grid>
        <TextField
          className={
            classes.textField +
            " " +
            (formObject.isAdded && (!route.isValid && !route.price.value)
              ? "invalid"
              : "")
          }
          xs={3}
          label={"Գին (AMD)"}
          placeholder={"AMD Գին"}
          margin="normal"
          value={price}
          style={{ marginLeft: "20px" }}
          onChange={event => {
            let target = event.target;
            let value = target.value.replace(/\,/g, "");
            if (event.target.value.length >= 9) {
              target.value = target.value.slice(0, target.value.length - 1);
              return;
            }

            let newValue = new Intl.NumberFormat("ja-JP").format(value);

            if (isNaN(value) || newValue === "0") {
              newValue = "";
            }

            route.price = newValue;
            changePrice(route.price);
            checkValidation(
              route,
              changeInvalidItems,
              invalidItems,
              routes,
              thisPrices
            );
          }}
          // InputProps={{
          //   startAdornment: (
          //     <InputAdornment position="start">AMD</InputAdornment>
          //   )
          // }}
        />
      </Grid>
    ),
    [route, formObject.isAdded, invalidItems, price]
  );

  return (
    <div className="relative w-100 dFlex  addRoutePriceContainer ">
      {autoSuggest}

      {routePrice}

      <div className={"routesButtonsContainer"}>
        {index > 0 ? (
          <Delete
            onClick={() => {
              routes.splice(index, 1);
              changeRoutesForm([...routes]);

              thisPrices.routes = routes;
              checkRoutesValidation(thisPrices, routes);
            }}
          />
        ) : (
          <Add
            onClick={() => {
              routes.push({ value: "", isValid: true });
              changeRoutesForm([...routes]);

              thisPrices.routes = routes;
              checkRoutesValidation(thisPrices, routes);
            }}
          />
        )}
      </div>
    </div>
  );
};
export default RoutePrice;
