<template>
  <div class="container">
	<div class="card" v-if="livro">
      <div class="card-body">
        <h3>{{ livro.titulo }}</h3>
        <span>{{ livro.autor }}</span>
		<br>
     	<button @click.prevent="adicionar" type="button" class="btn btn-primary">Adicionar a Coleção</button>
	    <button @click.prevent="reservar" type="button" class="btn btn-success">Reservar</button>
      </div>
	</div>
  </div>
</template>



<script>
import Livro from "../apis/Livro";
import UserLivro from "../apis/UserLivro";

export default {
  data() {
    return {
      livro: null,
	  form: {
		user_id: JSON.parse(localStorage.getItem("user")).id,
		livro_id: "" +  this.$route.params.id
	  }
    };
  },

  mounted() {
	const id = "" +  this.$route.params.id;
	Livro.getLivro(id).then(response => {
		this.livro = response.data;
	});
	UserLivro.getUsersLivro(id).then(response => {
		console.log(response);
	});
  },

  methods: {
    adicionar() {
      UserLivro.adicionar(this.form)
        .then(response => {
			console.log(response);
			alert("Livro adicionado com sucesso a coleção!");
        })
        .catch(error => {
          if (error.response.status === 401) {
            this.errors = error.response.data.errors;
          }
        });
    },
	
	reservar() {
      UserLivro.reservar(this.form)
        .then(response => {
			console.log(response);
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
