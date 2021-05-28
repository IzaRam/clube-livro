<template>
  <div class="container" style="margin-top: 20pt;">
	<div class="card mx-auto" v-if="livro" style="width: 400pt; margin-bottom: 20pt">
      <div class="card-body">
        <h3 class="card-title">{{ livro.titulo }}</h3>
        <span>{{ livro.autor }}</span>
		<br>
	    <img v-if="livro.imagem" :src="livro.imagem" class="card-img-center">
		<br>
		<p class="card-text">{{ livro.descricao }}</p>
		<br>
     	<button @click.prevent="adicionar" type="button" class="btn btn-primary" style="margin-right: 5pt">Adicionar a Coleção</button>
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
	  id:  "" +  this.$route.params.id,
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
      UserLivro.reservar(this.id)
        .then(response => {
			console.log(response);
			alert("Livro reservado com sucesso!");
        })
        .catch(error => {
		  alert("Nenhum exemplar disponível para reservas!")
          if (error.response.status === 401) {
            this.errors = error.response.data.errors;
          }
        });
    }
  }
};
</script>
