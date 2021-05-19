import { Box, Button, Typography } from '@material-ui/core';
import React from 'react';
import { NavLink } from 'react-router-dom';

const NotFound = () => {
    return (
        <Box textAlign="center">
            <Typography variant="h1"> Page not found 404 </Typography>
            <NavLink style={{textDecoration: 'none'}} to="/">
                <Button color="primary"  variant="contained" size="large"> Go back to the home page.</Button>
            </NavLink>
        </Box>
    );
};

export default NotFound;