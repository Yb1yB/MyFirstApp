<template>
  <v-container>
    <v-layout>
    <v-flex xs12 sm6 offset-sm3>
      <v-btn outline color="blue" class="but" @click="submitNew">Создать новость</v-btn>
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
        <v-card-actions>
          <v-btn flat color="blue" @click="submit(value.id)">Подробнее</v-btn>
          <v-dialog v-model="dialog" persistent max-width="290">
      <v-btn flat slot="activator" color="red" dark>Удалить</v-btn>
      <v-card>
        <v-card-title class="headline">Вы уверены что хотите удалить данную новость</v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="green darken-1" flat @click="dialog = false">Нет</v-btn>
          <v-btn color="red darken-1" flat @click="submitDel(value.id)">Да</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-btn flat color="green" @click="submitUpd(value.id)">Обновить</v-btn>
        </v-card-actions>
        
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
        dialog: false
      };
    },
    mounted() {
      axios({
        method: 'get',
        url: 'http://localhost/myfirstapp/backend/'
      })
      .then(response => (this.news = response.data))
    },
  methods: {
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
      this.dialog = false
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
</style>
