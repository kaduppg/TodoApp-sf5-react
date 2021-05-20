import React from 'react';

//router
import { BrowserRouter, Redirect, Route, Switch } from 'react-router-dom';

import { makeStyles } from '@material-ui/core';
import TodoContextProvider from '../contexts/TodoContext';
import AppSnackbar from './AppSnackbar';
import TodoTable from './TodoTable';
import Navigation from './Navigation';

import NotFound from './NotFound'
import Login from './Login';


const TodoList = () => (
    <TodoContextProvider>
        <TodoTable/>
        <AppSnackbar/>
    </TodoContextProvider>
);

const useStyles = makeStyles(theme => ({
    divider: theme.mixins.toolbar,
}));

const Router = () => {

    const classes = useStyles();

    return (
        <BrowserRouter>
            <Navigation/>
            <div className={classes.divider}/>
            <Switch>
                <Redirect exact from="/" to="/todo-list" />
                <Route exact path="/todo-list" component={TodoList}/>
                <Route exact path="/tag-list" component={null}/>
                <Route exact path="/login" component={Login}/>
                <Route component={NotFound} />
            </Switch>
        </BrowserRouter>
            
    );
};

export default Router;