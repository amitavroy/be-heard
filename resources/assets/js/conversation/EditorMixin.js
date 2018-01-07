import SimpleMDE from 'simplemde';
import markdown from 'markdown';

export default {
  created () {
    window.eventBus.$on('addNewConversationEvent', (mode, entity) => {
      console.log('entity', entity);
      switch (mode) {
        case 'conversation':
          this.mode = mode;
          break;

        case 'reply':
          this.mode = mode;
          break;

        default:
          return false;
      }

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
      containerClass: ['hide'],
      simplemde: null,
      mode: null
    }
  },

  methods: {
    closeContainer() {
      this.containerClass.push(['animated', 'bounceOutDown']);
      this.simplemde.toTextArea();
      this.simplemde = null;
      this.userText = '';
    }
  }
}