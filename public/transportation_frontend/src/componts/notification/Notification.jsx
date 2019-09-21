import React, { useEffect } from "react";
import PropTypes from "prop-types";
import clsx from "clsx";
import Button from "@material-ui/core/Button";
import CheckCircleIcon from "@material-ui/icons/CheckCircle";
import ErrorIcon from "@material-ui/icons/Error";
import InfoIcon from "@material-ui/icons/Info";
import CloseIcon from "@material-ui/icons/Close";
import { amber, green } from "@material-ui/core/colors";
import IconButton from "@material-ui/core/IconButton";
import Snackbar from "@material-ui/core/Snackbar";
import SnackbarContent from "@material-ui/core/SnackbarContent";
import WarningIcon from "@material-ui/icons/Warning";
import { makeStyles } from "@material-ui/core/styles";
import SendIcon from "@material-ui/icons/Send";
import CircularIndeterminate from "../preloader/Preloader";

const variantIcon = {
  success: CheckCircleIcon,
  warning: WarningIcon,
  error: ErrorIcon,
  info: InfoIcon
};

const useStyles1 = makeStyles(theme => ({
  success: {
    backgroundColor: green[600]
  },
  error: {
    backgroundColor: theme.palette.error.dark
  },
  info: {
    backgroundColor: theme.palette.primary.main
  },
  warning: {
    backgroundColor: amber[700]
  },
  icon: {
    fontSize: 20
  },
  iconVariant: {
    opacity: 0.9,
    marginRight: theme.spacing(1)
  },
  message: {
    display: "flex",
    alignItems: "center"
  },
  rightIcon: {
    marginLeft: theme.spacing(1)
  },
  button: {
    margin: theme.spacing(1)
  }
}));

function MySnackbarContentWrapper(props) {
  const classes = useStyles1();
  const { className, message, onClose, variant, ...other } = props;
  const Icon = variantIcon[variant];

  return (
    <SnackbarContent
      className={clsx(classes[variant], className)}
      aria-describedby="client-snackbar"
      message={
        <span id="client-snackbar" className={classes.message}>
          <Icon className={clsx(classes.icon, classes.iconVariant)} />
          {message}
        </span>
      }
      action={[
        <IconButton
          key="close"
          aria-label="close"
          color="inherit"
          onClick={onClose}
        >
          <CloseIcon className={classes.icon} />
        </IconButton>
      ]}
      {...other}
    />
  );
}

MySnackbarContentWrapper.propTypes = {
  className: PropTypes.string,
  message: PropTypes.string,
  onClose: PropTypes.func,
  variant: PropTypes.oneOf(["error", "info", "success", "warning"]).isRequired
};

const useStyles2 = makeStyles(theme => ({
  margin: {
    margin: theme.spacing(1)
  },
  rightIcon: {
    marginLeft: theme.spacing(1)
  }
}));

export default function CustomizedSnackbars(props) {
  const classes = useStyles2();
  const [open, setOpen] = React.useState(false);

  let [errorMassage, changeErrorMassage] = React.useState(
    props.massage.errorTexts
  );
  let [successMassage] = React.useState(props.massage.successText);
  let [infoMassage] = React.useState(props.massage.infoText);

  let [type, changeType] = React.useState(props.massage.notificationType);

  useEffect(() => {
    changeErrorMassage(props.massage.errorTexts);

    changeType(props.massage.notificationType);
    // changeType(props.massage.type)
  }, [props.massage.errorTexts, props.massage.notificationType]);
  function handleClick() {
    props.click();

    changeErrorMassage(props.massage.errorTexts);
    changeType(props.massage.notificationType);
    setTimeout(() => {
      setOpen(true);
    });
  }

  function handleClose(event, reason) {
    if (reason === "clickaway") {
      return;
    }

    setOpen(false);

    // changeErrorMassage(props.massage.errorTexts);
  }

  return (
    <React.Fragment>
      {!props.isSended ? (
        <Button
          variant="contained"
          color="primary"
          className={classes.button + " send"}
          onClick={handleClick}
        >
          {props.buttonText}
          <SendIcon className={classes.rightIcon} />
        </Button>
      ) : (
        <div className={"dFlex preloaderContainer"}>
          {isNaN(props.responseStatus) ? (
            <>
              <CircularIndeterminate />
              Ձեր հարցումը մշակվում է խնդրում ենք սպասել
            </>
          ) : props.responseStatus == 1 ? (
            "Ձեր հայտն ուղղարկված է , շնորհակալություն "
          ) : (
            "Համակարգում կան ղնդիրներ "
          )}
        </div>
      )}
      <Snackbar
        anchorOrigin={{
          vertical: "top",
          horizontal: "center"
        }}
        open={open || props.responseStatus == 1}
        autoHideDuration={6000}
        onClose={handleClose}
      >
        <MySnackbarContentWrapper
          onClose={handleClose}
          variant={type}
          message={
            type === "success"
              ? successMassage
              : type === "info"
              ? infoMassage
              : errorMassage
          }
        />
      </Snackbar>

      {/* <MySnackbarContentWrapper
        variant="error"
        className={classes.margin}
        message="This is an error message!"
      />
      <MySnackbarContentWrapper
        variant="warning"
        className={classes.margin}
        message="This is a warning message!"
      />
      <MySnackbarContentWrapper
        variant="info"
        className={classes.margin}
        message="This is an information message!"
      />
      <MySnackbarContentWrapper
        variant="success"
        className={classes.margin}
        message="This is a success message!"
      /> */}
    </React.Fragment>
  );
}
