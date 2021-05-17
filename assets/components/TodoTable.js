import { IconButton, makeStyles, Table, TableBody, TableCell, TableHead, TableRow, TextField, Typography } from '@material-ui/core';
import EditIcon from '@material-ui/icons/Edit';
import DeleteIcon from '@material-ui/icons/Delete';
import AddIcon from '@material-ui/icons/Add';
import DoneIcon from '@material-ui/icons/Done';
import CloseIcon from '@material-ui/icons/Close';
import React, { Fragment, useContext, useState } from 'react';
import { TodoContext } from '../contexts/TodoContext';
import DeleteDialog from './DeleteDialog';


const useStyles = makeStyles(theme => ({
    thead: {
        backgroundColor: theme.palette.primary.main,
    }
}))

function TodoTable() {
    const context = useContext(TodoContext);

    const [addTodoTask, setAddTodoTask] = useState('');
    const [addTodoDescription, setAddTodoDescription] = useState('');
    const [editIsShown, setEditIsShown] = useState(false);
    const [editTodoTask, setEditTodoTask] = useState('');
    const [editTodoDescription, setEditTodoDescription] = useState('');
    const [deleteConfirmationIsShown, setDeleteConfirmationIsShown] = useState(false);
    const [todoTobeDeleted, setTodoToBeDeleted] = useState(null);
    
    const classes = useStyles();

    const onCreateSubmit = (event) => {
        event.preventDefault();
        context.createTodo(event, { task: addTodoTask, description: addTodoDescription });
        setAddTodoTask('');
        setAddTodoDescription('');
    };

    const onEditSubmit = (todoId, event) => {
        event.preventDefault();
        context.updateTodo({ id: todoId, task: editTodoTask, description: editTodoDescription });
        setEditIsShown(false);
    }


    return (
        <Fragment>

            <Table>
                <TableHead> 
                    <TableRow>

                        <TableCell> Taks </TableCell>

                        <TableCell align="right"> Actions </TableCell>

                    </TableRow>
                </TableHead>

                <TableBody>

                    <TableRow>
                        <TableCell>
                            <form onSubmit={onCreateSubmit}>
                                <TextField
                                    type="text"
                                    value={addTodoTask}
                                    onChange={(event) => {
                                        setAddTodoTask(event.target.value)
                                    }}
                                    label="New Task"
                                    fullWidth="true"
                                />
                            </form>
                        </TableCell>

                        <TableCell>
                            <form>
                                <TextField
                                    type="text"
                                    value={addTodoDescription}
                                    onChange={(event) => {
                                        setAddTodoDescription(event.target.value)
                                    }}
                                    label="Description"
                                    fullWidth="true"
                                    multiline={true}
                                />
                            </form>
                        </TableCell>


                        <TableCell align="right">
                            <IconButton onClick={onCreateSubmit} >
                                <AddIcon />
                            </IconButton>
                        </TableCell>

                    </TableRow>
                    {context.todos.slice().reverse().map((todo, index) => (

                        <TableRow key={'todo ' + index}>

                            <TableCell>
                                {editIsShown === todo.id ?

                                    <form onSubmit={onEditSubmit.bind(this, todo.id)}>
                                        <TextField
                                            type="text"
                                            fullWidth="true"
                                            autoFocus={true}
                                            value={editTodoTask}
                                            onChange={(event) => {
                                                setEditTodoTask(event.target.value)
                                            }}
                                        />
                                    </form>

                                    :
                                    <Typography> {todo.task} </Typography>
                                }

                            </TableCell>

                            <TableCell>
                                {editIsShown === todo.id ?

                                    <TextField
                                        type="text"
                                        fullWidth="true"
                                        value={editTodoDescription}
                                        multiline={true}
                                        onChange={(event) => {
                                            setEditTodoDescription(event.target.value)
                                        }}
                                    />
                                    :
                                    <Typography style={{ whiteSpace: 'pre-wrap' }}> {todo.description} </Typography>
                                }

                            </TableCell>

                            <TableCell align="right">

                                {editIsShown === todo.id ?
                                    <Fragment>
                                        <IconButton onClick={onEditSubmit.bind(this, todo.id)}>
                                            <DoneIcon />
                                        </IconButton>

                                        <IconButton onClick={() => { setEditIsShown(false) }}>
                                            <CloseIcon />
                                        </IconButton>
                                    </Fragment>
                                :
                                    <Fragment> 
                                        <IconButton 
                                            onClick={() => { 
                                                setEditIsShown(todo.id); 
                                                setEditTodoTask(todo.task);
                                                setEditTodoDescription(todo.description); 
                                            }}>
                                            <EditIcon />
                                        </IconButton>

                                        <IconButton
                                            onClick={() => { 
                                                setDeleteConfirmationIsShown(true); 
                                                setTodoToBeDeleted(todo) 
                                            }}>
                                            <DeleteIcon />
                                        </IconButton>
                                    </Fragment>
                                }  

                            </TableCell>

                        </TableRow>
                    ))}
                </TableBody>

            </Table>

            {deleteConfirmationIsShown && (
                <DeleteDialog
                    todo={todoTobeDeleted}
                    open={deleteConfirmationIsShown}
                    setDeleteConfirmationIsShown={setDeleteConfirmationIsShown}
                />
            )}


        </Fragment>
    );
}

export default TodoTable;