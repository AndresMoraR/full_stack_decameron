<template>
  <div>
    <h1 class="title">Crear Funcionario</h1>
    <form @submit.prevent="saveFuncionario">
      <div class="field">
        <label class="label">Nombre</label>
        <div class="control">
          <input
            type="text"
            v-model="nombre"
            class="input"
            placeholder="Nombre"
          />
        </div>
      </div>
      <div class="field">
        <label class="label">Apellido</label>
        <div class="control">
          <input
            type="text"
            v-model="apellido"
            class="input"
            placeholder="Apellido"
          />
        </div>
      </div>
      <div class="field">
        <label class="label">Telefono</label>
        <div class="control">
          <input
            type="text"
            v-model="telefono"
            class="input"
            placeholder="Telefono"
          />
        </div>
      </div>
      <div class="field">
        <label class="label">Identificacion</label>
        <div class="control">
          <input
            type="text"
            v-model="identificacion"
            class="input"
            placeholder="Identificacion"
          />
        </div>
      </div>
      <div class="field">
        <label class="label">Fecha de nacimiento</label>
        <div class="control">
          <input
            type="text"
            v-model="fecha_nacimiento"
            class="input"
            placeholder="Fecha de nacimiento AAAA-MM-DD"
          />
        </div>
      </div>
      <div class="field">
        <div class="control">
          <button class="button is-primary">Save</button>
          &nbsp;
          <router-link :to="{ name: 'FuncionarioList' }" class="button is-primary"
            >Cancelar</router-link>
        </div>
      </div>
      <div class="field">
        <ul id="example-1">
          <li v-for="validacion in validaciones" :key="validacion.id">
            {{ validacion }}
          </li>
        </ul>      
      </div>
    </form>
  </div>
</template>
 
<script>
import axios from "axios";
 
export default {
  name: "AddForm",
  data() {
    return {
      nombre: "",
      apellido: "",
      telefono: "",
      identificacion: "",
      fecha_nacimiento: "",
      validaciones: [],
    };
  },
  methods: {
    async saveFuncionario() {
      try {
        const get_token = await axios.get("http://localhost:8080/auth/generate");
        
        const response = await axios.request({
          url: 'http://localhost:8080/funcionario/store',
          method: 'post',
          data: {
              nombre: this.nombre,
              apellido: this.apellido,
              telefono: this.telefono,
              identificacion: this.identificacion,
              fecha_nacimiento: this.fecha_nacimiento,
          },
          headers: {
            'Authorization': 'Bearer ' + get_token.data['access_token']
          } 
        });
        this.validaciones = response.data;        
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>
 
<style>
</style>