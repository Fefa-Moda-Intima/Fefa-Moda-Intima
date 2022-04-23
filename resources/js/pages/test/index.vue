<template>
  <div class="row">
    <div class="col-lg-10 m-auto">
      <card title="Área de testes">
        <h4 class="text-center">Ícones e botões:</h4>
        <div class="d-flex m-2 justify-content-around">
          <div
            class="d-flex flex-column align-items-center justify-content-center"
          >
            <button class="btn btn-primary rounded-pill">
              <router-link
                :to="{ name: 'register.dev' }"
                style="text-decoration: none; color: white;"
                active-class="active"
              >
                <fa icon="plus" fixed-width /> Cadastrar
              </router-link>
            </button>
            <p class="m-1 px-2 rounded-pill bg-secondary bg-opacity-10">
              Botão com label
            </p>
          </div>
          <div
            class="d-flex flex-column align-items-center justify-content-center"
          >
            <button class="btn btn-default">
              <router-link
                :to="{ name: 'register.dev' }"
                style="text-decoration: none;"
                active-class="active"
              >
                <fa icon="plus" fixed-width />
              </router-link>
            </button>
            <p class="m-1 px-2 rounded-pill bg-secondary bg-opacity-10">
              Botão sem enfeite
            </p>
          </div>
          <div
            class="d-flex flex-column align-items-center justify-content-center"
          >
            <button class="btn btn-danger rounded-pill">
              <fa icon="trash" fixed-width class="text-light" />
            </button>
            <p class="m-1 px-2 rounded-pill bg-secondary bg-opacity-10">
              Icon button
            </p>
          </div>
          <div class="align-center">
            <button class="btn position-relative p-1">
              <fa icon="shopping-cart" fixed-width class="text-md-start fs-5" />
              <span
                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger text-light"
              >
                1
              </span>
            </button>
            <button class="btn position-relative p-1">
              <fa icon="envelope" fixed-width class="text-md-start fs-5" />
              <span
                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger text-light"
              >
                1
              </span>
            </button>
            <button class="btn position-relative p-1">
              <fa icon="truck" fixed-width class="text-md-start fs-5" />
              <span
                class="position-absolute top-0 start-100 translate-middle badge rounded-pill text-light"
                style="background-color:#F4B84E"
              >
                <fa icon="bolt" fixed-width style="color: #F5FF4C" />
              </span>
            </button>
            <p class="m-1 px-2 rounded-pill bg-secondary bg-opacity-10">
              Ícones com badge
            </p>
          </div>
        </div>
        <h4 class="text-center">Tabela:</h4>
        <table class="table table-hover" style="cursor:pointer;">
          <thead>
            <tr>
              <th>Id</th>
              <th>Nome</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in items" :key="item.id">
              <td v-on:click="handleHi(item.id)">{{ item.id }}</td>
              <td v-on:click="handleHi(item.id)">{{ item.name }}</td>
              <td>
                <button class="btn btn-danger rounded-pill">
                  <fa icon="trash" fixed-width class="text-light" />
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </card>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      items: [
        {
          id: 1,
          name: "Leo"
        },
        {
          id: 2,
          name: "Cecis"
        }
      ]
    };
  },

  methods: {
    handleHi(id) {
      console.log("Hi with id: " + id);
    }
  }
};
</script>
