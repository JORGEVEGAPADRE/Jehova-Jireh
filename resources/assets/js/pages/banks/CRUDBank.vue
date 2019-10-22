<template>
<div>
  <form @submit.prevent="editBank(bank)" v-if="editActive">

    <h3>Editar Banco</h3>
    <input type="text" placeholder="Ingrese Nombre del Banco"
    class="form-control mb-2" v-model="bank.name_bank">

    <button type="submit" class="btn btn-success">Guardar</button>
    <button type="submit" class="btn btn-danger" @click="cancelEdition()">Cancelar</button>
     
  </form>

  <form @submit.prevent="createBank" v-else>

    <h3>Agregar Bancos</h3>
    <input type="text" placeholder="Nombre del Banco"
    class="form-control mb-2" v-model="bank.name_bank">           
           
    <button type="submit" class="btn btn-primary" @keyup.enter="addBank">Agregar</button>
      
  </form>

  <hr class="mt-3">

  <h3>Listado de Bancos</h3>
  
  <ul class="list-group my-2">          
    <li class="list-group-item" 
    v-for="(bank,index) in banks" :key="index">

    <span class="badge badge-primary float-right">      
             
    <!-- Creado el: {{moment(banco.updated_at).format('DD-MM-YY, h:mm:ss a')}}-->
      Creado el:{{bank.updated_at}}
    </span>

    <p>{{bank.id}}->{{bank.name_bank}}</p>

    <button class="btn btn-warning btn-sm" @click="editForm(bank)">Editar</button>
    <button class="btn btn-danger btn-sm" @click="deleteBank(bank,index)">Eliminar</button>
            
    </li>

  </ul>  

</template>

<script>

import moment from 'moment'
Vue.prototype.moment = moment
import swal from 'sweetalert';
 
import { mapGetters } from 'vuex'
//import { Form } from 'vform'

export default {
  name: 'crud-bank',  
  data(){
    return{
      banks:[],
      bank:{id:'', name_bank:''},
      editActive: false           
    }
},
created() {
  this.$store.dispatch("getBanks")
},
  computed: {
      ...mapGetters([
        'currentUser',
        'banks'
      ])
  }, 

methods: {
 agregarbanco(){  
               if(this.banco.name_bank.trim() === ''){
                 swal("Advertencia","El campo nombre no puede estar en blanco");                 
                 return;
               }             
               const params= this.banco;            
               
               this.banco={id:'',name_bank:''};                             
               axios.post('/bancos',params)
                  .then((res)=>{   
                                
                      this.bancos.push(res.data);
                  })
         },     
createBank() {
  if(this.bank.name_bank.trim() === ''){
    swal("Advertencia","El campo nombre no puede estar en blanco");
    return;
  } 
  
  const params= this.bank;
  this.bank={id:'',name_bank:''};  
                 
  axios.post('/api/banks',params.name_bank)
  .then(res=>{
      
      this.$store.dispatch('addBank', res.data)
      this.$toasted.success(data.msg)
   //this.bancos.push(res.data)
  })
  .catch((error) => {
              // console.log(error)
    })
}, 

editBank(bank) {   
  this.$store.dispatch("editBank", bank).then((response) => {
    this.$toasted.success(response.data.msg)
        }).then(() => {
          this.editActive = false;  
          const index = this.bank.findIndex(bankFind => bankFind.id === res.data.id);
          this.bank[index] = res.data;
        })
},

deleteBank(bank) {  
  this.$store.dispatch("deleteBank", bank).then((response) => {
    this.$toasted.success(response.data.msg)
        }).then(() => {
          this.loading = false
        })
},

cancelEdition(){
  this.editActive = false;
  this.bank={id:'',name_bank:''};
},

editForm(bank){
  this.editActive = true;  
  this.bank.name_bak = bank.name_bank;          
  this.bank.id = bank.id;          
}
    
}
}
</script>
