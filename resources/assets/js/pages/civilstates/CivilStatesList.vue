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
                <th class="text-center bg-info text-light">ID</th>                                    
                <th class="text-center bg-info text-light">Descripcion del Estado Civil</th>                                  
                <th class="text-center bg-info text-light">Acciones</th>
             </tr>    
           </thead>
           <tbody>
             <tr class="text-center" v-for="(civilstate,index) in civilstates" :key="index">                                
              <td>{{civilstate.id}}</td>                                 
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
          <button type="button" class="close" data-dismiss="modal">&times;</button>        
            
          <h4 class="modal-title">{{actionTitle}}</h4>
        </div>
        <div class="modal-body">         
          <input type="text" v-if="action" v-model="civilstate.statedescription" class="form-control">
          <label class="form-control" v-else>{{civilstate.statedescription}}</label>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal" v-if="action" @click="editCivilState(civilstate)">Confirmar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal" v-else @click="deleteCivilState(civilstate)">Confirmar</button>
          <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
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
 
  
  import { mapGetters } from 'vuex'
  import AddCivilStatesForm from './AddCivilStatesForm.vue'
  import fontawesome from '@fortawesome/fontawesome-free'

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
          
      setActionEdit(civilstate) {
              
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
        this.$store.dispatch("editCivilState", civilstate).then((response) => {
          this.$toasted.success(response.data.msg)
        }).then(() => {
          this.loading = false
        })
      },          
      deleteCivilState(civilstate) {
        this.loading = true
        this.$store.dispatch("deleteCivilState", civilstate).then((response) => {
          this.$toasted.success(response.data.msg)
        }).then(() => {
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
