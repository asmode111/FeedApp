import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import Words from './Words';
import Feed from './Feed';

function Dashboard() {

  const [wordsExist, setWordsExist] = useState(false);

  return (
    <div className="row justify-content-center">
      <Words setWordsExistFromChild={setWordsExist} />
      <Feed wordsExist={wordsExist} />
    </div>
  );
}

export default Dashboard;

if (document.getElementById('dashboard')) {
  ReactDOM.render(<Dashboard />, document.getElementById('dashboard'));
}
