<template>
  <div class="row">
    <div class="col-lg-7 m-auto">
      <card :title="$t('register')">
        <form @submit.prevent="register" @keydown="form.onKeydown($event)">
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
                {{ $t("register") }}
              </v-button>
            </div>
          </div>
        </form>
      </card>
    </div>
  </div>
</template>

<script>
import Form from "vform";
export default {
  metaInfo() {
    return { title: this.$t("register") };
  },

  data: () => ({
    form: new Form({
      name: ""
    })
  }),

  methods: {
    async register() {
      // Register the dev.

      const data = await this.form.post("/api/dev/register");

      if (data.status) {
        this.$toast.success(data.data.msg);
      }
      // Redirect home.
      this.$router.push({ name: "home" });
    }
  }
};
</script>
