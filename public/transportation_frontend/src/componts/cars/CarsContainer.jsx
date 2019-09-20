import React, { memo } from "react";

import Cars from "./Cars";

const CarsContainer = memo(({ cars }) => {
  cars[0].uniqueId = "-1_unique";
  return (
    <div id="carsContainer">
      {cars.map((car, index) => {
        return (
          <Cars key={car.uniqueId + "_car"} index={index} thisCarForm={car} />
        );
      })}
    </div>
  );
});

export default CarsContainer;
