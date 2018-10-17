<template>
    <div class="select-location">
        <div class="modal bd-example-modal-lg" id="EditLocationModalCenter" tabindex="-1" role="dialog"
             aria-hidden="true">
            <div style="margin:5px;float:left">
                <input style="width:200px;padding:3px 4px;" type="text" id="placeEdit" />
                <p class="mt-2" style="color: #fff">输入地址，敲回车键定位</p>
            </div>
            <div id="EditMapContainer"></div>
        </div>
    </div>
</template>
<script>
    import {TMap} from './../../locale/TMap'
    export default {

    }
</script>
<style>
    #EditMapContainer {
        min-width: 600px;
        min-height: 767px;
    }
</style>
