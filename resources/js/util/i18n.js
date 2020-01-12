import Vue from 'vue'
import VueI18n from 'vue-i18n'
Vue.use(VueI18n)

const messages = {
  'zh_cn': require('../assets/i18n/zh_cn'),   
  'en': require('../assets/i18n/en')    
}

export default new VueI18n({
  locale : 'zh_cn', // set locale 
  messages : messages // set locale messages
})
