<template>
  <div class="container-fluid mt-4">
    <h1 class="h1">Route Detail</h1>
    <p>ID: {{this.route[0].id}} </p>
    <p>Origen: {{this.route[0].origin}}</p>
    <p>Destino: {{this.route[0].destination}}</p>
    <p style="float:left">Conductores</p>
    <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>DNI</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="driver in route[0].drivers" :key="driver.id">
              <td>{{ driver.id }}</td>
              <td>{{ driver.name }}</td>
              <td>{{ driver.dni }}</td>
            </tr>
          </tbody>
    </table>
    <router-link :to="{ name : 'RoutesManager'}">Volver</router-link>
  </div>
</template>
<script>
import api from '@/api'
export default {
  data () {
    return {
      id: this.$route.params.id,
      loading: false,
      route: [],
      model: {}
    }
  },
  async created () {
    this.loadRoute()
  },
  methods: {
    async loadRoute () {
      this.loading = true
      this.route = await api.getRoute(this.id)
      this.loading = false
    }
  }
}
</script>
