<template>
    <li :class="dropDownClasses">
        <a @click="isDropDownOpen = !isDropDownOpen" 
            :href="linkToNotifications" 
            class="dropdown-toggle">
            <span class="glyphicon glyphicon-bell"></span>
            <span class="badge" v-text="notifications.length" v-if="notifications.length"></span>
        </a>
        <ul class="dropdown-menu" v-if="notifications.length">
            <li v-for="notification in notifications">
                <a @click="markAsRead(notification)" :href="notification.data.link" v-text="notification.data.text">Notificación 1</a>
            </li>
            <li class="divider"></li>
            <li><a @click="markAllAsRead()" href="#">Marcar todo como leído</a></li>
        </ul>
    </li>
</template>

<script>
    export default {
        data() {
            return {
                notifications: [],
                isDropDownOpen: false
            }
        },
        
        mounted() {
            axios.get('/notifications').then( res => {
                this.notifications = res.data;
            });
        },

        methods: {
            markAsRead(notification){
                axios.patch('/notifications/' + notification.id).then(res => {
                    this.notifications = res.data;
                });
            },
            markAllAsRead(){
                this.notifications.forEach(notification => {
                    this.markAsRead(notification);
                });
                
            }
        },

        computed: {
            dropDownClasses: function() {
                return [
                    'dropdown', 
                    this.isDropDownOpen ? 'open' : ''
                    ];
            },

            linkToNotifications: function() {
                return this.notifications.length ? '#' : '/notifications';
            }
        }
    }
</script>
