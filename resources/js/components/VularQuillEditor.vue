<template>
  <div>
    <quill-editor v-model="content"
      ref="quillTextEditor"
      style="height: 100%"
      :options="editorOption"
      @change="onChange"
    >
      <div id="toolbar" slot="toolbar">
        <select class="ql-header">
            <option value="1"></option>
            <option value="2"></option>
            <option value="3"></option>
            <option value="4"></option>
            <option value="5"></option>
            <option value="6"></option>
            <option selected="selected"></option>
        </select>
        <select class="ql-size">
            <option value="small"></option>
            <option selected></option>
            <option value="large"></option>
            <option value="huge"></option>
        </select>
        <button type="button" class="ql-bold"></button>
        <button type="button" class="ql-italic"></button>
        <button type="button" class="ql-underline"></button>
        <button type="button" class="ql-strike"></button>
        <button type="button" class="ql-blockquote"></button>
        <button type="button" class="ql-code-block"></button>
        <button type="button" class="ql-header" value="1"></button>
        <button type="button" class="ql-header" value="2"></button>
        <button type="button" class="ql-list" value="ordered"></button>
        <button type="button" class="ql-list" value="bullet"></button>
        <button type="button" class="ql-script" value="sub"></button>
        <button type="button" class="ql-script" value="super"></button>
        <button type="button" class="ql-indent" value="-1"></button>
        <button type="button" class="ql-indent" value="+1"></button>
        <button type="button" class="ql-direction" value="rtl"></button>
        <select class="ql-color">
            <option selected="selected"></option>
            <option value="#e60000"></option>
            <option value="#ff9900"></option>
            <option value="#ffff00"></option>
            <option value="#008a00"></option>
            <option value="#0066cc"></option>
            <option value="#9933ff"></option>
            <option value="#ffffff"></option>
            <option value="#facccc"></option>
            <option value="#ffebcc"></option>
            <option value="#ffffcc"></option>
            <option value="#cce8cc"></option>
            <option value="#cce0f5"></option>
            <option value="#ebd6ff"></option>
            <option value="#bbbbbb"></option>
            <option value="#f06666"></option>
            <option value="#ffc266"></option>
            <option value="#ffff66"></option>
            <option value="#66b966"></option>
            <option value="#66a3e0"></option>
            <option value="#c285ff"></option>
            <option value="#888888"></option>
            <option value="#a10000"></option>
            <option value="#b26b00"></option>
            <option value="#b2b200"></option>
            <option value="#006100"></option>
            <option value="#0047b2"></option>
            <option value="#6b24b2"></option>
            <option value="#444444"></option>
            <option value="#5c0000"></option>
            <option value="#663d00"></option>
            <option value="#666600"></option>
            <option value="#003700"></option>
            <option value="#002966"></option>
            <option value="#3d1466"></option>
        </select>
        <select class="ql-background">
            <option value="#000000"></option>
            <option value="#e60000"></option>
            <option value="#ff9900"></option>
            <option value="#ffff00"></option>
            <option value="#008a00"></option>
            <option value="#0066cc"></option>
            <option value="#9933ff"></option>
            <option selected="selected"></option>
            <option value="#facccc"></option>
            <option value="#ffebcc"></option>
            <option value="#ffffcc"></option>
            <option value="#cce8cc"></option>
            <option value="#cce0f5"></option>
            <option value="#ebd6ff"></option>
            <option value="#bbbbbb"></option>
            <option value="#f06666"></option>
            <option value="#ffc266"></option>
            <option value="#ffff66"></option>
            <option value="#66b966"></option>
            <option value="#66a3e0"></option>
            <option value="#c285ff"></option>
            <option value="#888888"></option>
            <option value="#a10000"></option>
            <option value="#b26b00"></option>
            <option value="#b2b200"></option>
            <option value="#006100"></option>
            <option value="#0047b2"></option>
            <option value="#6b24b2"></option>
            <option value="#444444"></option>
            <option value="#5c0000"></option>
            <option value="#663d00"></option>
            <option value="#666600"></option>
            <option value="#003700"></option>
            <option value="#002966"></option>
            <option value="#3d1466"></option>
        </select>
        <select class="ql-font">
          <option selected="selected"></option>
          <option value="serif"></option>
          <option value="monospace"></option>
        </select>

        <select class="ql-align">
          <option selected="selected"></option>
          <option value="center"></option>
          <option value="right"></option>
          <option value="justify"></option>
        </select>
        <button type="button" class="ql-clean"></button>
        <button type="button" class="ql-link"></button>
        <button type="button" @click="showImageDialog = true">
          <svg viewBox="0 0 18 18">
            <rect class="ql-stroke" height="10" width="12" x="3" y="4"></rect>
            <circle class="ql-fill" cx="6" cy="7" r="1"></circle>
            <polyline class="ql-even ql-fill" points="5 12 5 11 7 9 8 10 11 7 13 9 13 12 5 12"></polyline>
          </svg>
        </button>
        <button type="button" class="ql-video"></button>
      </div>
    </quill-editor>

    <vular-medias-dialog 
      :show="showImageDialog"
      acceptMatch = 'image/*'
      title="Images" 
      topTip='Upload or drag and drop images in JPEG, PNG or GIF formats. '
      typeName="$t('media.images')"
      @close="showImageDialog=false"
      @select="imagesSelected"
      >
    </vular-medias-dialog>
  </div>
</template>
<script>
export default {
  name: 'vular-quill-editor',
  components: {
  },
  props: {
    value: {
      type: String
    },
  },
  data() {
    return {
      content: this.value,
      editorOption: {
        modules: {
            toolbar: '#toolbar'
        }
      },

      showImageDialog:false
    }
  },
  computed: {
    editor() {
      return this.$refs.quillTextEditor.quill;
    }
  },
  methods: {
    onChange(){
      this.$emit('input', this.content)
    },
    imagesSelected:function (images) {
      for(var i = 0; i < images.length; i++){
        this.editor.focus();
        this.editor.insertEmbed(this.editor.getSelection().index, 'image', images[i].src);
      }
    },
  },
  watch: {
    'value'(newVal, oldVal) {
        if (this.editor) {
          if (newVal !== this.content) {
            this.content = newVal
          }
        }
    },
  }
}
</script>
