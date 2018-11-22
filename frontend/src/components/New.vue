<template>
  <v-container>
    <v-layout>
    <v-flex xs12 sm6 offset-sm3>
      <v-card v-for="value in news" v-bind:key="value.id">
        <v-img
          class="white--text"
          height="200px"
         v-bind:src="value.image"
        >
          <v-container fill-height fluid>
            <v-layout fill-height>
              <v-flex xs12 align-end flexbox>
                <span class="headline">{{value.title}}</span>
              </v-flex>
            </v-layout>
          </v-container>
        </v-img>
        <v-card-title>
          <div>
            <span class="grey--text">{{value.timeUpdate}}</span><br>
          </div>
        </v-card-title>
        <v-card-text>
          {{value.text}}
        </v-card-text>
        <v-card-actions>
           <v-btn flat color="blue" @click="submit()">Вернуться в ленту</v-btn>
        </v-card-actions>
        
      </v-card>
     
    </v-flex>
  </v-layout>
  </v-container>
</template>

<script>
import axios from 'axios'
import router from '../plugins/router';

  export default {
    data() {
      return {
        news: null,
        value: null
      };
    },
    mounted() {
      axios({
        method: 'get',
        url: 'http://localhost/myfirstapp/backend/index.php/news/view/'+ this.$route.params.id
      })
      .then(response => (this.news = response.data))
    },
    method:{
      submit(){
        router.push({name:'news'})
      }
    }
  }
  
</script>

<style>

</style>
