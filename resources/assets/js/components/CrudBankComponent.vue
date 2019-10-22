<template>
  <div>      
      <form @submit.prevent="editarBanco(banco)" v-if="editarActivo">
          <h3>Editar Banco</h3>
          <input type="text" placeholder="Nombre del Banco"
           class="form-control mb-2" v-model="banco.name_bank">           
           <button type="submit" class="btn btn-success">Guardar</button>
           <button type="submit" class="btn btn-danger" @click="cancelarEdicion()">Cancelar</button>
      </form>

      <form @submit.prevent="agregarbanco" v-else>
          <h3>Agregar Bancos</h3>
          <input type="text" placeholder="Nombre del Banco"
           class="form-control mb-2" v-model="banco.name_bank">           
           <button type="submit" class="btn btn-primary" @keyup.enter="agregarbanco">Agregar</button>
      </form>

      <hr class="mt-3">
      <h3>Listado de Bancos</h3>
      <ul class="list-group my-2">
          <li class="list-group-item" 
          v-for="(banco,index) in bancos" :key="index">
            <span class="badge badge-primary float-right">      
             
             <!-- Creado el: {{moment(banco.updated_at).format('DD-MM-YY, h:mm:ss a')}}-->
              Creado el:{{banco.updated_at}}
            </span>
            <p>{{banco.id}}->{{banco.name_bank}}</p>
            <button class="btn btn-warning btn-sm" @click="editarFormulario(banco)">Editar</button>
            <button class="btn btn-danger btn-sm" @click="eliminarBanco(banco,index)">Eliminar</button>
            
          </li>
      </ul>        
  </div>    
</template>

<script>
   // import moment from 'moment'
   // Vue.prototype.moment = moment
    import swal from 'sweetalert';
    export default {       
       data(){
           return{
          //     bancos:[],
               banco:{id:'',name_bank:''},
               editarActivo: false
           }
       },
       created(){
         this.$store.dispatch("getBanks")
        // axios.get('/api/banks')
        //   .then(res=>{               
        //       this.bancos=res.data;               
        //   })
       },

       methods:{
        agregarbanco(){  
               if(this.banco.name_bank.trim() === ''){
                 swal("Advertencia","El campo nombre no puede estar en blanco");                 
                 return;
               }             
               const params= this.banco;            
               
               this.banco={id:'',name_bank:''};                             
               axios.post('/api/banks',params)
                  .then((res)=>{
                      this.$store.dispatch('addBank', data.data)          
                      this.bancos.push(res.data);
                  })
         }, 
        
        editarBanco(banco){
          
          const params = {id: this.banco.id, name_bank: this.banco.name_bank};
          
          console.log(params);
          axios.put(`bank/${params.id}`, params)
          .then(res=>{
          this.editarActivo = false;
          const index = this.bancos.findIndex(banco => this.banco.id === banco.id);
          this.bancos[index] = res.data;
          this.banco={id:'',name_bank:''};
                 
        })
        },         
        
         eliminarBanco(banco,index){           
           const params = {id: banco.id, name_bank:banco.name_bank};
           const confirmacion = confirm(`Eliminar banco ${params.name_bank}`);
           if(confirmacion){
             axios.delete(`bank/${params.id}`)
             .then((res)=>{
                this.bancos.splice(index, 1);
                                             
             })
           }
         },
         cancelarEdicion(){
            this.editarActivo = false;
            this.banco={id:'',name_bank:''};
        },

         editarFormulario(banco){
          this.editarActivo = true;  
          this.banco.name_bank = banco.name_bank;          
          this.banco.id = banco.id;          
        }
       }

         
    }
</script>
