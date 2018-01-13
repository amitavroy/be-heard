import SimpleMDE from 'simplemde';
import markdown from 'markdown';
import {
  saveConversationUrl, saveConversationReplyUrl,
  getCommentById, updateCommentById
} from '../config'

export default {
  data() {
    return {
      containerClass: ['hide'],
      simplemde: null,
      element: null,
      userText: '',
      userTextMarkdown: '',
      title: '',
      showExtra: false,
      conversationId: null,
      commentId: null,
      boxMode: null
    }
  },
  methods: {
    initEditor() {
      this.element = document.getElementById("add-conversation");
      this.containerClass = [];
      this.containerClass.push(['animated', 'bounceInUp']);

      this.simplemde = new SimpleMDE({
        element: this.element,
        hideIcons: ["guide", "code", "clean-block", "table", "preview", "fullscreen", "side-by-side"],
        autofocus: true,
        promptURLs: true,
        forceSync: true
      });

      this.userText = markdown.markdown.toHTML(this.simplemde.value());

      this.simplemde.codemirror.on("change", () => {
        this.userText = markdown.markdown.toHTML(this.simplemde.value());
        this.userTextMartkdown = this.simplemde.value();
      });
    },

    closeContainer() {
      this.containerClass.push(['animated', 'bounceOutDown']);
      this.simplemde.toTextArea();
      this.simplemde = null;
    },

    handleSaveConversation() {
      this.$validator.validateAll().then(result => {
        if (result) {
          let postData = {
            title: this.title,
            body: this.userText
          };
          axios.post(saveConversationUrl, postData).then(response => {
            location.reload();
          }).catch(error => {
            this.handleValidationError(error);
          });
        }
      })
    },

    handleSaveReply() {
      this.$validator.validateAll().then(result => {
        if (result) {
          let postData = {
            conversationId: this.conversationId,
            body: this.userTextMartkdown
          };
          axios.post(saveConversationReplyUrl, postData).then(response => {
            location.reload();
            // console.log(response);
          }).catch(error => {
            this.handleValidationError(error);
          })
        }
      })
    },

    handleEditReply() {
      this.$validator.validateAll().then(result => {
        if (result) {
          let postData = {
            commentId: this.commentId,
            body: this.userTextMartkdown
          };
          axios.post(updateCommentById, postData).then(response => {
            location.reload();
            // console.log(response);
          }).catch(error => {
            this.handleValidationError(error);
          })
        }
      })
    },

    handleValidationError(error) {
      if (error.response.status === 422) {
        var valErrors = error.response.data.errors;
        _.each(valErrors, (value, key) => {
          this.errors.add(key, value[0]);
        });
      }
    },

    loadCommentById(commentId) {
      let postData = {
        commentId: commentId
      };

      axios.post(getCommentById, postData).then(response => {
        console.log('response', response);
        if (response.status === 200) {
          // this.userText = response.data.body;
          this.simplemde.value(response.data.body);
          this.conversationId = response.data.commentable_id;
          this.commentId = response.data.id;
        }
      }).catch(error => {
        this.handleValidationError(error);
      })
    }
  }
}