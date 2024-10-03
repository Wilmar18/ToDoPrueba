import { createStore } from 'vuex'
import axios from 'axios'

export default createStore({
  state: {
    notes: []
  },
  mutations: {
    SET_NOTES(state, notes) {
      state.notes = notes
    },
    ADD_NOTE(state, note) {
      state.notes.push(note)
    },
    UPDATE_NOTE(state, updatedNote) {
      const index = state.notes.findIndex(note => note.id === updatedNote.id)
      if (index !== -1) {
        state.notes.splice(index, 1, updatedNote)
      }
    },
    DELETE_NOTE(state, noteId) {
      state.notes = state.notes.filter(note => note.id !== noteId)
    }
  },
  actions: {
    async fetchNotes({ commit }) {
      try {
        const response = await axios.get('/api/notes')
        commit('SET_NOTES', response.data)
      } catch (error) {
        console.error('Error fetching notes:', error)
      }
    },
    async createNote({ commit }, noteData) {
      try {
        const response = await axios.post('/api/notes', noteData)
        commit('ADD_NOTE', response.data.note)
        return response.data.note
      } catch (error) {
        console.error('Error creating note:', error)
        throw error
      }
    },
    async updateNote({ commit }, { id, noteData }) {
      try {
        const response = await axios.put(`/api/notes/${id}`, noteData)
        commit('UPDATE_NOTE', response.data.note)
        return response.data.note
      } catch (error) {
        console.error('Error updating note:', error)
        throw error
      }
    },
    async deleteNote({ commit }, id) {
      try {
        await axios.delete(`/api/notes/${id}`)
        commit('DELETE_NOTE', id)
      } catch (error) {
        console.error('Error deleting note:', error)
        throw error
      }
    }
  },
  getters: {
    allNotes: state => state.notes
  }
})