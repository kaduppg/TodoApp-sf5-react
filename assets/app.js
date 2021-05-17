import { CssBaseline } from '@material-ui/core';
import React, { Component } from 'react'
import ReactDOM from 'react-dom';
import AppSnackbar from './components/AppSnackbar';
import DefaultThemeProvider from './components/themes/DefaultThemeProvider';
import TodoTable from './components/TodoTable';
import TodoContextProvider from './contexts/TodoContext';

class App extends Component {
    render() {
        return (
            <TodoContextProvider>
                <TodoTable/>
                <AppSnackbar/>
            </TodoContextProvider>
        )
    }
}
 
ReactDOM.render(
        <DefaultThemeProvider>
            <App/>
        </DefaultThemeProvider>

        , document.getElementById('root'));
