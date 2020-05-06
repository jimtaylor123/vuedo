<template>
  <div>

    <div @click="overdueOnly = !overdueOnly">
      <div v-if="overdueOnly">
        <p class="text-xs mx-3 md:mx-24 italic font-hairline">show all</p>
      </div>
      <div v-else>
        <p class="text-xs mx-3 md:mx-24 italic font-hairline">show overdue</p>
      </div>
    </div>

    <div class="mx-3 md:mx-24 pt-3 border-b-2 border-indigo-800 opacity-25"></div>

    <div class="flex mx-6 md:mx-24">
      <div
        class="font-semibold p-2 w-3/5 md:w-7/12"
        @click="sort('description')"
      >
        Description
      </div>
      <div class="font-semibold p-2 w-1/5 md:w-3/12" @click="sort('due_by')">
        Due
      </div>
      <div class="font-semibold p-2 w-1/5 md:w-2/12" @click="sort('complete')">
        Done
      </div>
    </div>

    <div class="mx-3 md:mx-24 border-b-2 border-indigo-800 opacity-25"></div>

    <div :key="todo.id" v-for="todo in sortedTodos">
      <div
        class="flex mx-6 md:mx-24 border-b border-dashed"
        @click="edit(todo)"
        v-show="!overdueOnly || isOverdue(todo)"
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
      sortType: "due_by",
      ascending: true,
      sortedTodos: [],
      overdueOnly: false
    };
  },
  methods: {
    ...mapActions(["fetchTodos"]),
    isOverdue(todo) {
      return !todo.complete && moment().isAfter(moment(todo.due_by));
    },
    due(time) {
      if (time === null || time === undefined) {
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
      this.selectedTodo = {};
      body.classList.toggle("modal-active");
    },
    sort(type) {
      if(type === this.sortType){
        this.ascending = ! this.ascending;
      }
      this.sortType = type;

      const todos = this.allTodos;

      if (this.sortType !== "due_by") {
        if (this.ascending) {
          this.sortedTodos = todos.sort((a, b) =>
            a[this.sortType] > b[this.sortType] ? 1 : -1
          );
        } else {
           this.sortedTodos = todos.sort((a, b) =>
            a[this.sortType] > b[this.sortType] ? -1 : 1
          );
        }
      } else {
        this.sortedTodos = todos.sort((a,b) => {
          // equal items sort equally
          if (a.due_by === b.due_by) {
            return 0;
          }
          // nulls sort after anything else
          else if (a.due_by === null) {
            return 1;
          } else if (b.due_by === null) {
            return -1;
          }
          // otherwise, if we're ascending, lowest sorts first
          else if (this.ascending) {
            return a.due_by < b.due_by ? -1 : 1;
          }
          // if descending, highest sorts first
          else {
            return a.due_by < b.due_by ? 1 : -1;
          }
        });
      }
    },
  },
  computed: {
    ...mapGetters(["allTodos"])
  },
  created() {
    this.fetchTodos();
  },
  watch: {
    allTodos: function(){
      this.sortedTodos = this.allTodos;
    }
  }
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
