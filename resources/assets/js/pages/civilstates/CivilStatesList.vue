<template>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-offset-2">
         
        <AddCivilStatesForm/>
        <p class="no-results" v-show="!civilstates.length">No Existen Estados Civiles Registrados</p>
        <div class="row mt-5">
                      
          <table class="table table-bordered table-striped">
            <thead>
              <tr>                
                                                    
                <th class="text-center bg-info text-light">Descripcion del Estado Civil</th>                                  
                <th class="text-center bg-info text-light">Acciones</th>
             </tr>    
           </thead>
           <tbody>
             <tr class="text-center" v-for="(civilstate,index) in civilstates" :key="index">                                
                                           
              <td>{{civilstate.statedescription}}</td>
              <td>
                <div class="btn-group" role="group">                          
                  <a href="#myModal" data-toggle="modal" data-target="#myModal" title="Editar" @click="setActionEdit(civilstate)" class="text-success"><i class="fas fa-edit"></i></a>   
                  <a href="#myModal" data-toggle="modal" data-target="#myModal" title="Eliminar" @click="setActionDelete(civilstate)" class="text-danger"><i class="fas fa-trash-alt"></i></a>      
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
          <button type="button" class="close" data-dismiss="modal" v-if="civilstate.statedescription">X</button>        
            
          <h4 class="modal-title">{{actionTitle}}</h4>
        </div>
        <div class="modal-body">         
          <input type="text" v-if="action" v-model="civilstate.statedescription" class="form-control">
          <label class="form-control" v-else>{{civilstate.statedescription}}</label>
        </div>

        <div class="modal-footer">
          <button id="sb" name="sb" type="button" class="btn btn-danger" v-if="action" @click="editCivilState(civilstate)">Confirmar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal" v-else @click="deleteCivilState(civilstate)">Confirmar</button>
          <button type="button" class="btn btn-success"  @click="hideModal(0)">Cancelar</button>
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
  import AddCivilStatesForm from './AddCivilStatesForm.vue';
  import fontawesome from '@fortawesome/fontawesome-free';
  import swal from 'sweetalert';

  export default {
    name: 'civil-states-list',
    
  //  name_bank:'',
    components: {
      AddCivilStatesForm
    },
    data:() => {
      return { 
        civilstate:{id:'',statedescription:''},             
        loading: false,        
        action: '',        
        actionTitle: 'Editar Estado Civil',
        oldstatedescription:'',
        payload: 1    
            
      }
    },
   created() {
      this.$store.dispatch("getCivilStates")
    }, 
    computed: {
      ...mapGetters([
        'currentUser',
        'civilstates'
      ])
    },
    methods: {
      hideModal(payload) { 
        if(payload===0){  
          this.civilstate.statedescription=this.oldstatedescription;
        }         
         $("#myModal").modal("hide");              
      },  
          
      setActionEdit(civilstate) {
        this.oldstatedescription=civilstate.statedescription;      
        this.civilstate=civilstate;               
        this.action = true;      
        this.actionTitle='Editar Estado Civil';               
      },
      setActionDelete(civilstate) {
              
        this.civilstate=civilstate;               
        this.action = false;        
        this.actionTitle='Eliminar Estado Civil';               
      },
      editCivilState(civilstate) {                
        this.loading = true
        if (civilstate.statedescription){
          this.$store.dispatch("editCivilState", civilstate).then((response) => {        
        let msg=response.data.msg;
         swal({
              icon: "success",              
              title:'Operacion Exitosa!!!',
              text: msg,              
              button: true,              
              position:'bottom-end'
            }); 
        }).catch((errors) => {
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

        }else{             
            civilstate.statedescription=this.oldstatedescription
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
      deleteCivilState(civilstate) {
        this.loading = true
        this.$store.dispatch("deleteCivilState", civilstate).then((response) => {
        //  this.$toasted.success(response.data.msg)
        let msg=response.data.msg;
         swal({
              icon: "success",              
              title:'Operacion Exitosa!!!',
              text: msg,              
              button: true,              
              position:'bottom-end'
            }); 
        }).catch((errors) => {
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
