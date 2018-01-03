<template>
  <div class="conversation__add_wrapper">
    <div class="creator-container" v-bind:class="containerClass">
        <div class="grip"></div>
        <div class="action">
            <span v-on:click="closeContainer" class="pull-right">Close</span>
        </div>
        <form @submit.prevent="handleSave">
            <div class="content-area">
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" name="title" class="form-control" v-validate="'required'">
                        <span v-show="errors.has('title')" class="bh error">{{ errors.first('title') }}</span>
                        <textarea cols="40" name="body" rows="10" class="form-control" id="add-area" v-validate="'required'"></textarea>
                        <span v-show="errors.has('body')" class="bh error">{{ errors.first('body') }}</span>
                    </div>
                    <div class="col-sm-6 preview" v-html="userText"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <button class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
  </div>
</template>

<script>
import SimpleMDE from 'simplemde';
import markdown from 'markdown';

export default {
    created () {
        window.eventBus.$on('addNewConversationEvent', () => {
            this.containerClass = [];
            this.containerClass.push(['animated', 'bounceInUp']);
            this.simplemde = new SimpleMDE({
                element: document.getElementById("add-area"),
                hideIcons: ["guide", "code", "clean-block", "table", "preview", "fullscreen", "side-by-side"],
                autofocus: true,
                promptURLs: true,
                forceSync: true
            });
            this.userText = markdown.markdown.toHTML(this.simplemde.value());

            this.simplemde.codemirror.on("change", () => {
                this.userText = markdown.markdown.toHTML(this.simplemde.value());
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
        },
        handleSave () {
            this.$validator.validateAll().then(result => {
                console.log(result);
            })
        }
    }
}
</script>

<style lang="scss">

</style>
