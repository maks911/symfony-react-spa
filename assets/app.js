import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router } from 'react-router-dom';
import './styles/app.scss';
import Home from './components/Home';

ReactDOM.render(<Router><Home /></Router>, document.getElementById('root'));

requireAll(require.context('./images/svg/', true, /\.svg$/));

function requireAll(r) {
    r.keys().forEach(r);
}

