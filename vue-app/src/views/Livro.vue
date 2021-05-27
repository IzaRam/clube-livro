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

export default {
  data() {
    return {
      livro: null
    };
  },

  mounted() {
	const id = "" +  this.$route.params.id;
	Livro.getLivro(id).then(response => {
		this.livro = response.data;
	});
  }
};
</script>
