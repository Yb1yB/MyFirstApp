<template>
<v-form>
  <v-container>
    <v-layout>
    <v-flex xs12 sm6 offset-sm3>
      <v-card v-for="value in news" v-bind:key="value.id">

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
  
         <v-text-field class="title"  v-model="image">
        <template slot="label">
          Вставте <strong>ссылку</strong> на изображение <v-icon style="vertical-align: middle">find_in_page</v-icon>
        </template>
      </v-text-field>

        <v-card-title>
          <div>
            <span class="grey--text">{{value.timeCreate}}</span><br>
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
        </v-card-actions>
      </v-card>
     
    </v-flex>
  </v-layout>
  </v-container>
  </v-form>
</template>

<script>
import axios from 'axios'
import router from '../plugins/router'

  export default {
   data () {
      return {
          q: '',
        news: '',
        image: '',
        title: '',
        text: '',
        rules: {
          requiredTitle: value => !!value || 'Заполните поле',
          counterTitle: value => value.length <= 40 || 'Более 40 знаков',
          requiredText: value => !!value || 'Заполните поле',
          counterText: value => value.length <= 500 || 'Более 500 знаков'
        },
      }
    },
    mounted() {
        axios({
        method: 'get',
        url: 'http://localhost/myfirstapp/backend/index.php/news/view/'+ this.$route.params.id
      })
      .then(response => (this = response.data))
       console.log(q)
      
     // this.image 
    },
    methods: {
        submit(){
            axios({
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
            }).then(function(response){
                console.log(response.data)
            })
            router.push({name:'news'})
        }
    }
  }
  
</script>

<style>
.title {
    padding: 15px;
}
</style>
