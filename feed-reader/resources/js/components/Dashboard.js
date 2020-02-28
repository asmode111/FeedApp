import React from 'react';
import ReactDOM from 'react-dom';

function Dashboard() {

  function extractWords() {
    axios.get('/api/v1/word/extract', {})
    .then((response) => {
      if (response.status == 200
        && response.statusText == 'OK'
      ) {

      }
    })
    .catch((error) => {
    });
  }

  return (
    <div className="row justify-content-center">
      <div className="col-md-12">
        <div className="card">
          <div className="card-header">Dashboard</div>
          <div className="card-body">
            <div className="form-group row mb-0">
              <button 
                  onClick={extractWords}
                  className="btn btn-primary"
              >Extract words</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

export default Dashboard;

if (document.getElementById('dashboard')) {
  ReactDOM.render(<Dashboard />, document.getElementById('dashboard'));
}
