import Vue from 'vue'
import VueRouter from 'vue-router'
import News from '../components/News'
import NewCreate from '../components/NewCreate'
import New from '../components/New'
import NewsUpdate from '../components/NewUpdate'

Vue.use(VueRouter)

export default new VueRouter({
    routes: [
        {
            path: '/news',
            name: 'news',
            component: News,
        },
        {
            path: '/news/create',
            name: 'newsCreate',
            component: NewCreate
        },
        {
            path: '/news/:id',
            name: 'new',
            component: New,
            props: {}
        },
        {
            path: '*',
           redirect: '/news'
        },
        {
            path: '/news/update/:id',
            name: 'newsUpdate',
            component: NewsUpdate
        },
    ],
})
