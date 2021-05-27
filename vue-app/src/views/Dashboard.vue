<template>
  <div class="container">
    <button @click.prevent="adicionar" type="button" class="btn btn-success">Adicionar</button>
    <h1>Livros</h1>
	<div  v-if="livros">
    <div class="card" v-for="(livro, i) in livros" :key="livro.titulo" v-on:click="select(i)" style="cursor:pointer">
      <div class="card-body">
        <h3>{{ livro.titulo }}</h3>
        <span>{{ livro.autor }}</span>
      </div>
    </div>
	</div>
  </div>
</template>

<script>
import Livro from "../apis/Livro";

export default {
  data() {
    return {
      livros: null
    };
  },

  mounted() {
	Livro.getLivros().then(response => {
		this.livros = response.data;
	});
  },

  methods: {
    adicionar() {
       this.$router.push({ name: "Adicionar" });
    },
	select: function(i){
       const id = this.livros[i].id
       this.$router.push({ name: "Livro", params: { id: id } });
  	}
  }
};
</script>
