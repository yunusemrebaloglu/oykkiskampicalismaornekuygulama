<template>
  <div>
    <form @submit.prevent="login">
      <input class="form-control mt-3" placeholder="text" type="text" v-model="email" />
      <input class="form-control mt-3" placeholder="password" type="password" v-model="password" />
      <button class="form-control mt-3 btn btn-primary" type="submit" name="button">Giriş</button>
    </form>
  </div>
</template>

<script type="text/javascript">
export default {
  data() {
    return {
      email: "",
      password: ""
    };
  },
  methods: {
    login() {
      var self = this;
      axios
        .post("http://oyk.test/api/auth/login", {
          email: self.email,
          password: self.password
        })
        .then(response => {
          this.$store.commit("setToken", response.data.access_token);
			this.$router.push("/todos");
        })
        .catch(response => {
          console.log(response);
        });
    }
  }
};
</script>
