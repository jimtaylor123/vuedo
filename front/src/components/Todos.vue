<template>
  <div>
    <div class="flex mx-6 md:mx-24">
      <div class="font-semibold p-2 w-3/5 md:w-7/12">
        Description
      </div>
      <div class="font-semibold p-2 w-1/5 md:w-3/12">
        Due
      </div>
      <div class="font-semibold p-2 w-1/5 md:w-2/12">
        Done
      </div>
    </div>

    <div
      class="mx-5 md:mx-24 pt-3 border-b-2 border-indigo-800 opacity-25"
    ></div>

    <div :key="todo.id" v-for="todo in allTodos">
      <div
        class="flex mx-6 md:mx-24 border-b border-dashed"
        @click="edit(todo)"
      >
        <div class="font-semibold p-2 w-7/12">
          {{ todo.description }}
          <sup v-show="isOverdue(todo)" class="text-red-800">late!</sup>
        </div>
        <div class="font-semibold p-2 w-3/12">
          {{ due(todo.due_by) }}
        </div>
        <div class="font-semibold p-2 w-2/12 text-center">
          <Zondicon
            v-if="!todo.complete"
            icon="close-solid"
            class="fill-current text-red-500 w-5 h-5"
          />
          <Zondicon
            v-else
            icon="checkmark-outline"
            class="fill-current text-green-500 w-5 h-5"
          />
        </div>
      </div>
    </div>

    <Modal
      v-bind:show="showModal"
      v-bind:todo="selectedTodo"
      @closeModal="closeModal"
    />
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import moment from "moment";
import Modal from "./Modal";

export default {
  name: "Todos",
  components: {
    Modal,
  },
  data: function() {
    return {
      showModal: false,
      selectedTodo: {},
    };
  },
  methods: {
    ...mapActions(["fetchTodos", "createTodo", "updateTodo", "deleteTodo"]),
    // createTodo(todo) {
    //   this.createTodo([unit, charge]);
    // },
    // updateTodo(todo) {
    //   this.stopCharging([unit, charge]);
    // },
    // deleteTodo(todo) {
    //   this.stopCharging([unit, charge]);
    // },
    isOverdue(todo) {
      return moment().isBefore(moment(todo.due_by));
    },
    due(time) {
      if (time === null || undefined) {
        return "";
      }
      return moment(time).format("DD/MM/YY");
    },
    edit(todo) {
      this.selectedTodo = todo;
      this.showModal = true;
      const body = document.querySelector("body");
      body.classList.toggle("modal-active");
    },
    closeModal() {
      this.showModal = false;
      const body = document.querySelector("body");
      body.classList.toggle("modal-active");
    },
  },
  computed: {
    ...mapGetters(["allTodos"]),
  },
  created() {
    this.fetchTodos();
  },
};
</script>

<style scoped>
.modal {
  transition: opacity 0.25s ease;
}
body.modal-active {
  overflow-x: hidden;
  overflow-y: visible !important;
}
</style>
