import React, { useState } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

function Register() {

  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [emailError, setEmailError] = useState('');
  const [passwordError, setPasswordError] = useState('');

  function isEmailValid(email) {
      return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email);
  }

  function checkEmail(email) {
    setEmail(email);

    if (email == '') {
      setEmailError('');
    }

    if (isEmailValid(email)) {
      axios.get('/api/v1/user/email', {
          params: {
            email: email
          }
        })
        .then((response) => {
          if (response.data.isSuccess
            && response.data.isSuccess == true
          ) {
            setEmailError('');
          }
        })
        .catch((error) => {
          setEmailError(error.response.data.errors.email[0]);
        });
    }
  }

  function submitRegister(e) {
    e.preventDefault();
    axios.post('/register', {
      email: email,
      password: password
    })
    .then((response) => {
      if (response.status == 200
        && response.statusText == 'OK'
      ) {
        setEmailError('');
        setPasswordError('');
        location.href = response.request.responseURL;
      }
    })
    .catch((error) => {
      if (error.response.data.errors.email
        && error.response.data.errors.email[0]
      ) {
        setEmailError(error.response.data.errors.email[0]);
      }
      
      if (error.response.data.errors.password
        && error.response.data.errors.password[0]
      ) {
        setPasswordError(error.response.data.errors.password[0]);
      }
    });
  }

  return (
    <div className="container">
      <div className="row justify-content-center">
        <div className="col-md-8">
          <div className="card">
            <div className="card-header">Register</div>
            <div className="card-body">
              <form onSubmit={submitRegister}>
                <div className="form-group row">
                  <label htmlFor="email" className="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                  <div className="col-md-6">
                      <input 
                        type="email"
                        className={"form-control" + (emailError ? ' is-invalid' : '')} 
                        value={email} 
                        required 
                        onChange={e => checkEmail(e.target.value)} 
                      />

                      <span className="invalid-feedback" role="alert">
                        <strong>{emailError}</strong>
                      </span>
                  </div>
                </div>

                <div className="form-group row">
                  <label htmlFor="password" className="col-md-4 col-form-label text-md-right">Password</label>
                  <div className="col-md-6">
                    <input 
                      type="password"
                      className={"form-control" + (passwordError ? ' is-invalid' : '')} 
                      value={password} 
                      required 
                      onChange={e => setPassword(e.target.value)} 
                    />
                    <span className="invalid-feedback" role="alert">
                      <strong>{passwordError}</strong>
                    </span>
                  </div>
                </div>

                <div className="form-group row mb-0">
                  <div className="col-md-6 offset-md-4">
                    <button 
                        onClick={submitRegister}
                        className="btn btn-primary"
                    >Register</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

export default Register;

if (document.getElementById('register')) {
    ReactDOM.render(<Register />, document.getElementById('register'));
}