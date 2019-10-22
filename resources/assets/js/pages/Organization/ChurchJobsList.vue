<template>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-offset-2">         
        <AddChurchJobsForm/>
        <p class="no-results" v-show="!churchjobs.length">No Hay Cargos Eclesiasticos Registrados</p>
        <div class="row mt-5">                      
          <table class="table table-bordered table-striped">
            <thead>
              <tr>                
                <th class="text-center bg-info text-light">ID</th>                                    
                <th class="text-center bg-info text-light">Descripcion del Cargo</th>
                <th class="text-center bg-info text-light">Jerarquia</th>                                  
                <th class="text-center bg-info text-light">Acciones</th>
             </tr>    
           </thead>
           <tbody>
             <tr class="text-center" v-for="(churchjob,index) in churchjobs" :key="index">                                
              <td>{{churchjob.id}}</td>                                
              <td>{{churchjob.churchjob}}</td>
              <td>{{churchjob.level}}</td> 
              <td>
                <div class="btn-group" role="group">                          
                  <a href="#stack1" data-toggle="modal" data-target="#stack1" title="Editar" @click="setActionEdit(churchjob)" class="text-success"><i class="fas fa-edit"></i></a>   
                  <a href="#stack1" data-toggle="modal" data-target="#stack1" title="Eliminar" @click="setActionDelete(churchjob)" class="text-danger"><i class="fas fa-trash-alt"></i></a>      
					      </div> 
              </td>
             </tr>    
           </tbody>
          </table>
      </div>


<div id="stack1" role="dialog" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
  <div class="modal-dialog modal-dialog-scrollable" > 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        <h4 class="modal-title">{{actionTitle}}</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <button class="btn btn-success" style= "float: right;" data-toggle="modal" href="#stack2" v-show="churhjobs.length" @click="setAccountEdit(account,0,churchjob.id)">
            <i class="fas fa-piggy-bank"></i>&nbsp;&nbsp;Asignar Cargo            
			      </button>
          </div>
        </div>
        &nbsp;
        <input class="form-control" type="text" v-if="action" v-model="churchjob.churchjob" data-tabindex="1">
        <label class="form-control" v-else>{{churchjob.churchjob}}</label>
        &nbsp; &nbsp;
      <!--
      <div class="container-fluid" v-if="churchjobs.length>0" >   
        <table class="table table-bordered table-striped">
          <thead>
            <tr> 
              <th class="text-center bg-info text-light">ID</th>                                    
              <th class="text-center bg-info text-light">Numero de Cuenta</th>
              <th class="text-center bg-info text-light">Fecha Apertura</th>                                  
              <th class="text-center bg-info text-light">Monto Apertura</th> 
              <th class="text-center bg-info text-light">Acciones</th>
            </tr>    
          </thead>
          <tbody>             
            <tr class="text-center" v-for="(account,index) in accounts" :key="index">
              <td>{{account.id}}</td>                                
              <td>{{account.accountnumber}}</td>
              <td>{{account.created_at | myDate}}</td>
              <td>{{account.openamount}}</td>                         
              <td> 
                <div class="btn-group" role="group">               
                                          
                  <a href="#stack2" data-toggle="modal" data-target="#stack2" title="Editar Cuenta" @click="setAccountEdit(account,1,bank.id)" class="text-success"><i class="fas fa-edit"></i></a>   
                  <a href="#stack2" data-toggle="modal" data-target="#stack2" title="Eliminar Cuenta" @click="setAccountDelete(account)" class="text-danger"><i class="fas fa-trash-alt"></i></a>      
					      </div> 
              </td>
            </tr>                
          </tbody>  
         </table>
        </div> 
        -->       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" v-if="action" @click="editChurchJob(churchjob)">Confirmar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" v-else @click="deleteChurchJob(churchjob)">Confirmar</button>
        <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>        
      </div>
    </div>
  </div>    
</div> -->

<!--
<div id="stack2" role="dialog" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
  <div class="modal-dialog modal-dialog-scrollable" > 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">{{accountTitle}}</h4>
      </div>
      <div class="modal-body">
        
        <label>Nombre del Banco</label>
        <label class="form-control">{{bank.namebank}}</label>       
        
        <label>Numero de Cuenta</label>
        <input class="form-control" type="text" v-if="actionAccount" v-model="account.accountnumber">
        <label class="form-control" v-else>{{account.accountnumber}}</label>
       
        <label>Fecha Apertura</label>        
        <datepicker :value="account.created_at" v-if="actionAccount" v-model="account.created_at" :language="es"></datepicker>
        <label class="form-control" v-else>{{account.created_at}}</label>
        
        <label>Monto Apertura</label>
        <input class="form-control" type="number" v-model="account.openamount"  v-if="actionAccount">
        <label class="form-control" v-else>{{account.openamount}}</label>                
      </div>
      &nbsp;
      <div class="modal-footer">
        
        <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" href="#stack1" v-if="actionAccount" @click="addEditAccount(account,1)">Confirmar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" href="#stack1" v-else @click="deleteAccount(account)">Seguro Eliminar la Cuenta?</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
               
      </div>
    </div>
  </div>    
</div>
-->

     
    </div>
  </div>
</div>


 
 
</template>


<script>
 
  
  import { mapGetters } from 'vuex'
  import AddChurchJobsForm from './AddChurchJobsForm.vue'
  import fontawesome from '@fortawesome/fontawesome-free'
  import Datepicker from 'vuejs-datepicker'
  import {es} from 'vuejs-datepicker/dist/locale'
  export default {
    name: 'church-jobs-list',
    components: {AddChurchJobsForm, Datepicker},
    data:() => {
      return { 
        churchjob:{id:'', churchjob:'', level:1},       
        loading: false,        
        action: '',
        actionAccount: true,        
        actionTitle: 'Editar Cargo',
        accountTitle: '',        
        idbank:0,
        payload:0,
        es:es
                         
      }
    },
   
    created() {
      this.$store.dispatch("getChurchJobs")
    },
    computed: {
      ...mapGetters([
        'currentUser',        
        'churchjobs'
      ])
    },
    methods: {             
      setActionEdit(churchjob) { 
       // console.log(churchjob.id); 
       // this.idchurchjob=churchjob.id                           
       // this.$store.dispatch("getWorkers",this.idchurchjob);
       // this.loading=false      
        
        this.churchjob=churchjob;               
        this.action = true;      
        this.actionTitle='Editar Cargo Eclesiastico';               
      }, 
      setActionDelete(churchjob) {
       // this.idchurchjob=churchjob.id                           
      //  this.$store.dispatch("getWorkers",this.idchurchjob);
       // this.loading=false
              
        this.churchjob=churchjob;               
        this.action = false;        
        this.actionTitle='Eliminar Cargo Eclesiastico';               
      },
      editChurchJob(churchjob) { 
          this.loading = true
         // this.$store.dispatch("getAccounts",bank);
          this.$store.dispatch("editChurchJob", churchjob).then((response) => {
          this.$toasted.success(response.data.msg)
          }).then(() => {
          this.loading = false
          })
       
      },         
       deleteChurchJob(churchjob) {
        this.loading = true
        this.$store.dispatch("deleteChurchJob", churchjob).then((response) => {
        this.$toasted.success(response.data.msg)
        }).then(() => {
          this.loading = false
        })
      }
     
      /*
      setAccountEdit(account,payload,id){
        this.account=account;               
        this.actionAccount = true;             
        if (payload==1){
          this.account.id=account.id;
          this.account.bank_id=id;
          this.account.accountnumber=account.accountnumber;
          this.account.openamount=account.openamount;
          this.account.created_at=account.created_at;
          this.accountTitle='Editar Cuenta'; 
        } else{          
          this.account.id='';
          this.account.bank_id=id;
          this.account.accountnumber='';
          this.account.openamount='';
          this.account.created_at='';
          this.accountTitle='Añadir Cuenta'; 
        }
      }, 
       setAccountDelete(account){
        this.account=account;               
        this.actionAccount = false;        
        this.accountTitle='Eliminar Cuenta'; 
      },
      
      addEditAccount(account,payload){
        
        console.log(payload);
        console.log(payload);   
        console.log(payload);   
        console.log(payload);   
        console.log(payload);          
        
        if (payload==1){
          this.$store.dispatch("editAccount", account).then((response) => {
          this.$toasted.success(response.data.msg)
          }).catch(error => {
            
          }).finally(() => {
        
          });
        }else{
          this.$store.dispatch('addAccount', account).then((response)=>{
          this.$toasted.success(response.data.msg)
          }).catch(error => {
            
          }).finally(() => {  

          });         
       } 
      }, 
      deleteAccount(account){
          this.$store.dispatch("deleteAccount", account).then((response) => {
          this.$toasted.success(response.data.msg);
          });
      },
      editBank(bank) { 
          this.loading = true
          this.$store.dispatch("getAccounts",bank);
          this.$store.dispatch("editBank", bank).then((response) => {
          this.$toasted.success(response.data.msg)
          }).then(() => {
          this.loading = false
          })
       
      },         
       deleteBank(bank) {
        this.loading = true
        this.$store.dispatch("deleteBank", bank).then((response) => {
        this.$toasted.success(response.data.msg)
        }).then(() => {
          this.loading = false
        })
      } */
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
