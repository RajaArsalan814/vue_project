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
          .get('/lesson/list', { params: queryParams })
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },
    
    deleteUsers(ctx, queryParams) { 
      return new Promise((resolve, reject) => {
        axios
          .get('/lesson/delete/'+queryParams)
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
          .post('/lesson/store', userData)
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },
  },
}
