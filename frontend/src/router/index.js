import { createRouter, createWebHistory } from 'vue-router'
import FuncionarioList from '../views/FuncionarioList.vue'
import AddFuncionario from '../views/AddFuncionario.vue'
import ExcepcionList from '../views/ExcepcionList.vue'

const routes = [
  {
    path: '/',
    name: 'FuncionarioList',
    component: FuncionarioList
  },
  {
    path: '/add',
    name: 'AddFuncionario',
    component: AddFuncionario
  },
  {
    path: '/excepciones',
    name: 'ExcepcionList',
    component: ExcepcionList
  },
]
 
const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})
 
export default router
