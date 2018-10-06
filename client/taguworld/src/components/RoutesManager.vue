<template>
  <div class="container-fluid mt-4">
    <h1 class="h1">Route Manager</h1>
    <b-alert :show="loading" variant="info">Cargando...</b-alert>
    <b-row>
      <b-col>
        <input type="text" v-model="search" placeholder="buscar por origen/destino">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Origen</th>
              <th>Destino</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="route in filteredRoutes" :key="route.id">
              <td>{{ route.id }}</td>
              <td>{{ route.origin }}</td>
              <td>{{ route.destination }}</td>
              <td class="text-right">
                 <router-link :to="{ name : 'RouteDetail', params : { id : route.id}}">Detalle</router-link>
              </td>
            </tr>
          </tbody>
        </table>
      </b-col>
    </b-row>
  </div>
</template>
<script>
import api from '@/api'
export default {
  data () {
    return {
      loading: false,
      routes: [],
      search: '',
      model: {}
    }
  },
  async created () {
    this.refreshRoutes()
  },
  computed: {
    filteredRoutes: function () {
      return this.routes.filter((route) => {
        return route.origin.match(this.search) || route.destination.match(this.search)
      })
    }
  },
  methods: {
    async refreshRoutes () {
      this.loading = true
      this.routes = await api.getRoutes()
      this.loading = false
    }
  }
}
</script>
