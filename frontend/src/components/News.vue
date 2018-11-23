<template>
  <v-container>
    <v-layout>
    <v-flex xs12 sm6 offset-sm3>
      <router-link to="news/create" class="link">
      <v-card :hover="true">
        <v-img
          class="white--text"
          height="200px"
          src="https://st2.depositphotos.com/1915171/11241/v/950/depositphotos_112416464-stock-illustration-news-icon-newspaper-sign.jpg"
        >
          <v-container fill-height fluid>
            <v-layout fill-height>
              <v-flex xs12 align-end flexbox>
              </v-flex>
            </v-layout>
          </v-container>
        </v-img>
        <v-card-title>
          <div>
            <span class="grey--text">Дата</span><br>
          </div>
        </v-card-title>
        <v-card-actions>
          <v-btn :disabled="true" flat color="blue">Подробнее</v-btn>
          <v-btn :disabled="true" flat color="red">Удалить</v-btn>
           <v-btn :disabled="true" flat color="green">Обновить</v-btn>
        </v-card-actions>
      </v-card>
      </router-link>
    <div class="space"></div>
  
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
            <span class="grey--text">{{value.timeCreate}}</span><br>
          </div>
        </v-card-title>
        <v-card-actions>
          <v-btn flat color="blue" @click="submit(value.id)">Подробнее</v-btn>
          <v-btn flat color="red" @click="submitDel(value.id)">Удалить</v-btn>
    <v-btn flat color="green" @click="submitUpd(value.id)">Обновить</v-btn>
        </v-card-actions>
        <div class="space"></div>
      </v-card>
    </v-flex>
  </v-layout>
  </v-container>
</template>

<script>
import axios from 'axios'
import router from '../plugins/router'

  export default {

    data() {
      return {
        news: null,
        value: null,
        go: false,
        error: null
      }
    },

  created() {
    this.fetchData()
  },

  watch: {
      '$route' : 'fetchData',
      'go'() {
        this.go = false
        this.fetchData()
      }
    },


  methods: {

    fetchData() {
        this.news = null
       
        axios({
        method: 'get',
        url: 'http://localhost/myfirstapp/backend/'
      })
      .then(response => (this.news = response.data))
    },

    submit(a) {
      router.push({name:'new', params:{id: a}})
    },

    submitNew() {
      router.push({name:'newsCreate'})
    },

    submitDel(b) {
      axios({
        method: 'delete',
        url: 'http://localhost/myfirstapp/backend/index.php/news/delete/'+ b
      }) 
      this.go = true
    },

    submitUpd(c) {
      router.push({name:'newsUpdate', params:{id: c}})
    }

  }
  }
  
</script>

<style>
.but{
  margin: 0;
}

.link {
  text-decoration: none;
}
.space {
  margin-bottom: 20px;
}
</style>
