import axios from '@axios'

export default {
  namespaced: true,
  state: {},
  getters: {},
  mutations: {},
  actions: {
    fetchUsers(ctx, queryParams) { 
      return new Promise((resolve, reject) => {
        axios
          .get('/logs/event', { params: queryParams })
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },
    fetchUsersPayment(ctx, queryParams) { 
      return new Promise((resolve, reject) => {
        axios
          .get('/logs/payment', { params: queryParams })
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },
    fetchUsersClass(ctx, queryParams) { 
      return new Promise((resolve, reject) => {
        axios
          .get('/logs/class', { params: queryParams })
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },
    
    deleteUsers(ctx, queryParams) { 
      return new Promise((resolve, reject) => {
        axios
          .get('/announcement/delete/'+queryParams)
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },
    fetchUser(ctx, { id }) {
      return new Promise((resolve, reject) => {
        axios
          .get(`/apps/user/users/${id}`)
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },
    addUser(ctx, userData) {
      return new Promise((resolve, reject) => {
        axios
          .post('/announcement/store', userData)
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },
  },
}
