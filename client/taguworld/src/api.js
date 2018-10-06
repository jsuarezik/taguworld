import axios from 'axios'

const client = axios.create({
  baseURL: 'http://localhost:8000/api/',
  json: true
})

export default {
  async execute (method, resource, data) {
    return client({
      method,
      url: resource,
      data
    }).then(req => {
      return req.data
    })
  },
  getRoutes () {
    return this.execute('get', '/routes')
  },
  getRoute (id) {
    return this.execute('get', `/routes/${id}?with[]=drivers`)
  }
}
