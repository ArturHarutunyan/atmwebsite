import React, { useState, useCallback, useEffect } from "react";
import { makeStyles, MuiThemeProvider } from "@material-ui/core/styles";
import { createMuiTheme } from "@material-ui/core/styles";
import blue from "@material-ui/core/colors/blue";
import red from "@material-ui/core/colors/red";
import PeopleIcon from "@material-ui/icons/People";
import DirectionsCarIcon from "@material-ui/icons/DirectionsCar";
import AttachMoneyIcon from "@material-ui/icons/AttachMoney";

import Partner from "./componts/partner/Partner";
import SectionTitle from "./componts/sectionTitle/SectionTitle";
import PricesContainer from "./componts/prices/PricesContainer";

import { UserProvider } from "./contextBigForm.jsx";
import CustomizedSnackbars from "./componts/notification/Notification";
import Paper from "@material-ui/core/Paper";
import CarsContainer from "./componts/cars/CarsContainer";
import MoreHorizIcon from "@material-ui/icons/MoreHoriz";

import TextareaAutosize from "@material-ui/core/TextareaAutosize";

import Axios from "axios";

import {
  removeEmptyPriceForms,
  setFormPrices,
  carsFormValidationChecking,
  partnerValidationChecking
} from "./helper/validationChackers";
// import { TextField } from "@material-ui/core";

let stateOfApplication = {};

const useStyles = makeStyles(theme => ({
  container: {
    display: "flex",
    flexWrap: "wrap",
    textAlign: "center"
  },
  rightIcon: {
    marginLeft: theme.spacing(1)
  }
}));

const materialBlue = blue[900];
const materialRed = red[500];

const theme = createMuiTheme({
  palette: {
    primary: {
      main: materialBlue
    },
    secondary: {
      main: materialRed
    }
  }
});

const App = React.memo(() => {
  const classes = useStyles();

  const [formObject, changeFormObject] = useState({
    partnerInfo: {
      legal_name: "",
      phone_number: "",
      Email: "",
      AVC: "",
      notes: "",
      name: "",
      legal_address: "",
      business_address: "",
      directors_name: ""
    },
    partnerInfoValidArray: [],
    // todo adding cars checkboxes
    cars: [{ uniqueId: "1_unique" }],
    prices: [{ uniqueId: "1_unique" }],

    errorTexts: "",
    successText: "Ձեր հայտն ընդունված Է , շնորհակալություն",
    infoText: "Ձեր հարցումը մշակվում է խնդրում ենք սպասել ",
    isFormValid: true,
    isAdded: false,
    notificationType: "error",
    isSended: false,
    callBacks: [],
    carsMake: [],
    CarsRoutes: []
    // count:0
  });

  const [cars, changeCars] = useState([{}]);

  const [prices, changePrices] = useState([{}]);

  useEffect(() => {
    async function getCarsMake() {
      let res = await Axios.get("/api/get_makes");

      formObject.carsMake = res.data;
      changeFormObject({ ...formObject });
    }
    getCarsMake();

    async function getRoutes() {
      let res = await Axios.get("/api/get_routes");

      formObject.CarsRoutes = res.data;

      changeFormObject({ ...formObject });
    }
    getRoutes();
  }, []);

  const carsContainer = useCallback(() => {
    return <CarsContainer cars={cars} />;
  }, [cars.length]);

  const pricesContainer = useCallback(() => {
    return <PricesContainer prices={prices} />;
  }, [prices.length]);

  // cb()

  function sendForm() {
    // if (formObject.isSended) return;
    formObject.cars = cars;
    formObject.prices = prices;
    formObject.errorTexts = "";
    partnerValidationChecking(formObject);
    carsFormValidationChecking(formObject);
    setFormPrices(formObject);
    removeEmptyPriceForms(formObject);

    let hasError = !!formObject.errorTexts.trim();

    formObject.notificationType = hasError ? "error" : "info";

    changeFormObject({
      ...formObject,
      isAdded: true,
      errorTexts: formObject.errorTexts,
      notificationType: hasError ? "error" : "info"
    });
    let fd = new FormData();

    if (!hasError) {
      formObject.cars.forEach((car, car_index) => {
        car.files.forEach(file => {
          fd.append("images_" + car_index + "[]", file);
        });
      });

      fd.append("formObject", JSON.stringify(formObject));

      // formObject.isSended = true;
      changeFormObject({ ...formObject, isSended: true });
      Axios({
        url: "/api/save_transportation_data",
        method: "POST",
        data: fd,
        headers: {
          "Content-Type":
            "multipart/form-data;boundary=" +
            Math.random()
              .toString()
              .substr(2)
        }
      }).then(function (response) {
        // console.log(response);
        if (response.data == 1) {
          changeFormObject({
            ...formObject,
            notificationType: "success",
            responseStatus: 1,
            successText: "ձեր հայտն ընդունված է , շնորհակալություն ",
            isSended: true
          });
        } else {
          changeFormObject({
            ...formObject,
            notificationType: "error",
            responseStatus: 2,
            errorTexts: "համակարգում սխալ կա",
            isSended: true
          });
        }
      });

      // setTimeout(() => {
      //   changeFormObject({ ...formObject, notificationType: "success" });
      // }, 3000);
    }
  }

  return (
    <MuiThemeProvider theme={theme}>
      <div className="form">
        <UserProvider
          value={{
            formObject,
            changeFormObject,
            cars,
            changeCars,
            prices,
            changePrices
          }}
        >
          <form className={classes.container} autoComplete="off">

            <Paper style={{
              width: "100%",
              padding: "15px 21px",
              textAlign: "left",
              display: "block",

              transform: " scaleX(1.03)",
              boxShadow: "0px 1px 3px 0px rgba(0,0,0,0.0), 0px 1px 1px 0px rgba(0,0,0,0.14), 0px 2px 1px -1px rgba(0,0,0,0.12)",
              borderRadius: '0',

            }}>
              <img src={'/logo.jpg'} style={{ width: "250px" }} />
            </Paper>


            <SectionTitle number={<PeopleIcon />} title={"Գործընկերոջ մասին տեղեկություն"} />

            <div style={{ marginTop: '20px' }}>

              <Paper>
                <Partner />
              </Paper>
            </div>
            <SectionTitle number={<DirectionsCarIcon />} title={"Ավտոմեքենա"} />

            {carsContainer()}

            <SectionTitle
              number={<AttachMoneyIcon />}
              title={"Գներ"}
              style={{ marginBottom: "20px" }}
            />

            {pricesContainer()}

            <SectionTitle
              number={<MoreHorizIcon />}
              title={"Այլ տեղեկություն "}
              style={{ marginBottom: "20px" }}
            />
            <Paper style={{ width: "100%", padding: "30px 10px" }}>
              <TextareaAutosize

                aria-label="minimum height"
                rows={3}
                style={{
                  width: "calc(100% - 20px)",
                  margin: "10px",
                  fontSize: "18px"
                }}
                onChange={event => {
                  formObject.partnerInfo.notes = event.target.value.trim();
                }}
              />
            </Paper>

            <CustomizedSnackbars
              type={formObject.notificationType}
              massage={formObject}
              click={sendForm}
              buttonText="Ուղարկել"
              isSended={formObject.isSended}
              responseStatus={formObject.responseStatus}
            />
          </form>
        </UserProvider>
      </div>
    </MuiThemeProvider>
  );
});

export const appState = stateOfApplication;
export default App;
