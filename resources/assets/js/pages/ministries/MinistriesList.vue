<template>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-offset-2">
         
        <AddMinistriesForm/>
        <p class="no-results" v-show="!ministries.length">No Hay Ministerios Registrados</p>
        <div class="row mt-5">
                      
          <table class="table table-bordered table-striped">
            <thead>
              <tr>                
                                           
                <th class="text-center bg-info text-light">Descripcion del Ministerios</th>                                  
                <th class="text-center bg-info text-light">Acciones</th>
             </tr>    
           </thead>
           <tbody>
             <tr class="text-center" v-for="(ministry,index) in ministries" :key="index">                                
                                             
              <td>{{ministry.ministry}}</td>
              <td>
                <div class="btn-group" role="group">                          
                  <a href="#myModal" data-toggle="modal" data-target="#myModal" title="Editar" @click="setActionEdit(ministry)" class="text-success"><i class="fas fa-edit"></i></a>   
                  <a href="#myModal" data-toggle="modal" data-target="#myModal" title="Eliminar" @click="setActionDelete(ministry)" class="text-danger"><i class="fas fa-trash-alt"></i></a>      
					      </div> 
              </td>
             </tr>    
           </tbody>
          </table>               
   
      </div>
     
      <!--INICIO FORMULARIO MODAL USADO PARA EDITAR Y ELIMINAR -->
           <div class="container2">
  
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" v-if="ministry.ministry">X</button>      
            
          <h4 class="modal-title">{{actionTitle}}</h4>
        </div>
        <div class="modal-body">      

         <input type="text" v-if="action" v-model="ministry.ministry" class="form-control">
         <label class="form-control" v-else>{{ministry.ministry}}</label>
        </div>
        <div class="modal-footer">
          <button id="sb" name="sb" type="button" class="btn btn-danger" v-if="action" @click="editMinistry(ministry)">Confirmar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal" v-else @click="deleteMinistry(ministry)">Confirmar</button>
          <button type="button" class="btn btn-success" @click="hideModal(0)">Cancelar</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
     


     
        
  
      <!--FIN FORMULARIO MODAL USADO PARA EDITAR Y ELIMINAR -->
     
     
    </div>
  </div>
</div>


 
 
</template>
 
<script>
 
  
  import { mapGetters } from 'vuex';  
  import  AddMinistriesForm from './AddMinistriesForm.vue';
  import fontawesome from '@fortawesome/fontawesome-free';
  import swal from 'sweetalert';

  export default {
    name: 'ministries-list',
    
  //  name_bank:'',
    components: {
      AddMinistriesForm
    },
    data:() => {
      return { 
        ministry:{id:'', ministry:''},       
        loading: false,        
        action: '',        
        actionTitle: 'Editar Descripcion del Ministerio',
        oldministry:'',
        payload: 1            
      }
    },
    created() {
      this.$store.dispatch("getMinistries")
    },
    computed: {
      condition() {      
          let ministry=(this.ministry.ministry).length                    
          if (ministry>0 && this.action){               
              return true;
          }  
          if (ministry>0 && (!this.action)){               
              return false;
          }       
      },  
      ...mapGetters([
        'currentUser',
        'ministries'
      ])
    },
    methods: {          
      hideModal(payload) { 
        if(payload===0){  
          this.ministry.ministry=this.oldministry;
        }         
         $("#myModal").modal("hide");              
      },
           
      setActionEdit(ministry) {
        this.oldministry=ministry.ministry;      
        this.ministry=ministry;               
        this.action = true;      
        this.actionTitle='Editar Descripcion del Ministerio';               
      },
      setActionDelete(ministry) {
              
        this.ministry=ministry;               
        this.action = false;        
        this.actionTitle='Eliminar Descripcion del Ministerio';               
      },
      editMinistry(ministry) { 
          this.loading = true
          if (ministry.ministry){
          this.$store.dispatch("editMinistry", ministry).then((response) => {       
          let msg=response.data.msg;
          swal({
              icon: "success",              
              title:'Operacion Exitosa!!!',
              text: msg,              
              button: true,              
              position:'bottom-end'
          });
          }).catch((errors)=> {
            let msg="No se pudo realizar la actualizacion de Datos";
          swal({
              icon: "error",
              dangerMode: true,
              title:'ERROR!!!',
              text: msg,              
              button: true,              
              position:'bottom-end'
          });
          this.loading = false
        })
        }else{             
            ministry.ministry=this.oldministry
            swal({
              icon: "error",
              dangerMode: true,
              title:'ERROR!!!',
              text: 'La Descripcion del Ministerio es Requerida',              
              button: true,              
              position:'bottom-end'
          });
        }     
        this.hideModal(1);                    
        
      },          
      deleteMinistry(ministry) {
        this.loading = true
        this.$store.dispatch("deleteMinistry", ministry).then((response) => {        
        let msg=response.data.msg;
        swal({
              icon: "success",              
              title:'Operacion Exitosa!!!',
              text: msg,              
              button: true,              
              position:'bottom-end'
        }); 
        }).catch((errors)=> {
          let msg1="No se pudo realizar la actualizacion de Datos";
          swal({
              icon: "error",
              dangerMode: true,
              title:'ERROR!!!',
              text: msg1,              
              button: true,              
              position:'bottom-end'
          });
          this.loading = false
           
        })
      }
    }
  }
</script>
<style lang="scss" scoped>
.no-results {
  font-weight: bold;
  text-align: center;
}
.remove-icon {
  color: red;
}
.remove-icon:hover {
  opacity: 0.5;
}
</style>
