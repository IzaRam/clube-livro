import Api from "./Api";

export default {
  getLivros() {
    return Api().get("/livros");
  },

  getLivro(id) {
    return Api().get("/livros/" + id);
  },


  adicionar(form) {
    return Api().post("/livros", form);
  }
};
