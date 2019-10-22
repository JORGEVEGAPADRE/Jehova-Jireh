<template>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-offset-2">
         
        <AddJobStatesForm/>
        <p class="no-results" v-show="!jobstates.length">No Hay Situaciones Laborales Registradas</p>
        <div class="row mt-5">
                      
          <table class="table table-bordered table-striped">
            <thead>
              <tr>                
                <th class="text-center bg-info text-light">ID</th>                                    
                <th class="text-center bg-info text-light">Descripcion de la Situacion Laboral</th>                                  
                <th class="text-center bg-info text-light">Acciones</th>
             </tr>    
           </thead>
           <tbody>
             <tr class="text-center" v-for="(jobstate,index) in jobstates" :key="index">                                
              <td>{{jobstate.id}}</td>                                
              <td>{{jobstate.jobdescription}}</td>
              <td>
                <div class="btn-group" role="group">                          
                  <a href="#myModal" data-toggle="modal" data-target="#myModal" title="Editar" @click="setActionEdit(jobstate)" class="text-success"><i class="fas fa-edit"></i></a>   
                  <a href="#myModal" data-toggle="modal" data-target="#myModal" title="Eliminar" @click="setActionDelete(jobstate)" class="text-danger"><i class="fas fa-trash-alt"></i></a>      
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
          <input type="text" v-if="action" v-model="jobstate.jobdescription" class="form-control">
          <label class="form-control" v-else>{{jobstate.jobdescription}}</label>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal" v-if="action" @click="editJobState(jobstate)">Confirmar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal" v-else @click="deleteJobState(jobstate)">Confirmar</button>
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
  import  AddJobStatesForm from './AddJobStatesForm.vue'
  import fontawesome from '@fortawesome/fontawesome-free'

  export default {
    name: 'job-states-list',
    
  //  name_bank:'',
    components: {
      AddJobStatesForm
    },
    data:() => {
      return { 
        jobstate:{id:'', jobdescription:'',user_id:''},       
        loading: false,        
        action: '',        
        actionTitle: 'Editar Situacion Laboral',
            
      }
    },
    created() {
      this.$store.dispatch("getJobStates")
    },
    computed: {
      ...mapGetters([
        'currentUser',
        'jobstates'
      ])
    },
    methods: {  
          
      setActionEdit(jobstate) {
              
        this.jobstate=jobstate;               
        this.action = true;      
        this.actionTitle='Editar Situacion Laboral';               
      },
      setActionDelete(jobstate) {
              
        this.jobstate=jobstate;               
        this.action = false;        
        this.actionTitle='Eliminar Situacion Laboral';               
      },
      editJobState(jobstate) {                
        this.loading = true
        this.$store.dispatch("editJobState", jobstate).then((response) => {
          this.$toasted.success(response.data.msg)
        }).then(() => {
          this.loading = false
        })
      },          
      deleteJobState(jobstate) {
        this.loading = true
        this.$store.dispatch("deleteJobState", jobstate).then((response) => {
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
