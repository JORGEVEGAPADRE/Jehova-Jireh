<template>  
    <div class="banks">         
       <div class="form-control">
          <AddBanksForm/>
       </div> 
        <p class="no-results" v-show="!banks.length">No Hay Bancos Registrados</p>
        <div class="tableFilters">
            <div class="control">
              <div class="row">                  
                  <div class="col-md-3">
                    <div class="select">
                      <select v-model="tableData.length" @change="getBanks()">
                        <option v-for="(records, index) in perPage" :key="index" :value="records">{{records}}</option>
                      </select>
                    </div>                    
                  </div>                
                  <div class="col-md-9">
                    <input class="input" type="text" v-model="tableData.search" placeholder="Buscar"
                    @input="getBanks()"><i class="fa fa-search"></i>
                  </div>                    
                </div> 
            </div>
        </div>
        <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
            <tbody>
                <tr v-for="bank in banks" :key="bank.id">                    
                    <td>{{bank.namebank}}</td> 
                    <td>
                      <div class="btn-group" role="group">                          
                        <a href="#stack1" data-toggle="modal" data-target="#stack1" title="Editar" @click="setActionEdit(bank)" class="text-success"><i class="fas fa-edit"></i></a>   
                        <a href="#stack1" data-toggle="modal" data-target="#stack1" title="Eliminar" @click="setActionDelete(bank)" class="text-danger"><i class="fas fa-trash-alt"></i></a>
                      </div> 
                    </td>                   
                </tr>
            </tbody>
            
        </datatable>
        <pagination :pagination="pagination"
                    @prev="getBanks(pagination.prevPageUrl)"
                    @next="getBanks(pagination.nextPageUrl)">
        </pagination>
       <!--Inicio Modal Editar Eliminar -->
  <div id="stack1" role="dialog" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
  <div class="modal-dialog modal-dialog-scrollable" > 
    <div class="modal-content">
      <div class="modal-header">        
        <button type="button" class="close" data-dismiss="modal" v-if="bank.namebank" aria-hidden="true">X</button>
        <h4 class="modal-title">{{actionTitle}}</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <button class="btn btn-success" style= "float: right;" data-toggle="modal" href="#stack2" v-show="banks.length" @click="setAccountEdit(0,bank.id)">
            <i class="fas fa-piggy-bank"></i>&nbsp;&nbsp;Agregar Cuenta            
			      </button>
          </div>
        </div>
        &nbsp;
        <input class="form-control" type="text" v-if="action" v-model="bank.namebank" data-tabindex="1">
        <label class="form-control" v-else>{{bank.namebank}}</label>
        &nbsp; &nbsp;
      <p class="no-results" v-show="!accounts.length">Este Banco No Tiene Cuentas Registradas</p>  
      <div class="container-fluid" v-if="accounts.length>0" >   
        <table class="table table-bordered">
          <thead>
            <tr>                                                   
              <th class="text-center bg-info text-light">Numero de Cuenta</th>
              <th class="text-center bg-info text-light">Fecha Apertura</th>                                  
              <th class="text-center bg-info text-light">Monto Apertura</th> 
              <th class="text-center bg-info text-light">Acciones</th>
            </tr>    
          </thead>
          <tbody>             
            <tr class="text-center" v-for="(account,index) in accounts" :key="index">
                                              
              <td>{{account.accountnumber}}</td>
              <td>{{account.created_at | myDate}}</td>
              <td>{{account.openamount}}</td>                         
              <td> 
                <div class="btn-group" role="group">
                  
                 <!-- <a href="#stack1" data-toggle="modal" data-target="#stack1" title="Movimientos" @click="setActionEdit(bank)" class="text-success"><i class='fas fa-money-bill-wave' style='color:red'></i></a>-->                          
                  <a href="#stack2" data-toggle="modal" data-target="#stack2" title="Editar Cuenta" @click="setAccountEdit(1,account.id)" class="text-success"><i class="fas fa-edit"></i></a>   
                  <a href="#stack2" data-toggle="modal" data-target="#stack2" title="Eliminar Cuenta" @click="setAccountDelete(account)" class="text-danger"><i class="fas fa-trash-alt"></i></a>      
					      </div> 
              </td>
            </tr>                
          </tbody>  
         </table>
        </div>        
      </div>
      <div class="modal-footer">
        <button id="sb" name="sb" type="button" class="btn btn-danger" v-if="action" @click="editBank(bank)">Confirmar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" v-else @click="deleteBank(bank)">Confirmar</button>
        <button type="button" class="btn btn-success" @click="hideModal(0)">Cancelar</button>        
      </div>
    </div>
  </div>    
</div>
<!--FIN MODAL STACK1 -->
<!--INICIO MODAL STACK2 -->
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
        
        <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" href="#stack1" v-if="actionAccount" @click="addEditAccount(account,payload)">Confirmar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" href="#stack1" v-else @click="deleteAccount(account)">Seguro Eliminar la Cuenta?</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
               
      </div>
    </div>
  </div>    
</div>

<!--FIN MODAL STACK2 -->
</div> 
</template>
<script>
import AddBanksForm from './AddBanksForm.vue';
import Datatable from '../../components/Datatable.vue';
import Pagination from '../../components/Pagination.vue';
import fontawesome from '@fortawesome/fontawesome-free';
import Datepicker from 'vuejs-datepicker';
import {es} from 'vuejs-datepicker/dist/locale'; 
import swal from 'sweetalert';
import { mapGetters} from 'vuex';
export default {
    name: 'banks-list',
    components: { datatable: Datatable, pagination: Pagination, AddBanksForm, Datepicker },    
    data() {
        let sortOrders = {};

        let columns = [
            //{width: '5%', label: 'Id', name: 'id', type: 'number' },
            {width: '75%', label: 'Nombre del Banco', name: 'namebank', type: 'string'},
            {width: '24%', label: 'Acciones'}
        ];

        columns.forEach((column) => {
           sortOrders[column.name] = -1;
        });
        return {
            banks: [],
            oldnamebank:'',
            payload2: 1,  
            bank:{id:'', namebank:''},            
            loading: false,        
            action: '',
            es:es,
            actionAccount: true,        
            actionTitle: 'Editar Banco',
            accountTitle: '',
            account:{id:'',bank_id:'',openamount:'',accountnumber:'',created_at:''},
            idbank:0,
            payload:0,
            columns: columns,
            sortKey: 'namebank',
            sortOrders: sortOrders,
            perPage: ['5', '10', '15'],
            tableData: {
                draw: 0,
                length: 10,
                search: '',
                column: 0,
                dir: 'asc',
            },
            pagination: {
                lastPage: '',
                currentPage: '',
                total: '',
                lastPageUrl: '',
                nextPageUrl: '',
                prevPageUrl: '',
                from: '',
                to: ''
            },
        }
    },
    computed: { 
    ...mapGetters([
        'currentUser',
        //'banks',
        //'pagination',        
        'accounts'
      ])
    },
    created() {
        this.getBanks();
    },
    methods: {
        hideModal(payload2) { 
        if(payload2===0){  
          this.bank.namebank=this.oldnamebank;
        }         
         $("#stack1").modal("hide");              
      },        
        getBanks(url = '/api/banks') {
            this.tableData.draw++;
            axios.get(url, {params: this.tableData})
                .then(response => {
                    let data = response.data;
                    if (this.tableData.draw == data.draw) {
                        this.banks = data.data.data;
                        this.configPagination(data.data);
                    }
                })
                .catch(errors => {
                    console.log(errors);
                });
        },        
        setActionEdit(bank) { 
         
        this.idbank=bank.id;
        this.oldnamebank=bank.namebank;                           
        this.$store.dispatch("getAccounts",this.idbank);
        this.loading=false      
        
        this.bank=bank;               
        this.action = true;      
        this.actionTitle='Editar Banco';               
      },
      setActionDelete(bank) {
        this.idbank=bank.id                           
        this.$store.dispatch("getAccounts",this.idbank);
        this.loading=false
              
        this.bank=bank;               
        this.action = false;        
        this.actionTitle='Eliminar Banco';               
      },
     
      editBank(bank) { 
          this.loading = true
          if (bank.namebank){
            this.$store.dispatch("getAccounts",bank);  
            this.$store.dispatch("editBank", bank).then((response) => {       
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
            bank.namebank=this.oldnamebank
            swal({
              icon: "error",
              dangerMode: true,
              title:'ERROR!!!',
              text: 'La Descripcion del Banco es Requerida',              
              button: true,              
              position:'bottom-end'
          });
        }     
        this.hideModal(1);                    
        
      },
      deleteBank(bank) {
        this.loading = true
        this.$store.dispatch("deleteBank", bank).then((response) => {
        //this.$toasted.success(response.data.msg);        
        let msg=response.data.msg;        
          swal({
              icon: "success",              
              title:'Operacion Exitosa!!!',
              text: msg,              
              button: true,              
              position:'bottom-end'
            }); 
            this.getBanks();  
            this.loading = false;          
     
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
        })
      },
      setAccountEdit(payload,id){
        console.log(payload,id);
                      
        this.actionAccount = true;             
        if (payload==1){
          this.account=account; 
          this.account.id=account.id;
          this.account.bank_id=id;
          this.account.accountnumber=account.accountnumber;
          this.account.openamount=account.openamount;
          this.account.created_at=account.created_at;
          this.accountTitle='Editar Cuenta';
          payload=1; 
        } else{          
          this.account.id='';
          this.account.bank_id=id;
          this.account.accountnumber='';
          this.account.openamount='';
          this.account.created_at='';
          this.accountTitle='Añadir Cuenta';
          payload=0; 
        }
      },
       setAccountDelete(account){
        this.account=account;               
        this.actionAccount = false;        
        this.accountTitle='Eliminar Cuenta'; 
      },
      
      addEditAccount(account,payload){
        console.log("JGVO---",payload);
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
        configPagination(data) {
            this.pagination.lastPage = data.last_page;
            this.pagination.currentPage = data.current_page;
            this.pagination.total = data.total;
            this.pagination.lastPageUrl = data.last_page_url;
            this.pagination.nextPageUrl = data.next_page_url;
            this.pagination.prevPageUrl = data.prev_page_url;
            this.pagination.from = data.from;
            this.pagination.to = data.to;
        },
        sortBy(key) {
            this.sortKey = key;
            this.sortOrders[key] = this.sortOrders[key] * -1;
            this.tableData.column = this.getIndex(this.columns, 'name', key);
            this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
            this.getBanks();
        },
        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value)
        },
    }
};
</script>
