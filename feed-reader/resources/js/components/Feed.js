import React, { useState } from 'react';

function Feed(props) {

  const [words, setWords] = useState('');
  const [sourceUrl, setSourceUrl] = useState('');
  const [message, setMessage] = useState(props.message);
  const [enableButton, setEnableButton] = useState(true);

  function findFrequency() {
    // if (!enableButton) {
    //   return;
    // }

    setMessage(props.loadingMessage);
    setEnableButton(false);
    axios.get('/api/v1/feed', {})
      .then((response) => {
        if (response.data.success && response.data.words) {
          setWords(response.data.words);
          setSourceUrl(response.data.sourceUrl);
          setEnableButton(true);
          setMessage('');
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
      <div className="card">
        <div className="card-header">
          Feed
          <span className="float-right">
            {sourceUrl && <div><strong>Source: </strong><a href={sourceUrl} target="_blank">{sourceUrl}</a></div>}
          </span>
        </div>
        <div className="card-body">
          <div className="row mb-0">
            <div className="col-2">
              <div className="form-group">
                <button 
                  onClick={findFrequency}
                  className={"btn btn-primary " + (!enableButton ? 'disabled' : '')}
                >Find frequency</button>
              </div>
            </div>
            <div className="col-10">
              <div className="row">
              {words.length > 0 ? (words.map((word, index) => {
                return <div className="col" key={index}><strong>{word.word}</strong>: {word.frequency}</div>
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

Feed.defaultProps = {
  loadingMessage: 'Words are loading...',
  message: 'Please run the find button.',
};

export default Feed;
