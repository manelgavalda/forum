<template>
  <div>
    <div v-if="signedIn">
      <div class="pb-2">
        <wysiwyg name="body" v-model="body" placeholder="Have something to say?" :shouldClear="completed"></wysiwyg>
      </div>

      <button
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        @click="addReply"
      >
        Post
      </button>
    </div>

    <p class="text-center font-semibold" v-else>
      Please
      <a
        href="/login"
        class="hover:underline text-gray-600"
      >sign in</a>
      to participate in the discussion.
    </p>
  </div>
</template>
<script>
  import 'at.js';
  import 'jquery.caret';
  export default {
    data() {
      return {
        body: '',
        completed: false
      }
    },
    mounted() {
      $('#body').atwho({
        at: "@",
        delay: 750,
        callbacks: {
          remoteFilter: function(query, callback) {
            $.getJSON("/api/users", {q: query}, function(usernames) {
              callback(usernames)
            });
          }
        }
      });
    },
    methods: {
      addReply() {
        axios.post(location.pathname + '/replies', { body: this.body})
        .catch(({response}) => {
          flash(response.data, 'danger');
        })
        .then(({data}) => {
          this.body = '';
          this.completed = true;

          flash('Your reply has been posted');

          this.$emit('created', data);
        });
      }
    }
  }
</script>
