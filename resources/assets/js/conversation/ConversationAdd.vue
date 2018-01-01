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
                <div class="col-sm-6 preview">
                    {{userText}}
                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import SimpleMDE from 'simplemde';
export default {
    created () {
        window.eventBus.$on('addNewConversationEvent', () => {
            this.containerClass = [];
            this.containerClass.push(['animated', 'bounceInUp']);
            this.simplemde = new SimpleMDE({
                element: document.getElementById("add-area"),
                autofocus: true,
                forceSync: true
            });

            this.simplemde.codemirror.on("change", () => {
                this.userText = this.simplemde.value();
            });
        });
    },
    data () {
        return {
            simplemde: null,
            userText: '',
            containerClass: ['hide']
        }
    },
    methods: {
        closeContainer () {
            this.containerClass.push(['animated', 'bounceOutDown']);
            this.simplemde.toTextArea();
            this.simplemde = null;
            this.userText = '';
        }
    }
}
</script>

<style lang="scss">

</style>
