<template>
  <div class="conversation__add_wrapper">

    <div class="creator-container" v-bind:class="containerClass">
      <div class="grip"></div>
      <div class="action">
        <span v-on:click="closeContainer" class="pull-right">Close</span>
      </div>

      <div v-if="mode == 'conversation'">
        <form @submit.prevent="handleSaveConversation">
          <div class="content-area">
            <div class="row">
              <div class="col-sm-6">
                <input type="text" name="title" class="form-control" v-validate="'required'" v-model="title">
                <span v-show="errors.has('title')" class="bh error">{{ errors.first('title') }}</span>
                <textarea cols="40" name="body" rows="10" class="form-control" id="add-conversation"
                          v-validate="'required'"></textarea>
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
      <div v-if="mode == 'reply'">
        <form @submit.prevent="handleSaveConversation">
          <div class="content-area">
            <div class="row">
              <div class="col-sm-6">
                <textarea cols="40" name="body" rows="10" class="form-control" id="add-conversation"
                          v-validate="'required'"></textarea>
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

  </div>
</template>

<script>
  import EditorMixin from './EditorMixin';
  import ConversationEditor from './ConversationEditor.vue';
  import ReplyEditor from './ReplyEditor.vue';

  export default {
    mixins: [EditorMixin],

    components: {
      ConversationEditor, ReplyEditor
    },

    created() {
      window.eventBus.$on('addNewConversationEvent', () => {
        console.log('addNewConversationEvent');
        this.mode = 'conversation';
        this.initEditor();
      });

      window.eventBus.$on('addNewReplyEvent', () => {
        console.log('addNewReplyEvent');
        this.mode = 'reply';
        this.initEditor();
      });
    }
  }
</script>