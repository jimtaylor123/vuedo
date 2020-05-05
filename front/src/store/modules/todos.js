import Axios from "axios";

const state = {
    todos : []
};

const getters = {
    allTodos: (state) => state.todos
};

const actions = {
    async fetchTodos({commit}){
        const response = await Axios.get(process.env.VUE_APP_API_URL+'todos');
        commit('setTodos', response.data.data);
    },
    async createTodo({commit}, data){
        const response = await Axios.post(
            process.env.VUE_APP_API_URL+'todos/', data
        );
        commit('createTodo', response.data.data);
    },
    async updateTodo({commit}, [todo, data]){
        const response = await Axios.patch(process.env.VUE_APP_API_URL+'todos/'+todo.data.id, data);
        commit('updateTodo', response.data.data);
    },
    async deleteTodo({commit}, todo){
        const response = await Axios.delete(process.env.VUE_APP_API_URL+'todos/'+todo.data.id);
        commit('deleteTodo', response.data.data);
    }
};

const mutations = {
    setTodos: (state, todos) => (state.todos = todos),
    createTodo (state, data) {
        state.todos.push(data);
    },
    updateTodo (state, data) {
        const todo =  state.todos.find(item => item.data.id === data.id);
        Object.assign(todo.data, data);
    },
    deleteTodo (state, data) {
        const index =  state.todos.findIndex(item => item.id === data.id );
        state.todos.splice(index,1);
    }
};

export default {
    state, 
    getters,
    actions,
    mutations
};