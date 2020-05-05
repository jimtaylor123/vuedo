<template>
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
            id="description"
            type="text"
            placeholder="Walk the dogs"
          />
          <!-- <p class="text-red-500 text-xs italic">Please fill out this field.</p> -->
        </div>
        <div class="w-full md:w-1/2 px-3">
          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="grid-last-name"
          >
            Due by (optional)
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            id="grid-last-name"
            type="date"
          />
        </div>
      </div>

      <button
        class="flex-shrink-0 bg-indigo-800 hover:bg-indigo-700 border-indigo-800 hover:border-indigo-700 text-sm border-4 text-white py-1 px-2 rounded"
        type="button"
      >
        ADD
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "TodoForm",
};
</script>

<style></style>
