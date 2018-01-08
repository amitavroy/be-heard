<template>
  <div class="conversation-add__wrapper">
    <pre>{{mode}}</pre>

  </div>
</template>

<script>
  import _ from 'lodash';
  import EditorMixin from './EditorMixin';
  import {saveConversationUrl} from '../config'

  export default {
    methods: {
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
</script>