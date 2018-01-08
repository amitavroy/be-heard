<template>
  <div>
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
</template>

<script>
  export default {
    methods: {
      handleSaveConversation() {

      }
    }
  }
</script>