<template>
    <div class="container">
        <div class="card text-center">
            <h5 class="card-header">
                Status
            </h5>

            <div class="card-body">
                <p class="card-text">正在進行 Color = Primary</p>
                <p class="card-text">遇到困難 Color = Danger</p>
                <p class="card-text">已經完成 Color = Success</p>
            </div>
        </div>

        <div class="card">
            <h5 class="card-header">
                Add Item
            </h5>

            <div class="card-body">
                <div class="form-group">
                    <label for="title">Input Title：</label>
                    <input type="text" v-model="title" class="form-control" id="title">
                </div>

                <div class="form-group">
                    <label for="content">Input Content：</label>
                    <input type="text" v-model="content" class="form-control" id="content">
                </div>

                <div class="form-group">
                    <button @click="addTodo" class="btn btn-success btn-block">
                        Add Item
                    </button>
                </div>
            </div>
        </div>

        <div class="card">
            <h5 class="card-header">
                Search Item
            </h5>

            <div class="card-body">
                <div class="form-group">
                    <label for="searchTitle">Input Title：</label>
                    <input type="text" v-model="searchInput" class="form-control" id="searchTitle">
                </div>
            </div>
        </div>

        <div class="card text-center" v-for="todo in todos">
            <h5 class="card-header" :style="{backgroundColor:statusColor(todo.status),color:'white'}">
                No.{{ todo.id }}
            </h5>

            <div class="card-body">
                <h5 class="card-title">標題：{{ todo.title }}</h5>
                <p class="card-text">內容：{{ todo.content }}</p>

                <div class="buttons" v-if="todo.status !== 2">
                    <p v-for="(status,index) in ['primary','danger','success']">
                        <button @click="todoStatus(todo.id,index)" v-if="index !== todo.status" class="btn btn-block" :class=" 'btn-' + status">
                            Change Status {{ status }}
                        </button>
                    </p>
                </div>

                <button @click="updateTodo(todo.id)" class="btn btn-warning btn-block">
                    Update Item
                </button>

                <button @click="deleteTodo(todo.id)" class="btn btn-danger btn-block">
                    Delete Item
                </button>
            </div>

            <div class="card-footer">
                {{ formatDate(todo.created_at) }}
            </div>
        </div>
    </div>
</template>

<script>
    import { createTodo, updateTodo, deleteTodo, changeTodoStatus } from '../api';

    export default {
        data(){
            return {
                title:'',
                content:'',
                searchInput:''
            }
        },
        mounted() {
            this.$store.dispatch('getTodos');
        },
        computed:{
            todos(){
                if(this.searchInput.length > 0){
                    return this.$store.getters.getTodos.filter(d => d.title.includes(this.searchInput));
                }

                return this.$store.getters.getTodos;
            }
        },
        methods:{
            formatDate(date){
                return `${new Date(date).toLocaleDateString()} ${new Date(date).toLocaleTimeString()}`
            },
            statusColor(status){
                let color = ['primary','danger','success'];

                return `var(--${color[status]})`;
            },
            addTodo(){
                if(this.title.length === 0 || this.content === 0){
                    Swal.fire('String Length is Empty');
                }else{
                    createTodo({
                        title:this.title,
                        content:this.content
                    }).then(() => {
                        this.$store.dispatch('getTodos');
                    });
                }
            },
            updateTodo(id){
                Swal.fire({
                    title: 'Input Content',
                    input: 'text',
                    showCancelButton:true,
                    confirmButtonText: 'Update',
                }).then((result) => {
                    if(!result.isDismissed && !result.value){
                        Swal.fire('Content Length is Empty');
                    }else if(result.value){
                        updateTodo(id,{
                            content:result.value
                        }).then(() => {
                            this.$store.dispatch('getTodos');
                        });
                    }
                })
            },
            deleteTodo(id){
                deleteTodo(id).then(() => {
                    this.$store.dispatch('getTodos');
                });
            },
            todoStatus(id,status){
                changeTodoStatus(id,{
                    status:status
                }).then(() => {
                    this.$store.dispatch('getTodos');
                });
            }
        }
    }
</script>
