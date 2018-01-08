<template>
  <div class="conversation__add_wrapper">

    <div class="creator-container" v-bind:class="containerClass">
      <div class="grip"></div>
      <div class="action">
        <span v-on:click="closeContainer" class="pull-right">Close</span>
      </div>
      <conversation-add></conversation-add>
    </div>


  </div>
</template>

<script>
  import _ from 'lodash';
  import ConversationAdd from './ConversationAdd.vue';
  import EditorMixin from './EditorMixin';
  import {
    saveConversationUrl,
    saveConversationReplyUrl
  } from '../config'

  export default {
    components: {
      ConversationAdd
    },
    mixins: [EditorMixin],
    created() {
      window.eventBus.$on('addNewConversationEvent', () => {

      });
    },
    methods: {

    }
  }
</script>

<style lang="scss">

</style>
