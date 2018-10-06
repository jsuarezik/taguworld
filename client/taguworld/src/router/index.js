import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/Index'
import RoutesManager from '@/components/RoutesManager'
import RouteDetail from '@/components/RouteDetail'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'HelloWorld',
      component: HelloWorld
    },
    {
      path: '/routes',
      name: 'RoutesManager',
      component: RoutesManager
    },
    {
      path: '/routes/:id',
      name: 'RouteDetail',
      component: RouteDetail
    }
  ]
})
