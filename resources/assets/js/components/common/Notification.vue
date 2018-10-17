<template>
    <div class="container-fluid">
        <div class="notification">
            <transition name="fade" mode="in-out">
                <div class="hidden"
                     :class="notificationLevel"
                     v-if="msg"
                     @click="hideNotification()">
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
    import {mapState, mapActions} from 'vuex';
    export default {
        name: 'notification',
        computed: {
            ...mapState({
                level: state => state.Notification.level,
                msg: state => state.Notification.msg,
            }),
            notificationLevel() {
                this.$notify({
                    message: this.msg,
                    type:this.level,
                    offset: 36
                });
            }
        },
        methods: {
            ...mapActions([
                'hideNotification'
            ])
        }
    }
</script>
