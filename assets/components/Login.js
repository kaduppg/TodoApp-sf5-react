import React from 'react';
import Avatar from '@material-ui/core/Avatar';
import Button from '@material-ui/core/Button';
import CssBaseline from '@material-ui/core/CssBaseline';
import TextField from '@material-ui/core/TextField';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import Checkbox from '@material-ui/core/Checkbox';
import Link from '@material-ui/core/Link';
import Grid from '@material-ui/core/Grid';
import LockOutlinedIcon from '@material-ui/icons/LockOutlined';
import Typography from '@material-ui/core/Typography';
import { makeStyles } from '@material-ui/core/styles';
import Container from '@material-ui/core/Container';

import { useForm , Controller} from 'react-hook-form';
import { yupResolver } from '@hookform/resolvers/yup';
import * as Yup from 'yup';


const useStyles = makeStyles((theme) => ({
  paper: {
    marginTop: theme.spacing(8),
    display: 'flex',
    flexDirection: 'column',
    alignItems: 'center',
  },
  avatar: {
    margin: theme.spacing(1),
    backgroundColor: theme.palette.secondary.main,
  },
  form: {
    width: '100%', // Fix IE 11 issue.
    marginTop: theme.spacing(1),
  },
  submit: {
    margin: theme.spacing(3, 0, 2),
  },
}));

const schema = Yup.object().shape({
    email: Yup.string().max(30,'Email must be no more than 30 characters').required().email(),
    password: Yup.string().min(6,'Password must be more than 6 characters').required(),
});



export default function SignIn() {

  const classes = useStyles();
  const { handleSubmit, control ,  formState:{ errors } } = useForm({
    mode: 'onBlur',
    resolver: yupResolver(schema)
  });

  const onSubmit = ( data )=> {
     alert(JSON.stringify(data));
  };

  return (
    <Container component="main" maxWidth="xs">
      <CssBaseline />
      <div className={classes.paper}>
        <Avatar className={classes.avatar}>
        <LockOutlinedIcon />
        </Avatar>
        <Typography component="h1" variant="h5">
          Sign in
        </Typography>

        <form className={classes.form} noValidate onSubmit={ handleSubmit(onSubmit) }>
         

         <Controller
            name="email"
            control={control}
            defaultValue=""
            render={({ field: { onChange, value },fieldState: { error } }) => (
                <TextField
                    id="email"
                    label="Email"
                    variant="outlined"
                    value={value}
                    onChange={onChange}
                    fullWidth
                    label="Email Address"
                    autoFocus
                    margin="normal"
                    error={!!error} 
                    helperText={error ? error.message : null}
                />
            )}
        />
       

        <Controller  
            name="password"
            control={control}
            defaultValue=""
            render={({field: {onChange, value},  fieldState: { error } })=> (
                <TextField
                    variant="outlined"
                    margin="normal"
                    fullWidth
                    value={value}
                    onChange={ onChange }
                    name="password"
                    label="Password"
                    type="password"
                    id="password"
                    error={!!error} 
                    helperText={error ? error.message : null}
                />
            )}
        />   
       

        <Controller
            name="remember"
            control={control}
            defaultValue={false}
            render={({field: {onChange , value}})=>(
                <FormControlLabel 
                    control={
                        <Checkbox  
                            name="remember"  
                            onChange={onChange}
                            value={value}
                            color="primary" 
                            id="remember"
                        />
                    }
                    label="Remember me"
                />
                
            )}
        />

          <Button type="submit" fullWidth variant="contained" color="primary" className={classes.submit}>
            Sign In
          </Button>

          <Grid container>
            <Grid item xs>
              <Link href="#" variant="body2">
                Forgot password?
              </Link>
            </Grid>
            <Grid item>
              <Link href="#" variant="body2">
                {"Don't have an account? Sign Up"}
              </Link>
            </Grid>
          </Grid>
        </form>

      </div>
      
    </Container>
  );
}