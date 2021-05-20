import { createMuiTheme, CssBaseline, MuiThemeProvider } from '@material-ui/core';
import React from 'react';


const theme = createMuiTheme({
    palette: {
        type: 'light'
    }
});

const DefaultThemeProvider = (props) => {
    return (
        <MuiThemeProvider theme={theme}>
             <CssBaseline/>

             { props.children }
        </MuiThemeProvider>
       
    );
};

export default DefaultThemeProvider;