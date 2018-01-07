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
              <input type="text" name="title" class="form-control" v-validate="'required'" v-model="title">
              <span v-show="errors.has('title')" class="bh error">{{ errors.first('title') }}</span>
              <textarea cols="40" name="body" rows="10" class="form-control" id="add-area"
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
</template>

<script>
  import _ from 'lodash';
  import EditorMixin from './EditorMixin';
  import {
    saveConversationUrl, saveConversationReplyUrl
  } from '../config'

  export default {
    mixins: [EditorMixin],
    created() {

    },
    data() {
      return {
        userText: '',
        title: ''
      }
    },
    methods: {
      handleSave() {
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

<style lang="scss">

</style>
