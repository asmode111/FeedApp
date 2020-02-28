import React, { useState } from 'react';

function Feed() {

  const [words, setWords] = useState('');

  function findFrequency() {
    axios.get('/api/v1/feed', {})
      .then((response) => {
        console.log(response.data.words);
        if (response.data.success && response.data.words) {
          setWords(response.data.words);
        }
      })
      .catch((error) => {
        console.log(error);
      });
  }

  return (
    <div className="col-md-12">
      <div className="card">
        <div className="card-header">Feed</div>
        <div className="card-body">
          <div className="row mb-0">
            <div className="col-2">
              <div className="form-group">
                <button 
                  onClick={findFrequency}
                  className="btn btn-primary"
                >Find frequency</button>
              </div>
            </div>
            <div className="col-10">
              <div className="row">
              {words && words.map((word, index) => {
                return <div className="col" key={index}><strong>{word.word}</strong>: {word.frequency}</div>
              })}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

export default Feed;
