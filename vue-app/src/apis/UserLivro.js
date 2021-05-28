import Api from "./Api";

export default {
  adicionar(form) {
    return Api().post("/livros/user", form);
  },

  reservar(form) {
    return Api().post("/", form);
  },

  getUsersLivro(id) {
    return Api().get("/livros/user/" + id);
  }
};
