<template>
    <li class="nav-item dropdown" v-if="notifications.length">
        <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown">
            <i class="fa fa-bell"></i>
        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" v-for="notification in notifications"
                :href="notification.data.link"
                v-text="notification.data.message"
                @click="markAsRead(notification)"/>
        </div>
    </li>
</template>

<script>
    export default {
        data() {
            return {notifications: false }
        },

        created() {
            axios.get('/profiles/' + window.App.user.name + "/notifications")
                .then(response => this.notifications = response.data);
        },

        methods: {
            markAsRead(notification) {
                axios.delete('/profiles/' + window.App.user.name + '/notifications/' + notification.id)
            }
        }
    }
</script>
