<template>
  <div class="row">
    <div class="col-lg-10 m-auto">
      <card :title="$t('home')">
        <h3>Desenvolvedores:</h3>
        <p v-if="devs.length > 0">
          <ul v-for="dev in devs" :key="dev.id">
            <li> {{ dev.id }} - {{ dev.name }}
              <fa v-on:click="handleClick(dev.id)" style="cursor: pointer" class="text-primary" icon="eye" fixed-width/>
              <fa v-on:click="deleteDev(dev.id)" style="cursor: pointer" class="text-danger" icon="trash" fixed-width/>
            </li>
          </ul>
        </p>
        <p v-else>
          Ainda não foi cadastrado nenhum dev bonitona :(. Cadastra uns aí
          please.
        </p>
        <button class="btn btn-primary rounded-pill">
          <router-link
            :to="{ name: 'register.dev' }"
            style="text-decoration: none; color: white;"
            active-class="active"
          >
            <fa icon="plus" fixed-width /> Cadastrar
          </router-link>
        </button>
      </card>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import axios from "axios";

export default {
  middleware: "auth",

  created() {
    this.$store.dispatch("developer/fetchDev");
  },

  computed: mapGetters({ devs: "developer/dev" }),

  metaInfo() {
    return { title: this.$t("home") };
  },

  methods: {
    async deleteDev(id) {
      const data = await axios.delete("api/dev/delete/" + id);

      if (data.status === 200) {
        this.$toast.success(data.data.msg);
        this.$store.dispatch("developer/fetchDev");
      }
    },
    
    handleClick(id){
      this.$router.push('dev/detail/' + id);
    }
  }
};
</script>
