import React, { Component } from 'react'
import ReactDOM from 'react-dom';
import Router from './components/Router';
import DefaultThemeProvider from './components/themes/DefaultThemeProvider';

class App extends Component {
    render() {
        return (
            <Router/>
        )
    }
}
 
ReactDOM.render(
        <DefaultThemeProvider>
            <App/>
        </DefaultThemeProvider>

        , document.getElementById('root'));
