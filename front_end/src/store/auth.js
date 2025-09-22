import { defineStore } from 'pinia';
import api from '../utils/axios';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: JSON.parse(localStorage.getItem('user')) || null,
    token: localStorage.getItem('auth_token') || null,
    isAuthenticated: !!localStorage.getItem('auth_token'),
  }),

  actions: {
    async login(credentials) {
      try {
        const response = await api.post('/login', credentials);
        
        this.token = response.data.token;
        this.user = response.data.user;
        this.isAuthenticated = true;
        
        localStorage.setItem('auth_token', this.token);
        localStorage.setItem('user', JSON.stringify(this.user));
        
        return response;
      } catch (error) {
        throw error;
      }
    },

    async register(userData) {
      try {
        const response = await api.post('/register', userData);
        
        this.token = response.data.token;
        this.user = response.data.user;
        this.isAuthenticated = true;
        
        localStorage.setItem('auth_token', this.token);
        localStorage.setItem('user', JSON.stringify(this.user));
        
        return response;
      } catch (error) {
        throw error;
      }
    },

    logout() {
      this.token = null;
      this.user = null;
      this.isAuthenticated = false;
      
      localStorage.removeItem('auth_token');
      localStorage.removeItem('user');
      
      // Appel API logout
      api.post('/logout').catch(() => {});
    },

    async checkAuth() {
      if (!this.token) return false;
      
      try {
        const response = await api.get('/me');
        this.user = response.data;
        localStorage.setItem('user', JSON.stringify(this.user));
        return true;
      } catch (error) {
        this.logout();
        return false;
      }
    }
  }
});