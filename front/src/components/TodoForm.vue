<template>
  <div class="max-w-md mx-auto">
    <div class="flex flex-col items-center py-2">
      <div class="flex flex-wrap mb-3 md:mt-4">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="description"
          >
            Description *
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
            id="description"
            type="text"
            placeholder="Type a task description..."
            v-model="newDescription"
            @input="clearError('description')"
          />
          <p v-if="errors.description" class="text-red-500 text-xs italic">
            {{ errors.description[0] }}
          </p>
        </div>
        <div class="w-full md:w-1/2 px-3 -mt-4 md:mt-0">
          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="due_by"
          >
            Due by (optional)
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            id="grid-last-name"
            type="date"
            v-model="newDueBy"
          />
        </div>
      </div>
    </div>
    <div class="flex flex-wrap mb-2 pl-3 p-2 items-center">
      <div>
      <button
        class="flex-shrink-0 bg-indigo-800 hover:bg-indigo-700 border-indigo-800 hover:border-indigo-700 text-sm border-4 text-white py-1 px-2 rounded md:w-24"
        type="button"
        @click="addNewTodo()"
      >
        ADD
      </button>
      </div>

      <transition name="fade">
        <div v-if="showSuccess" class="px-2 py-2 ml-2 md:m-2 bg-green-200 flex-wrap flex-1 text-center">
          {{ message }}
        </div>
      </transition>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
  name: "TodoForm",
  data() {
    return {
      newDescription: undefined,
      newDueBy: undefined,
      errors: {},
      showSuccess: false,
      message: ''
    };
  },
  methods: {
    ...mapActions(["createTodo", "deleteError"]),
    addNewTodo() {
      let todo = {
        description: this.newDescription,
        due_by: this.newDueBy,
        complete: false,
      };
      this.createTodo(todo);
    },

    clearError(value) {
      delete this.errors[value];
      this.deleteError(value);
    },
  },
  created() {
    this.unsubscribe = this.$store.subscribe((mutation, state) => {
      if (mutation.type === "setErrors") {
        this.errors = state.Todos.errors;
      }
      if (mutation.type === "createTodo") {
        this.message = 'Successfully added new task!';
        this.showSuccess = true;
        setTimeout(() => (this.showSuccess = false), 2000);
      }
      if (mutation.type === "updateTodo") {
        this.message = 'Successfully updated task!';
        this.showSuccess = true;
        setTimeout(() => (this.showSuccess = false), 2000);
      }
      if (mutation.type === "deleteTodo") {
        this.message = 'Successfully deleted task!';
        this.showSuccess = true;
        setTimeout(() => (this.showSuccess = false), 2000);
      }
    });
  },
  beforeDestroy() {
    this.unsubscribe();
  },
};
</script>

<style>
.fade-enter,
.fade-leave-to {
  opacity: 0;
}

.fade-leave,
.fade-enter-to {
  opacity: 1;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 1000ms;
}
</style>
