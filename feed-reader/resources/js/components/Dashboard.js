import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';

function Dashboard() {

  const [words, setWords] = useState('');

  useEffect(() => {
    axios.get('/api/v1/words', {})
      .then((response) => {
        if (response.data.words) {
          setWords(response.data.words);
        }
      })
      .catch((error) => {
        console.log(error);
      });
  }, []);

  function extractWords() {
    axios.get('/api/v1/word/extract', {})
      .then((response) => {
        if (response.data.success && response.data.words) {
          setWords(response.data.words);
        }
      })
      .catch((error) => {
        console.log(error);
      });
  }

  return (
    <div className="row justify-content-center">
      <div className="col-md-12">
        <div className="card">
          <div className="card-header">Words</div>
          <div className="card-body">
            <div className="row mb-0">
              <div className="col-2">
                <div className="form-group">
                  <button 
                    onClick={extractWords}
                    className="btn btn-primary"
                  >Extract words</button>
                </div>
              </div>
              <div className="col-10">
                <div className="row">
                {words && words.map((word, index) => {
                  return <div className="col" key={index}>{word.word}</div>
                })}
                </div>
              </div>
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
