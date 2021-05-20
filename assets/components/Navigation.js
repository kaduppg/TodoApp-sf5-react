import { AppBar, Box, Button, Drawer, IconButton, List, ListItem, ListItemIcon, ListItemText, makeStyles, Toolbar, Typography } from '@material-ui/core';
import {Menu as MenuIcon, List as ListIcon, Label as LabelIcon} from '@material-ui/icons';
import React, { useState } from 'react';
import { Link, NavLink } from 'react-router-dom';
import Login from './Login';


const useStyles = makeStyles(theme =>({
    menuIcon: {
        marginRight: theme.spacing(2),
    },
    list: {
        width: '200px',
    },
    link: {
        textDecoration: 'none',
        color: theme.palette.text.primary
    }
}));

const Navigation = () => {

    const classes = useStyles();

    //const classes = useStyles();
    const[drawerOpen, setDrawerOpen] = useState(false); 
    
    const toggleDrawer = ()=>{
        setDrawerOpen(!drawerOpen);
    }

    const drawerItems = [
        {
            text:'TodoList', 
            icon:<ListIcon/> , 
            link: '/todo-list'
        },
        {
            text:'Tags', 
            icon: <LabelIcon/>,
            link: '/tag-list' 
        },
    ]

    return (
        <AppBar position="fixed">
            <Toolbar>
                <IconButton onClick={toggleDrawer} className={classes.menuIcon} edge="start"> 
                    <MenuIcon/>
                </IconButton>
                <Link className={classes.link} to="/todo-list">
                    <Typography color="textPrimary" variant="h6">TodoApp</Typography>
                </Link>
                <Box flexGrow={1}/>

                <NavLink style={{textDecoration: 'none'}} to="/login">
                    <Button color="primary"  variant="contained" size="large"> Login </Button>
                </NavLink>


            </Toolbar>
            <Drawer anchor="left" variant="temporary" onClose={toggleDrawer} open={drawerOpen}>
                {drawerItems.map(prop =>(
                    <Link className={ classes.link } to={prop.link} key={ prop.text } >
                        <ListItem onClick={ toggleDrawer} button key={ prop.text }>
                            <ListItemIcon>{ prop.icon}</ListItemIcon>
                            <ListItemText>{ prop.text}</ListItemText>
                        </ListItem>
                    </Link>
                ) )}
                
            </Drawer>
        </AppBar>
    );
};

export default Navigation;