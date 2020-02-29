import React, { useState, useEffect } from 'react';

function Words(props) {

  const [words, setWords] = useState('');
  const [sourceUrl, setSourceUrl] = useState('');
  const [message, setMessage] = useState(props.message);
  const [enableButton, setEnableButton] = useState(true);

  useEffect(() => {
    setEnableButton(false);
    axios.get('/api/v1/words', {})
    .then((response) => {
      if (response.data.words) {
        setWords(response.data.words);
        setSourceUrl(response.data.sourceUrl);
        setEnableButton(true);

        if (response.data.words.length > 0) {
          setMessage('');
        } else {
          setMessage(props.message);
        }
      }
    })
    .catch((error) => {
      console.log(error);
      setMessage(props.message);
      setEnableButton(true);
    });
  }, []);

  function extractWords() {
    axios.get('/api/v1/word/extract', {})
      .then((response) => {
        if (response.data.success && response.data.words) {
          setWords(response.data.words);
          setSourceUrl(response.data.sourceUrl);
          setEnableButton(true);
        }
      })
      .catch((error) => {
        console.log(error);
        setMessage(props.message);
        setEnableButton(true);
      });
  }

  return (
    <div className="col-md-12">
      <div className="card mb-3">
        <div className="card-header">Words 
          <span className="float-right">
            {sourceUrl && <div><strong>Source: </strong><a href={sourceUrl} target="_blank">{sourceUrl}</a></div>}
          </span>
        </div>
        <div className="card-body">
          <div className="row mb-0">
            <div className="col-2">
              <div className="form-group">
                <button 
                  onClick={extractWords}
                  className={"btn btn-primary " + (!enableButton ? 'disabled' : '')}
                >Extract words</button>
              </div>
            </div>
            <div className="col-10">
              <div className="row">
              {words.length > 0 ? (words.map((word, index) => {
                return <div className="col" key={index}>{word.word}</div>
              })) : (
                <div>{message}</div>
              )}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

Words.defaultProps = {
  message: 'No words found. Please run the extract button.',
};

export default Words;
