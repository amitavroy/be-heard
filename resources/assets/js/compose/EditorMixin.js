import SimpleMDE from 'simplemde';
import markdown from 'markdown';
import {
  saveConversationUrl, saveConversationReplyUrl
} from '../config'

export default {
  data() {
    return {
      containerClass: ['hide'],
      simplemde: null,
      element: null,
      userText: '',
      title: '',
      showExtra: false,
      conversationId: null
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
            body: this.userText
          };
          axios.post(saveConversationReplyUrl, postData).then(response => {
            // location.reload();
            console.log(response);
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
    }
  }
}