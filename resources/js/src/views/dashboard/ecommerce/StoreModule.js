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
          .get('/dashboard', {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
            , params: queryParams
          })
          .then(response => {
            console.log('let me check');
          })
          .catch(error => reject(error))
      })
    }
  },
}
