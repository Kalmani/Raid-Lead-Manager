'use strict';

const {useState}                 = React;
const {useSelector, useDispatch} = ReactRedux;
const {Button, TextField}        = MaterialUi;

const {get} = require('mout/object');

/*const {
  loginProcess,
  openModal
} = require('../../../store/actions');*/

const Login = () => {
  function useFormInput(initialValue) {
    let [value, setValue] = useState(initialValue);
    let onChange          = (e) => {
      setValue(e.target.value);
    };

    return {value, onChange};
  }/*

  let dispatch     = useDispatch();
  let t            = useSelector(({config}) => get(config, 'locales.translate'));*/
  let userLogin    = useFormInput('');
  let userPassword = useFormInput('');

  function handleLogin(e) {
    e.preventDefault();

    /*dispatch(loginProcess({
      user_login : userLogin.value,
      user_pswd  : userPassword.value
    }));*/
  }

  function handleMissingPassword(e) {
    e.preventDefault();

    /*dispatch(openModal({
      component_name : 'MissingPassword',
      data           : {
        title : '&v4.account.password_recovery;'
      }
    }));*/
  }

  return (
    <div class="row">
      <div class="col-md-3 col-centered" id="login_container">
        <div class="panel panel-default animated fadeInUp">
          <div class="panel-heading">
            &Home.Login.Title;
          </div>
          <div class="panel-body" id="login_panel">
            <div class="input-group">
              <span class="input-group-addon glyphicon glyphicon-user"> </span>
              <TextField id="outlined-basic" label="&Home.Login.Login_value;" variant="outlined" />
            </div>
            <br />
            <div class="input-group">
              <span class="input-group-addon glyphicon glyphicon-asterisk"> </span>
              <TextField id="outlined-basic" label="&Home.Login.Password_value;" variant="outlined" />
            </div>
            <br />
            <Button variant="contained">&Home.Login.Validate;</Button>
          </div>
        </div>
      </div>
    </div>
  );

  /*<div>
      <h1 className="h1 text--thin text--center text--white margin-tb--xl">&v4.encart;</h1>
      <p className="h2 text--thin text--center text--white">&v4.explaination;</p>
      <form className="form form--center margin-t--xl" onSubmit={handleLogin}>
        <div className="form-input">
          <label htmlFor="user_login" className="form-label text--white" style={{'fontSize' : '14px'}}>
            &v4.account.your_login;
          </label>
          <input type="text" name="user_login" className="bg--transparent text--white input--big" {...userLogin} />
        </div>
        <div className="form-input">
          <label htmlFor="user_pswd" className="form-label text--white" style={{'fontSize' : '14px'}}>
            &v4.account.your_password;
          </label>
          <input type="password" name="user_pswd" className="bg--transparent text--white input--big" {...userPassword} />
        </div>
        <a href="javascript:void(0);" onClick={handleMissingPassword} className="text--white height_18 missing_password">
          <span className="btn-addon btn-addon--info inline-block"></span> &v4.account.forgotten_password;
        </a>
        <div className="form-input">
          <button className="btn btn--rounded margin-t btn--orange text--up padding-lr--l input--big full-width submit">&v4.account.validate;</button>
        </div>
      </form>
    </div>*/
};

module.exports = Login;
