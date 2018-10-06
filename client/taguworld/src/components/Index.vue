<template>
  <div class="hero">
    <div>
      <h1 class="display-3">Hello World</h1>
      <p class="lead">This is the homepage of your vue app</p>
    </div>
  </div>
</template>

<style>
  .hero {
    height: 90vh;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
  }
  .hero .lead {
    font-weight: 200;
    font-size: 1.5rem;
  }
</style>

<script>
const axios = require('axios')
export default {
  name: 'Index',
  data () {
    return {
      data: null
    }
  },
  mounted () {
    axios
      .get('http://localhost:8000/api/routes')
      .then(response => (this.data = response.data.data))
  }
}
