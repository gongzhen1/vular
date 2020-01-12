<template>
  <v-content>
    <v-container>
      <v-layout row class="align-center">
          <v-icon small>home</v-icon>
          <v-breadcrumbs :items="items" divider="-">
          </v-breadcrumbs>
          <v-spacer></v-spacer>
      </v-layout>
      <v-layout row wrap class="pb-4">
          <v-text-field label="Name" required style="font-size: 30px;" ></v-text-field>
          <v-spacer></v-spacer>
          <v-btn round large light class="hidden-sm-and-down">Cancel</v-btn>
          <v-btn round large color="primary" class="hidden-xs-only" dark>Save</v-btn>
          <v-btn fab small light class="hidden-sm-and-down">
            <v-icon>more_horiz</v-icon>
          </v-btn>
      </v-layout>  
      <v-layout row>
        <v-flex lg8 class="pr-4">
          <v-card style="border-radius:10px;">
            <v-toolbar color="transparent" flat dense card>
              <v-toolbar-title style="font-weight: 300;">Images & Videos</v-toolbar-title>
              <v-spacer></v-spacer>
              <v-btn icon>
                <v-icon color="blue">more_horiz</v-icon>
              </v-btn>
            </v-toolbar>
            <v-divider ></v-divider>
            <v-card-text>
              <v-container fluid grid-list-sm>
                <v-layout row wrap>
                  <v-flex v-for="i in 1" :key="i" xs4 class="pa-2">
                    <img :src="`https://randomuser.me/api/portraits/men/${i + 20}.jpg`" class="image" alt="lorem" width="100%" style="border-radius: 5px;">
                  </v-flex>
                  <v-flex xs8>
                    <v-layout row wrap>
                      <v-flex v-for="i in 8" :key="i" xs3 class="pa-2">
                        <img :src="`https://randomuser.me/api/portraits/men/${i + 21}.jpg`" class="image" alt="lorem" width="100%" style="border-radius: 5px;">
                      </v-flex>
                    </v-layout>
                  </v-flex>
                </v-layout>
                <v-layout row wrap>
                  <v-flex v-for="i in 3" :key="i" xs2 class="pa-2">
                    <img :src="`https://randomuser.me/api/portraits/men/${i + 29}.jpg`" class="image" alt="lorem" width="100%" style="border-radius: 5px;">
                  </v-flex>
                </v-layout>
              </v-container>
            </v-card-text>       
          </v-card>
          <v-card style="border-radius:10px;" class="mt-5">
            <v-toolbar color="transparent" flat dense card>
              <v-toolbar-title style="font-weight: 300;">基本信息</v-toolbar-title>
                <v-spacer></v-spacer>
              </v-toolbar>
              <v-divider ></v-divider>
            <v-card-text>
              <v-container>
                <v-layout row wrap>
                  <v-flex lg12>
                    <v-text-field label="产品名称 *"></v-text-field>
                  </v-flex>
                  <v-flex lg12>
                    <v-text-field label="Slug"></v-text-field>
                  </v-flex>
                  <v-flex xs12>
                    <v-combobox
                      v-model="select"
                      :items="items"
                      label="产品分类"
                      multiple
                      ></v-combobox>
                  </v-flex>
                  <v-flex lg12>
                    <v-text-field label="认证信息"></v-text-field>
                  </v-flex>
                  <v-flex sm6 lg6 class="pr-3">
                    <v-text-field label="纯度"></v-text-field>
                  </v-flex>
                  <v-flex sm6  lg6  class="pl-3">
                    <v-text-field label="级别"></v-text-field>
                  </v-flex>
                  <v-flex sm6  lg6 class="pr-3">
                    <v-text-field label="规格"></v-text-field>
                  </v-flex>
                  <v-flex sm6  lg6  class="pl-3">
                      <v-text-field label="包装"></v-text-field>
                  </v-flex>
                  <v-flex sm6  lg6 class="pr-3">
                      <v-text-field label="产能"></v-text-field>
                  </v-flex>
                  <v-flex sm6  lg6  class="pl-3">
                      <v-text-field label="交货期"></v-text-field>
                  </v-flex>
                  <v-flex sm6  lg6 class="pr-3">
                      <v-text-field label="最小订单"></v-text-field>
                  </v-flex>
                  <v-flex sm6  lg6  class="pl-3">
                      <v-text-field label="HS编码"></v-text-field>
                  </v-flex>
                  <v-flex sm6  lg6 class="pr-3">
                    <v-combobox
                      v-model="select"
                      :items="priceItems"
                      label="价格类型"
                    ></v-combobox>
                  </v-flex>
                  <v-flex sm6  lg6  class="pl-3">
                      <v-text-field
                        label="价格"
                        value="10.00"
                        prefix="$"
                      ></v-text-field>
                  </v-flex>
                  <v-flex sm6 lg6 class="pr-3">
                      <v-text-field label="库存"></v-text-field>
                  </v-flex>
                  <v-flex sm6 lg6 class="pl-3">
                      <v-text-field label="产品百科ID"></v-text-field>
                  </v-flex>

                  <v-flex lg12>
                      <v-textarea
                        name="input-7-1"
                        label="简介"
                        rows='4'
                        value="The Woodman set to work at once, and so sharp was his axe that the tree was soon chopped nearly through."
                        hint="Hint text"
                      ></v-textarea>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-card-text>       
          </v-card>
          <v-card style="border-radius:10px; height: 570px;" class="mt-5">
            <v-toolbar color="transparent" flat dense card>
              <v-toolbar-title style="font-weight: 300;">产品描述</v-toolbar-title>
              <v-spacer></v-spacer>
              <v-btn icon>
                  <v-icon>fullscreen</v-icon>
              </v-btn>
            </v-toolbar>
            <v-divider ></v-divider>
            <v-card-text>
              <quill-editor 
                style="height : 420px"
                :content="content"
                :options="editorOption"
              >
              </quill-editor>      
            </v-card-text>       
          </v-card>
        </v-flex>
        <v-flex lg4 class="hidden-sm-and-down">
          <v-card style="border-radius:10px;">
            <v-toolbar color="transparent" flat dense card>
              <v-toolbar-title style="font-weight: 300;">外观</v-toolbar-title>
              <v-spacer></v-spacer>
            </v-toolbar>
            <v-divider ></v-divider>
            <v-card-text>
              <v-container>
                
                <v-layout row wrap>
                  <v-flex lg8 sm12>
                    <v-switch label="首页展示"></v-switch>
                    </v-flex>
                  <v-flex lg8 sm12>
                    <v-combobox
                      v-model="select"
                      :items="items"
                      label="模板"
                    ></v-combobox>
                  </v-flex>
                  <v-flex lg8 sm12>
                    <v-text-field label="顺序">10</v-text-field>
                  </v-flex>
                  <v-flex lg8 sm12>
                    <v-switch label="发布"></v-switch>
                  </v-flex>
                </v-layout>        
              </v-container>
            </v-card-text>       
          </v-card>
          <v-card style="border-radius:10px;" class="mt-5">
            <v-toolbar color="transparent" flat dense card>
              <v-toolbar-title style="font-weight: 300;">附加信息</v-toolbar-title>
              <v-spacer></v-spacer>
            </v-toolbar>
            <v-divider ></v-divider>
            <v-card-text>

            <v-list dense class="pt-0">
              <v-list-tile
                @click="dialog = true"
              >
                <v-list-tile-action>
                  <v-icon color="blue">public</v-icon>
                </v-list-tile-action>

                <v-list-tile-content>
                  <v-list-tile-title>SEO Meta</v-list-tile-title>
                </v-list-tile-content>
              </v-list-tile>
              <v-list-tile
                @click="dialog = true"
              >
                <v-list-tile-action>
                  <v-icon color="red">share</v-icon>
                </v-list-tile-action>

                <v-list-tile-content>
                  <v-list-tile-title>OG Meta</v-list-tile-title>
                </v-list-tile-content>
              </v-list-tile>
              <v-dialog v-model="dialog" persistent max-width="900px">
                <v-card>
                  <v-card-title>
                    <span class="headline">User Profile</span>
                  </v-card-title>
                  <v-card-text>
                    <v-container grid-list-md>
                      <v-layout wrap>
                        <v-flex xs12 sm6 md4>
                          <v-text-field label="Legal first name*" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm6 md4>
                          <v-text-field label="Legal middle name" hint="example of helper text only on focus"></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm6 md4>
                          <v-text-field
                            label="Legal last name*"
                            hint="example of persistent helper text"
                            persistent-hint
                            required
                          ></v-text-field>
                        </v-flex>
                        <v-flex xs12>
                          <v-text-field label="Email*" required></v-text-field>
                        </v-flex>
                        <v-flex xs12>
                          <v-text-field label="Password*" type="password" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm6>
                          <v-select
                            :items="['0-17', '18-29', '30-54', '54+']"
                            label="Age*"
                            required
                          ></v-select>
                        </v-flex>
                        <v-flex xs12 sm6>
                          <v-autocomplete
                            :items="['Skiing', 'Ice hockey', 'Soccer', 'Basketball', 'Hockey', 'Reading', 'Writing', 'Coding', 'Basejump']"
                            label="Interests"
                            multiple
                          ></v-autocomplete>
                        </v-flex>
                      </v-layout>
                    </v-container>
                    <small>*indicates required field</small>
                  </v-card-text>
                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" flat @click="dialog = false">Close</v-btn>
                    <v-btn color="blue darken-1" flat @click="dialog = false;snackbar=true">Save</v-btn>
                  </v-card-actions>
                </v-card>
              </v-dialog>
            </v-list>
            </v-card-text>       
          </v-card>
        </v-flex>
      </v-layout>
      <v-divider class="mt-5"></v-divider>
      <v-layout row wrap class="pb-4 pt-4" >
        <v-spacer></v-spacer>
          <v-btn round large light>Cancel</v-btn>
          <v-btn round large color="primary" dark>Save</v-btn>
      </v-layout>  
    </v-container>
    <v-snackbar
      v-model="snackbar"
      :bottom="y === 'bottom'"
      :left="x === 'left'"
      :multi-line="mode === 'multi-line'"
      :right="x === 'right'"
      :timeout="timeout"
      :top="y === 'top'"
      :vertical="mode === 'vertical'">
      {{ text }}
      <v-btn
        color="pink"
        flat
        @click="snackbar = false"
      >
        Close
      </v-btn>
    </v-snackbar>
  </v-content>

</template>

<script>
import 'quill/dist/quill.core.css';
import 'quill/dist/quill.snow.css';
import 'quill/dist/quill.bubble.css';

export default {
    name: 'vular-page',
    props:['schema'],

    data: () => ({
        form:{},
        content: 'Compose Epic Story...',
        editorOption: {

        },
        items: [
            {
              text: 'Dashboard',
              disabled: false,
              href: 'breadcrumbs_dashboard'
            },
            {
              text: 'Link 1',
              disabled: false,
              href: 'breadcrumbs_link_1'
            },
            {
              text: 'Link 2',
              disabled: true,
              href: 'breadcrumbs_link_2'
            }
        ],
        select: '',
        priceItems: [
            'Programming',
            'Design',
            'Vue',
            'Vuetify'
        ],
        additems: [
          { title: 'SEO Meta', icon: 'public',color:'blue' },
          { title: 'OG Meta', icon: 'share',color:'green' }
        ],
      dialog: false,
        snackbar: false,
        y: 'top',
        x: null,
        mode: '',
        timeout: 3000,
        text: 'Hello, I\'m a snackbar',

    }),

    methods: {
        dosomthing(){
            //
        }
    }
};
</script>
