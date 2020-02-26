import React, { useState } from 'react';
import ReactDOM from 'react-dom';

function Register() {

    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');

    function submitRegister() {
        console.log(email);
        console.log(password);
    }

    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Register</div>
                        <div className="card-body">
                            <form>
                                <div className="form-group row">
                                    <label htmlFor="email" className="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                    <div className="col-md-6">
                                        <input 
                                            type="email"
                                            className="form-control" 
                                            value={email} 
                                            required 
                                            onChange={e => setEmail(e.target.value)} />
                                    </div>
                                </div>

                                <div className="form-group row">
                                    <label htmlFor="password" className="col-md-4 col-form-label text-md-right">Password</label>
                                    <div className="col-md-6">
                                        <input 
                                            type="password"
                                            className="form-control" 
                                            value={password} 
                                            required 
                                            onChange={e => setPassword(e.target.value)} />
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