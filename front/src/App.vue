<template>
  <div id="app" class="container mx-auto max-w-5xl flex flex-col bg-gray-100">
    <!-- Header -->
    <div
      class="bg-indigo-800 text-white text-2xl antialized py-5 text-center font-normal"
    >
      Todos
    </div>

    <TodoForm />

    <!-- Main -->
    <div class="flex-grow">
      <Todos />
    </div>

  </div>
</template>

<script>
import TodoForm from "./components/TodoForm.vue";
import Todos from "./components/Todos.vue";
import "./assets/css/app.css";

export default {
  name: "App",
  components: {
    TodoForm,
    Todos,
  },
};
</script>
