<template>
<v-form>
  <v-container>
    <v-layout>
    <v-flex xs12 sm6 offset-sm3>
      <v-card>

          <section v-if="image">
        <v-img
          class="white--text"
          height="200px"
          v-model="image"
          v-bind:src="image"
         
        >
          <v-container fill-height fluid>
            <v-layout fill-height>
              <v-flex xs12 align-end flexbox>
                <span class="headline"></span>
              </v-flex>
            </v-layout>
          </v-container>
        </v-img>
</section>
  
         <v-text-field class="title" v-model="image">
        <template slot="label">
          Вставте <strong>ссылку</strong> на изображение <v-icon style="vertical-align: middle">find_in_page</v-icon>
        </template>
      </v-text-field>

        <v-card-title>
          <div>
            <span class="grey--text">Дата новости будет задана автоматически</span><br>
          </div>
        </v-card-title>
        <v-text-field
            v-model="title"
            :rules="[rules.requiredTitle, rules.counterTitle]"
            label="Заголовок"
            counter
            maxlength="40"
            class="title"
          ></v-text-field>
          <v-textarea
          v-model="text"
          :rules="[rules.requiredText, rules.counterText]"
          name="input-7-1"
          maxlength="500"
          counter
          label="Текст новости"
          class="title"
        ></v-textarea>
        <v-card-actions>
          <v-btn flat color="blue" @click="submit">Опубликовать новость</v-btn>
          <router-link to='/news' class="link">
           <v-btn flat color="blue">Вернуться в ленту</v-btn>
         </router-link>
        </v-card-actions>
      </v-card>
     
    </v-flex>
  </v-layout>
  </v-container>
  </v-form>
</template>

<script>
import axios from 'axios'
//import router from '../plugins/router'

  export default {
   data () {
      return {
        error: null,
        inf: null,
        image: '',
        title: '',
        text: '',
        rules: {
          requiredTitle: value => !!value || 'Заполните поле',
          counterTitle: value => value.length <= 40 || 'Более 40 знаков',
          requiredText: value => !!value || 'Заполните поле',
          counterText: value => value.length <= 500 || 'Более 500 знаков'
        }
      }
    },
    
    methods: {
     async submit(){
       try {
          await axios({
                method: 'post',
                url: 'http://localhost/myfirstapp/backend/index.php/News/Create',
                headers: {
                'Content-Type' : 'application/json'
                          },
                data: {
                    title : this.title,
                    image : this.image,
                    text : this.text
                }
            }).then(response=>{this.inf = response})
              .catch(error=>this.error = error)
       } catch (error) {
         return error
       } finally {
          this.$router.push({name: 'news'})
       }
            
        },

    
    }
  }
  
</script>

<style>
.title {
    padding: 15px;
}
</style>
