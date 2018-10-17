<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-body">
                <edit-order-form></edit-order-form>
            </div>
        </div>
    </div>
</template>

<script>
    import EditOrderForm from './EditOrderForm.vue'
    export default {
        name: 'edit-order',
        components: {
            EditOrderForm
        }
    }
</script>
