import axios from 'axios';

const todoRequest = axios.create({
    baseURL:'/api/todos'
});

export const getTodo = () => todoRequest.get('/');
export const createTodo = (data) => todoRequest.post('/',data);
export const updateTodo = (id,data) => todoRequest.patch(`/${id}`,data);
export const deleteTodo = id => todoRequest.delete(`/${id}`);
export const changeTodoStatus = (id,status) => todoRequest.patch(`/${id}`,status);

