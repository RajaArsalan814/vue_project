import axios from '@axios'

import router from '@/router'

export default {
  namespaced: true,
  state: {},
  getters: {},
  mutations: {},
  actions: {
    fetchUsers(ctx, queryParams) { 
      console.log(router.currentRoute.params.id)
      return new Promise((resolve, reject) => {
        axios
          .get('/classes/list-book/'+router.currentRoute.params.id+'?time='+router.currentRoute.query.timeslot, {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
            , params: queryParams
          })
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },
    fetchDropdown(ctx, queryParams) {
      return new Promise((resolve, reject) => {
        axios
          .get(queryParams, { params: {} })
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },

    deleteUsers(ctx, queryParams) {
      return new Promise((resolve, reject) => {
        axios
          .get('/book-class/delete/' + queryParams)
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
      userData.user_id=router.currentRoute.params.id;
      return new Promise((resolve, reject) => {
        axios
          .post('/book-class/store', userData)
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },
  },
}
