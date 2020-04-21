<template>
  <button class="font-bold py-2 px-4 rounded text-white" :class="classes" @click="subscribe">Subscribe</button>
</template>
<script>
  export default {
    props: ['active'],
    computed: {
      classes() {
        return ['btn', this.active ? 'bg-blue-500 hover:bg-blue-700' : 'bg-gray-500 hover:bg-gray-700'];
      }
    },
    methods: {
      subscribe() {
        axios[
          (this.active ? 'delete' : 'post')
        ](location.pathname + '/subscriptions');

        this.active = !this.active;
      }
    }
  }
</script>
