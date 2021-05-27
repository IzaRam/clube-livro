<template>
  <div class="home col-5 mx-auto py-5 mt-5">
    <h1 class="text-center">Login</h1>
    <div class="card">
      <div class="card-body">
        <div class="form-group">
          <label for="titulo">Titulo:</label>
          <input
            type="text"
            v-model="form.titulo"
            class="form-control"
            id="titulo"
          />
          <span class="text-danger" v-if="errors.titulo">
            {{ errors.titulo[0] }}
          </span>
        </div>
        <div class="form-group">
          <label for="autor">Autor:</label>
          <input
            type="text"
            v-model="form.autor"
            class="form-control"
            id="autor"
          />
          <span class="text-danger" v-if="errors.autor">
            {{ errors.autor[0] }}
          </span>
        </div>
        <button @click.prevent="save" class="btn btn-primary btn-block">
          Salvar
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import Livro from "../apis/Livro";

export default {
  data() {
    return {
      form: {
        titulo: "",
        autor: "",
        device_name: "browser"
      },
      errors: []
    };
  },

  methods: {
    save() {
      Livro.adicionar(this.form)
        .then(() => {
          this.$root.$emit("adicionado", true);
          this.$router.push({ name: "Dashboard" });
        })
        .catch(error => {
          if (error.response.status === 401) {
            this.errors = error.response.data.errors;
          }
        });
    }
  }
};
</script>
