import Axios from "axios";

const state = {
  todos: [],
  errors: {}
};

const getters = {
  allTodos: (state) => state.todos,
};

const actions = {
  async fetchTodos({ commit }) {
    const response = await Axios.get(process.env.VUE_APP_API_URL + "todos");
    commit("setTodos", response.data.data);
  },
  async createTodo({ commit }, data) {
    Axios.post(process.env.VUE_APP_API_URL + "todos", data)
      .then((response) => {
        commit("createTodo", response.data.data);
      })
      .catch((errors) => {
        commit("setErrors", errors?.response?.data?.errors);
      });
  },
  async updateTodo({ commit }, [todo, data]) {
    await Axios.patch(
      process.env.VUE_APP_API_URL + "todos/" + todo.id,
      data
    ).then((response) => {commit("updateTodo", response.data.data)}).catch((errors) => { console.log(errors?.response?.data?.errors)});
  },
  async deleteTodo({ commit }, todo) {
    await Axios.delete(
      process.env.VUE_APP_API_URL + "todos/" + todo.id
    );
    commit("deleteTodo", todo);
  },
  async deleteError({commit}, error){
    commit("deleteError", error);
  }
};

const mutations = {
  setTodos: (state, todos) => (state.todos = todos),
  createTodo(state, data) {
    state.todos.push(data);
  },
  updateTodo(state, data) {
    const todo = state.todos.find((item) => item.id === data.id);
    Object.assign(todo, data);
  },
  deleteTodo(state, todo) {
    const index = state.todos.findIndex((item) => item.id === todo.id);
    state.todos.splice(index, 1);
  },
  setErrors(state, data){
    Object.assign(state.errors, data);
  },
  deleteError(state, error){
    delete state.errors[error]
  }
};

export default {
  state,
  getters,
  actions,
  mutations,
};
