<template>
  <div>
    <h1 class="title">Lista de funcionarios</h1>
    <router-link :to="{ name: 'AddFuncionario' }" class="button is-primary"
      >Crear Nuevo</router-link
    >
    &nbsp;
    <router-link :to="{ name: 'ExcepcionList' }" class="button is-primary"
      >Ver Excepciones</router-link
    >
    <table class="table is-striped is-fullwidth">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Telefono</th>
          <th>Identificacion</th>
          <th>Fecha Nacimiento</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="funcionario in funcionarios.funcionarios" :key="funcionario.id">
          <td>{{ funcionario.nombre }}</td>
          <td>{{ funcionario.apellido }}</td>
          <td>{{ funcionario.telefono }}</td>
          <td>{{ funcionario.identificacion }}</td>
          <td>{{ funcionario.fecha_nacimiento }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
 
<script>
import axios from "axios";
 
export default {
  name: "Funcionario",
  data() {
    return {
      funcionarios: [],      
    };
  },
  created() {    
    this.getFuncionarios();
  },
  methods: {
    async getFuncionarios() {
      try {        
        const get_token = await axios.get("http://localhost:8080/auth/generate");
        
        const response = await axios.request({
          url: 'http://localhost:8080/funcionario',
          method: 'get',
          headers: {
            'Authorization': 'Bearer ' + get_token.data['access_token']
          } 
        })
        this.funcionarios = response.data;
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>
 
<style>
</style>