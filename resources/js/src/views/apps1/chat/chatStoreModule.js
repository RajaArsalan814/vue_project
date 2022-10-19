import axios from '@axios'

export default {
  namespaced: true,
  state: {},
  getters: {},
  mutations: {},
  actions: {
    fetchChatsAndContacts() {
      return new Promise((resolve, reject) => {
        axios
          .get('/chat/contact')
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },
    getProfileUser() {
      return new Promise((resolve, reject) => {
        axios
          .get('/apps/chat/users/profile-user')
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },
    getChat(ctx, { userId }) {
      return new Promise((resolve, reject) => {
        axios
          .get(`chat/chats/${userId}`)
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },
    sendMessage(ctx, { contactId, message, senderId }) {
      return new Promise((resolve, reject) => {
        axios
          .post(`/chat/send`, { contactId,message, senderId })
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },
  },
}
