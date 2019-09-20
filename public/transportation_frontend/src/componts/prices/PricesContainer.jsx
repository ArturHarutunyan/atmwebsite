import React, { memo } from "react";

import Prices from "./Prices";

const PricesContainer = memo(({ prices }) => {
  return (
    <div id="pricesContainer">
      {prices.map((price, index) => {
        let key = (price.uniqueId || index) + "_price";
        return <Prices index={index} thisPriceForm={price} key={key} />;
      })}
    </div>
  );
});

export default PricesContainer;
