<template>
  <!--Modal-->
  <div
    class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center"
  >
    <div
      class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"
    ></div>

    <div
      class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto"
    >
      <div
        class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50"
      >
        <svg
          class="fill-current text-white"
          xmlns="http://www.w3.org/2000/svg"
          width="18"
          height="18"
          viewBox="0 0 18 18"
        >
          <path
            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"
          ></path>
        </svg>
        <span class="text-sm" @click="close()">(Esc)</span>
      </div>

      <!-- Add margin if you want to see some of the overlay behind the modal-->
      <div class="modal-content py-4 text-left px-6">
        <!--Inputs-->
        <div class="max-w-md mx-auto flex">
          <div class="flex flex-col items-center py-2">
            <div class="flex flex-wrap mb-6">
              <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label
                  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                  for="description"
                >
                  Description *
                </label>
                <input
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                  id="modal-description"
                  type="text"
                  v-model="description"
                />
                <!-- <p class="text-red-500 text-xs italic">Please fill out this field.</p> -->
              </div>
              <div class="w-full md:w-1/2 px-3">
                <label
                  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                  for="due_by"
                >
                  Due by (optional)
                </label>
                <input
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="due_by"
                  type="date"
                  v-model="due_by"
                />
              </div>
                <div class="w-full md:w-1/2 px-3">
                <label
                  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 pt-8"
                  for="complete"
                >
                  Complete
                </label>
                <input
                  class="bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="complete"
                  type="checkbox"
                  v-model="checked"
                />
              </div>
            </div>
          </div>
        </div>

        <!--Footer-->
        <div class="flex justify-end pt-2">
          <button
            class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2"
          >
            Update
          </button>
          <button
            @click="close()"
            class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400"
          >
            Close
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from 'moment';
export default {
  name: "Modal",
  props: {
    show: {
        type: Boolean
    },
    todo: {
        type: Object
    }
  },
  data () {
      return {
          checked: this.todo.complete,
          description: this.todo.description,
          due_by: this.due()
      }
  },
  methods: {
    close() {
      this.$emit("closeModal", true);
    },
     due(){
        if( this.todo.due_by !== null){
            return moment(this.todo.due_by).format('YYYY-MM-DD');
        }
        return '';
    }
  },
  computed : {
   
  },
  watch: {
    show: function() {
      const modal = document.querySelector(".modal");
      modal.classList.toggle("opacity-0");
      modal.classList.toggle("pointer-events-none");
    },
    todo: function(){
        this.checked = this.todo.complete;
        this.description = this.todo.description;
    }
  },
  mounted() {    
    document.body.addEventListener('keyup', e => {
      if (e.keyCode === 27) {
        this.close();
      }
    })
  }
};
</script>

<style></style>
