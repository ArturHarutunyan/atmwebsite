function onPreviewDrop(newFiles, files, setFiles, carForm) {
  setFiles(files.concat(newFiles));

  carForm.files = files.concat(newFiles);
}
let carsCounter = 1;
function addCar(cars, changeCars) {
  let carObj = { uniqueId: carsCounter + "_unique" };
  carsCounter++;
  cars.push(carObj);
  changeCars([...cars]);
}

function deleteCar(cars, changeCars, index) {
  cars.splice(index, 1);
  changeCars([...cars]);
}

const handleChange = (setWorking_volume, carForm) => event => {
  setWorking_volume(event.target.value);
  carForm.working_volume = event.target.value;
};

function selectChange(event, setFuelType, carForm) {
  setFuelType(oldValues => ({
    ...oldValues,
    value: event.target.value,
    isValid: true
  }));

  carForm.fuelType.value = event.target.value;
}
let inputDetector = null;

const handleValueChange = (
  input,
  changeCars,
  changeInputs,
  cars,
  inputs
) => event => {
  clearTimeout(inputDetector);
  inputDetector = null;
  inputDetector = setTimeout(() => {
    // console.log(inputDetector)
    changeCars([...cars]);
  }, 500);

  // console.log(event.value);

  input.value = (event.target && event.target.value) + "";
  console.log(input.value);

  input.isValid = true;

  input.validators.forEach(validator => {
    if (!validator(input.value)) {
      input.isValid = false;
    }
  });

  changeInputs([...inputs]);
};

const addService = (service, changeService) => {
  service.push({ value: "" });
  changeService([...service]);
};

const removeService = (service, changeService, index) => {
  service.splice(index, 1);
  changeService([...service]);
};

const changeComboBoxValue = (
  input,
  handleChange,
  inputArray,
  callBack,
  cars,
  changeCars
) => event => {
  input.value = event.value;
  input.isValid = true;
  input.checkBoxLabel = event.label;
  handleChange([...inputArray]);

  changeCars([...cars]);

  callBack(event);
};

export {
  onPreviewDrop,
  addCar,
  deleteCar,
  handleChange,
  selectChange,
  handleValueChange,
  changeComboBoxValue,
  addService,
  removeService
};
