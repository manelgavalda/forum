<template>
  <div>
    <div class="level">
      <img :src="avatar" width="50" heigth="200" class="mr-1">
      <h1 v-text="user.name"/>
    </div>

      <form v-if="canUpdate" method="post" enctype="multipart/form-data">
        <image-upload @loaded="onLoad"></image-upload>
      </form>

  </div>
</template>
<script>
  import ImageUpload from './ImageUpload.vue';
  export default {
    props: ['user'],
    components: { ImageUpload },
    data() {
      return {
        avatar: this.user.avatar_path
      }
    },
    computed: {
      canUpdate() {
        return this.authorize(user => user.id === this.user.id)
      }
    },
    methods: {
      onLoad(avatar) {
        this.avatar = avatar.src;

        this.persist(avatar.file);
      },

      persist(avatar) {
        let data = new FormData();

        data.append('avatar', avatar);

        axios.post(`/api/users/${this.user.name}/avatar`, data)
          .then(() => flash('Avatar uploaded'));
      }
    }
   }
</script>
