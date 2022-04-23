import axios from "axios";
import Cookies from "js-cookie";
import * as types from "../mutation-types";
import Form from "vform";

// state
export const state = {
  dev: null,
  form: new Form({
    name: ""
  })
};

// getters
export const getters = {
  dev: state => state.dev,
  form: state => state.form
};

// mutations
export const mutations = {
  [types.FETCH_DEV_SUCCESS](state, { dev }) {
    state.dev = dev;
  },
  [types.FETCH_DEV_DETAIL_SUCCESS](state, { dev }) {
    state.dev = dev;
    state.form = new Form({
      name: dev.name
    });
  }
};

// actions
export const actions = {
  saveToken({ commit, dispatch }, payload) {
    commit(types.SAVE_TOKEN, payload);
  },

  async fetchDev({ commit }) {
    try {
      const { data } = await axios.get("/api/dev");

      commit(types.FETCH_DEV_SUCCESS, { dev: data });
    } catch (e) {
      commit(types.FETCH_DEV_FAILURE);
    }
  },

  async fetchDevById({ commit }, id) {
    try {
      const { data } = await axios.get("/api/dev/" + id);
      commit(types.FETCH_DEV_DETAIL_SUCCESS, { dev: data });
    } catch (e) {
      commit(types.FETCH_DEV_FAILURE);
    }
  },

  updateDev({ commit }, payload) {
    commit(types.UPDATE_DEV, payload);
  }
};
