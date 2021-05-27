import Api from "./Api";

export default {
  getLivros() {
    return Api().get("/livros");
  },

  adicionar(form) {
    return Api().post("/livros", form);
  }
};
