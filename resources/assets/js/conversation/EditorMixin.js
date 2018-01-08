import SimpleMDE from 'simplemde';
import markdown from 'markdown';

export default {
  created () {

  },

  data () {
    return {
      containerClass: ['hide'],
      simplemde: null,
      element: null,
      mode: null,
      userText: '',
      title: ''
    }
  },

  methods: {
    initContainer() {
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
    }
  }
}