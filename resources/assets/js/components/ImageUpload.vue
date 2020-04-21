<template>
  <input class="bg-indigo-600 hover:bg-blue-800 text-white font-bold py-2 px-4 inline-flex items-center rounded" type="file" accept="image/*" @change="onChange">
</template>
<script>
  export default {
    methods: {
      onChange(e) {
        if(! e.target.files.length) return;

        let file = e.target.files[0];

        let reader = new FileReader();

        reader.readAsDataURL(file);

        reader.onload = e => {
          let src = e.target.result;

          this.$emit('loaded', { src, file });
        };
      }
    }
  }
</script>
