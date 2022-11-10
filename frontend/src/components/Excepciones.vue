<template>
  <div>
    <h1 class="title">Excepciones generadas</h1>
    <input v-model="fecha_1" type="date" name="fecha_1" id="fecha_1"/>
    &nbsp;
    <input v-model="fecha_2" type="date" name="fecha_2" id="fecha_2"/>
    &nbsp;
    <button @click="getExcepcionesFilter()" class="button is-primary">Filtrar</button>
    &nbsp;
    <router-link :to="{ name: 'FuncionarioList' }" class="button is-primary"
      >Cancelar</router-link>
    <table class="table is-striped is-fullwidth">
      <thead>
        <tr>
          <th>Descripción</th>
          <th>Código</th>
          <th>Fecha de generación</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="excepcion in excepciones.excepciones" :key="excepcion.id">
          <td>{{ excepcion.descripcion }}</td>
          <td>{{ excepcion.codigo }}</td>
          <td>{{ excepcion.fecha_generacion }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
 
<script>
import axios from "axios";
 
export default {
  name: "Excepcion",
  data() {
    return {
      fecha_1: "",
      fecha_2: "",
      excepciones: [],      
    };
  },
  created() {    
    this.getExcepciones();
  },
  methods: {
    async getExcepciones() {
      try {        
        const get_token = await axios.get("http://localhost:8080/auth/generate");
        
        const response = await axios.request({
          url: 'http://localhost:8080/excepcion',
          method: 'get',
          headers: {
            'Authorization': 'Bearer ' + get_token.data['access_token']
          } 
        })
        this.excepciones = response.data;
      } catch (error) {
        console.log(error);
      }
    },

    async getExcepcionesFilter() {
      try {
        const get_token = await axios.get("http://localhost:8080/auth/generate");
        
        const response = await axios.request({
          url: 'http://localhost:8080/excepcion/filterDate',
          method: 'post',
          data: {
              fecha_1: this.fecha_1,
              fecha_2: this.fecha_2
          },
          headers: {
            'Authorization': 'Bearer ' + get_token.data['access_token']
          } 
        });
        this.excepciones = response.data;        
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>
 
<style>
</style>