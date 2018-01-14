<template>
  <div class="conversation__add_wrapper">

    <div class="creator-container" v-bind:class="containerClass">
      <div class="grip"></div>
      <div class="action">
        <span v-on:click="closeContainer" class="pull-right">Close</span>
      </div>

      <form @submit.prevent="handleSaveButton">
        <div class="content-area">
          <div class="row">
            <div class="col-sm-6">
              <div class="extra-fields" v-if="showExtra">
                <div class="form-group">
                  <input type="text" name="title" id="title" class="form-control" v-model="title" v-validate="'required'">
                  <span v-show="errors.has('title')" class="bh error">{{ errors.first('title') }}</span>
                </div>

                <div class="form-group">
                  <select name="category" class="form-control" v-model="category" v-validate="'required'">
                    <option value="1">Restricted</option>
                    <option value="3">Feedback</option>
                    <option value="2">Common</option>
                  </select>
                  <span v-show="errors.has('category')" class="bh error">{{ errors.first('category') }}</span>
                </div>
              </div>
              <textarea cols="40" name="body" rows="10" class="form-control" id="add-conversation"
                        v-validate="'required'"></textarea>
              <span v-show="errors.has('body')" class="bh error">{{ errors.first('body') }}</span>
              <p v-show="errors.has('conversationId')" class="bh error">{{ errors.first('conversationId') }}</p>
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
  import EditorMixin from './EditorMixin';

  export default {
    mixins: [EditorMixin],

    created() {
      window.eventBus.$on('addNewConversationEvent', () => {
        console.log('addNewConversationEvent');
        this.boxMode = 'addNewConversationEvent';
        this.initEditor();
        this.showExtra = true;
      });

      window.eventBus.$on('addNewReplyEvent', (conversationId) => {
        console.log('addNewReplyEvent', conversationId);
        this.boxMode = 'addNewReplyEvent';
        this.initEditor();
        this.conversationId = conversationId;
      });

      window.eventBus.$on('editReplyEvent', (commentId) => {
        console.log('editReplyEvent', commentId);
        this.boxMode = 'editReplyEvent';
        this.initEditor();
        this.loadCommentById(commentId);
      });
    },

    methods: {
      handleSaveButton() {
        switch (this.boxMode) {
          case 'addNewConversationEvent':
            this.handleSaveConversation();
            break;

          case 'addNewReplyEvent':
            this.handleSaveReply();
            break;

          case 'editReplyEvent':
            this.handleEditReply();
            break;

          default:
            return false;
        }
      }
    }
  }
</script>

<style>
  .CodeMirror-scroll {
    max-height: 200px;
  }
</style>