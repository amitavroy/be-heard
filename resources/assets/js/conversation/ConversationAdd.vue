<template>
  <div class="conversation__add_wrapper">
    <div class="creator-container" v-bind:class="containerClass">
        <div class="grip"></div>
        <div class="action">
            <span v-on:click="closeContainer">Close</span>
        </div>
        <div class="content-area">
            <div class="row">
                <div class="col-sm-6">
                    <textarea cols="40" rows="10" class="form-control" id="add-area"></textarea>
                </div>
                <div class="col-sm-6 preview"></div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
export default {
    created () {
        window.eventBus.$on('addNewConversationEvent', () => {
            this.containerClass = [];
            this.containerClass.push(['animated', 'bounceInUp']);
            CKEDITOR.replace('add-area', {
                customConfig: '/config/ckedit.js'
            });
        });
    },
    data () {
        return {
            containerClass: ['hide']
        }
    },
    methods: {
        closeContainer () {
            this.containerClass.push(['animated', 'bounceOutDown']);
        }
    }
}
</script>

<style lang="scss">

</style>
