<template>
  <div class="row">
    <div class="col-lg-7 m-auto">
      <card :title="$t('update')">
        <form @submit.prevent="update" @keydown="form.onKeydown($event)">
          <!-- Name -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">{{
              $t("name")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="form.name"
                :class="{ 'is-invalid': form.errors.has('name') }"
                class="form-control"
                type="text"
                name="name"
              />
              <has-error :form="form" field="name" />
            </div>
          </div>
          <div class="mb-3 row">
            <div class="col-md-7 offset-md-3 d-flex">
              <!-- Submit Button -->
              <v-button :loading="form.busy">
                {{ $t("update") }}
              </v-button>
            </div>
          </div>
        </form>
      </card>
    </div>
  </div>
</template>

<script>
import store from "~/store";
import { mapGetters } from "vuex";

export default {
  metaInfo() {
    return { title: this.$t("update") };
  },

  created() {
    store.dispatch("developer/fetchDevById", this.$route.params.id);
    console.log(store);
  },

  computed: mapGetters({
    form: "developer/form"
  }),

  methods: {
    async update() {
      // Update the dev.
      const data = await this.form.put(
        "/api/dev/update/" + this.$route.params.id
      );

      if (data.status) {
        this.$toast.success(data.data.msg);
      }
      // Redirect home.
      this.$router.push({ name: "home" });
    }
  }
};
</script>
