<template>
  <div class="container" style="margin-top: 20pt">
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <button @click.prevent="adicionar" type="button" class="btn btn-success">Adicionar</button>
	</div>
    <h1>Livros</h1>
	<div  v-if="livros">
    <div class="card" v-for="(livro, i) in livros" :key="livro.titulo" v-on:click="select(i)" style="cursor:pointer; margin-bottom: 10pt">
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
