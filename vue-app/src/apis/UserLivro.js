import Api from "./Api";

export default {
  adicionar(form) {
    return Api().post("/users/livros", form);
  },

  reservar(id) {
    return Api().put("/users/livros/" + id);
  }
};
