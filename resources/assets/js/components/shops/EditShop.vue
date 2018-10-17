<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-body">
                <edit-shop-form></edit-shop-form>
            </div>
        </div>
    </div>
</template>

<script>
    import EditShopForm from './EditShopForm.vue'
    export default {
        name: 'edit-shop',
        components: {
            EditShopForm
        }
    }
</script>
