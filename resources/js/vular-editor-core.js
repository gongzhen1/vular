window.Vue = require('vue');
import './plugins/vuetify'
//import axios from 'axios'

import VularNode from './VularNode'
import VularFullscreenButton from './components/VularFullscreenButton'
//import VularSearchbox from './components/VularSearchbox'
import VularAppfab from './components/VularAppfab'
//import VularThemeSetting from './components/VularThemeSetting'
import VularPage from './components/VularPage'
//import VularForm from './components/VularForm'
import VularDrawer from './components/VularDrawer'
import VularDrawerToolbar from './components/VularDrawerToolbar'
//import VularInteractiveComponent from './components/VularInteractiveComponent'
import VularDataTable from './components/VularDataTable'
import VularDataTableFilter from './components/VularDataTableFilter'
import VularDialog from './components/VularDialog'
import VularTreeSelect from './components/VularTreeSelect'
import VularTreeEditor from './components/VularTreeEditor'
import VularMediaSelect from './components/media/VularMediaSelect'
import VularPageLoadingProgress from './components/VularPageLoadingProgress'
import VularHasManyPanel from './components/VularHasManyPanel'
import VularHasManyTable from './components/VularHasManyTable'
//import VueQuillEditor from 'vue-quill-editor'
import VularTiptapEditor from './components/tiptap/VularTiptapEditor'
import VularMediasDialog from './components/media/VularMediasDialog'
import VularTopMessage from './components/VularTopMessage'
import VularForm from './components/VularForm'
import VularMedias from './components/media/VularMedias'
import VularAvatar from './components/media/VularAvatar'

//import VularLogin from './components/VularLogin'
//import VularLabel from './components/VularLabel'
//import VularEditor from './components/veditor/VularEditor'
import EditorCore from './components/veditor/EditorCore'
//import ElementToolbar from './components/veditor/ElementToolbar'

import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'

Vue.use(Vuetify)

Vue.component('VularTiptapEditor', VularTiptapEditor)
//Vue.component('dynamic-component',DynamicComponent);
Vue.component('VularNode',VularNode);
Vue.component('VularFullscreenButton',VularFullscreenButton);
//Vue.component('vular-searchbox',VularSearchbox);
Vue.component('VularAppfab',VularAppfab);
//Vue.component('vular-theme-setting',VularThemeSetting);
//Vue.component('VularPage',VularPage);
//Vue.component('vular-form',VularForm);
Vue.component('VularDrawer',VularDrawer);
Vue.component('VularDrawerToolbar',VularDrawerToolbar);
//Vue.component('VularInteractiveComponent',VularInteractiveComponent);
Vue.component('VularDataTable',VularDataTable);
Vue.component('VularDataTableFilter',VularDataTableFilter);
Vue.component('VularDialog',VularDialog);
Vue.component('VularTreeSelect',VularTreeSelect);
Vue.component('VularTreeEditor',VularTreeEditor);
Vue.component('VularMediaSelect',VularMediaSelect);
Vue.component('VularPageLoadingProgress',VularPageLoadingProgress);
Vue.component('VularHasManyPanel',VularHasManyPanel);
Vue.component('VularHasManyTable',VularHasManyTable);
Vue.component('VularMediasDialog',VularMediasDialog);
Vue.component('VularTopMessage',VularTopMessage);
Vue.component('VularForm',VularForm);
Vue.component('VularMedias',VularMedias);
Vue.component('VularAvatar',VularAvatar);

//Vue.component('VularLogin',VularLogin);
//Vue.component('VularLabel',VularLabel);
//Vue.component('VularEditor',VularEditor);
Vue.component('EditorCore',EditorCore);
//Vue.component('ElementToolbar',ElementToolbar);


new Vue({
  render: h => h(EditorCore),
}).$mount('#canvas')
