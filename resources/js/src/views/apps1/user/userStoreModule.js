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
          .get('/teacher/show', { params: queryParams })
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },
    fetchGls(ctx, id) { 
      return new Promise((resolve, reject) => {
        axios
          .get('/teacher/get-gl/'+id)
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },
    fetchUser(ctx, { id }) {
      return new Promise((resolve, reject) => {
        axios
          .get(`/teacher/view/${id}`)
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },
    async updateUser(ctx, userData) {
       return new Promise((resolve, reject) => {
         axios
           .post('/teacher/update/'+userData.id, userData)
           .then(response => resolve(response))
           .catch(error => reject(error))
       })
     },
     async updatePermissions(ctx, userData) {
        return new Promise((resolve, reject) => {
          axios
            .post('/teacher/add-permissions/'+userData.id, userData)
            .then(response => resolve(response))
            .catch(error => reject(error))
        })
      },
  },
}
