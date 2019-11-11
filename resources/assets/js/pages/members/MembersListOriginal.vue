<template>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-offset-2">       
       
        <p class="no-results" v-show="!members.length">No Hay Miembros Registrados</p>
        <div class="row mt-5">                      
          <table class="table table-bordered table-striped">
            <thead>
              <tr>                
                <th class="text-center bg-info text-light">Id</th>                                    
                <th class="text-center bg-info text-light">Nombre(s) del Miembro</th>
                <th class="text-center bg-info text-light">Apellido(s) del Miembro</th>                                  
                <th class="text-center bg-info text-light">Acciones</th>
             </tr>    
           </thead>
           <tbody>
             <tr class="text-center" v-for="(member,index) in members" :key="index">                                
              <td>{{member.id}}</td>                                
              <td>{{member.name}}</td>
              <td>{{member.lastname}}</td>
              <td>
                <div class="btn-group" role="group">                          
                  <button href="#myModalScrollable" data-toggle="modal" data-target="#myModalScrollable" title="Editar" @click="setActionEdit(member)" class="text-success"><i class="fas fa-edit"></i></button>   
                  <button href="#myModalScrollable" data-toggle="modal" data-target="#myModalScrollable" title="Eliminar" @click="setActionDelete(member)" class="text-danger"><i class="fas fa-trash-alt"></i></button>      
				</div> 
              </td>
             </tr>    
           </tbody>
          </table>               
   
      </div>
     
 
      <!--INICIO FORMULARIO MODAL SCROLL USADO PARA EDITAR Y ELIMINAR -->
<div name="fm" class="modal fade" id="myModalScrollable" tabindex="-1" role="dialog" aria-labelledby="myModalScrollable" aria-hidden="true">
   
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
      <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
               <h3 class="modal-title bg-primary" id="modalTitle">{{actionTitle}}</h3>
            </div>
            <div id="myModalScrollable-modal-body" class="modal-body">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">                    
                    <label for="usname">Nombre(s)</label>
                  
                  <!--<input type="text" id="name" class="form-control"  v-if="action" v-model="member.name" required>-->  
                    <input type="text" id="usname" v-bind:class="{'form-control':true, 'is-invalid' : !validName(usname) && usnameBlured}"
                    v-on:blur="usnameBlured = true"  v-if="action" v-model="member.name" required>                    
                    <label class="form-control" v-else>{{member.name}}</label>
                    <div class="text-danger" v-if="errorsexist">                              
                      <span v-for="(error,index) in errors['name']" :key="index">
                       <li>{{error}}</li>                                                            
                      </span>
                    </div>                    
                  </div> 
                </div> 
                &nbsp;
                <div class="row">
                  <div class="col-md-12">
                    <label for="lname">Apellido(s)</label>                         
                    <input type="text" id="lname" class="form-control" v-if="action" v-model="member.lastname">
                    <label class="form-control" v-else>{{member.lastname}}</label>
                  </div>  
                </div> 
                &nbsp;
                <div class="row">
                  <div class="col-md-6"> 
                    
                   <label for="fn">Fecha Nacimiento</label>                        
                   
                    <datepicker :value="member.birthdate" id="dpfn" v-if="action" v-model="member.birthdate" :language="es"></datepicker>
                    <label class="form-control" v-else>{{member.birthdate}}</label>
                  </div>
                  <div class="col-md-6"> 
                    <label for="RUN">RUN/Pasaporte/DNI</label>                          
                    <input type="text" id="RUN" class="form-control" min="8" max="12" pattern="[0-9]{7,8}-[0-9Kk]{1}" v-if="action" v-model="member.rut">
                    <label class="form-control" v-else>{{member.rut}}</label>
                    <div class="text-danger" v-if="errorsexist">                              
                      <span v-for="(error,index) in errors['rut']" :key="index">
                       <li>{{error}}</li>                                                            
                      </span>
                    </div>
                  </div>                  
                </div>
                &nbsp; 
                <div class="row">
                  <div class="col-md-5">
                    <label id="country">Pais De Origen</label>    
                    <multiselect                      
                      v-model="valuecountry"
                      placeholder="Seleccione Opcion"                      
                      :options="countries"
                      :searchable="true"                     
                      openDirection="bottom"
                      select-label="Click/Intro Seleccionar"
                      deselectLabel="Click/Intro Desactivar Seleccion"                     
                      >
                      <span slot="noOptions">Lista de Paises Vacia...</span> 
                      <span slot="noResult">No se encontraron paises que coincidan con el criterio de busqueda</span>                      
                     </multiselect>
                   </div> 
                  <div class="col-md-4">
                    <label for="genders">Genero</label>
                    <multiselect
                      v-model="valuesex"
                      :options="genders"
                      :searchable="false"
                      openDirection="bottom"
                      placeholder="Seleccione Opcion"
                      select-label="Click/Intro Seleccionar"
                      deselectLabel="Click/Intro Desactivar Seleccion">
                      <span slot="noOptions">Lista de Generos Vacia...</span> 
                      <span slot="noResult">No se encontraron generos que coincidan con el criterio de busqueda</span>                       
                    </multiselect>
                   </div>                    
                     
                    <div class="col-md-3">
                      <label for="blood">Grupo Sanguineo</label>      
                      <multiselect
                      v-model="valueblood"
                      placeholder="Seleccione Opcion"
                      :options="bloods"
                      :searchable="false"
                      openDirection="bottom"                      
                      select-label="Click/Intro Seleccionar"
                      deselectLabel="Click/Intro Desactivar Seleccion">
                      <span slot="noOptions">Lista de Grupos Sanguineos...</span> 
                      <span slot="noResult">No se encontraron Grupos Sanguineos que coincidan con el criterio de busqueda</span>                       
                     </multiselect>
                    </div>
                </div> 
                &nbsp;  
                 <div class="row">
                   <div class="col-md-6">
                    <label for="civils">Estado Civil</label>                
                    <multiselect
                      v-model="valuecivil"
                      placeholder="Seleccione Opcion"
                      :options="civils"
                      :searchable="false"
                      openDirection="bottom"
                      select-label="Click/Intro Seleccionar"
                      deselectLabel="Click/Intro Desactivar Seleccion">
                      <span slot="noOptions">Lista de Estados Civiles...</span> 
                      <span slot="noResult">No se encontraron Estados Civiles que coincidan con el criterio de busqueda</span>                       
                     </multiselect>
                   </div>                     
                   <div class="col-md-6">
                    <label for="jobs">Situacion Laboral</label> 
                    <multiselect
                      v-model="valuejob"
                      placeholder="Seleccione Opcion"
                      :options="jobs"
                      :searchable="false"
                      openDirection="bottom"                    
                      select-label="Click/Intro Seleccionar"
                      deselectLabel="Click/Intro Desactivar Seleccion">
                      <span slot="noOptions">Lista de Situaciones Laborales...</span> 
                      <span slot="noResult">No se encontraron Situaciones Laborales que coincidan con el criterio de busqueda</span>                       
                     </multiselect>
                    </div>                   
                </div>
                &nbsp;
                <div class="row">
                  <div class="col-md-12">
                    <label for="ta">Profesión/Oficio/Ocupación/Talentos/Habilidades o Destrezas</label>                         
                    <textarea id="ta" class="form-control" v-if="action" v-model="member.occupation"></textarea>
                    <textarea id="ta1" class="form-control" v-else v-model="member.occupation" readonly></textarea>
                  </div> 
                            
                </div> 
                &nbsp; 

                 <div class="row">
                  <div class="col-md-6"> 
                    <label for="fnn">Fecha Nuevo Nacimiento</label>
                    <datepicker :value="member.newbirthdate" id="dpfnn" v-if="action" v-model="member.newbirthdate" :language="es"></datepicker>                          
                    
                    <label class="form-control" v-else>{{member.newbirthdate}}</label>
                  </div>
                  <div class="col-md-6">
                    <label for="fbi">Fecha Bautismo Por Inmersion</label> 
                    <datepicker :value="member.baptizeddate" id="dpfb" v-if="action" v-model="member.baptizeddate" :language="es"></datepicker>                       
                    
                    <label class="form-control" v-else>{{member.baptizeddate}}</label>
                  </div>                  
                </div>
                &nbsp;
                <div class="row">
                  <div class="col-md-12">
                    <label for="lt">Testimonio Personal</label>                         
                    <textarea id="lt" class="form-control" v-if="action" v-model="member.lifetestimony"></textarea>
                    <textarea id="lt1" class="form-control" v-else v-model="member.lifetestimony" readonly></textarea>
                  </div>                                   
                </div>
                &nbsp;
                <div class="row">                  
                  <div class="col-md-12">                 
                    <label for="ca">Correo Alternativo</label>                         
                    <input type="email" id="ca" class="form-control" placeholder="otrocorreo@gmail.com" v-if="action" v-model="member.alternateemail">
                    <label for="cp2" class="form-control" v-else>{{member.alternatemail}}</label>
                    <div class="text-danger" v-if="errorsexist">                              
                      <span v-for="(error,index) in errors['alternateemail']" :key="index">
                       <li>{{error}}</li>                                                            
                      </span>
                    </div>                     
                   </div>                  
                </div>
                &nbsp;
                <div class="row">
                  <div class="col-md-6">
                    <label for="te">Telefono(s)</label>                          
                    <input type="text" id="te" class="form-control" v-if="action" v-model="member.phone">
                    <label for="te1" class="form-control" v-else>{{member.phone}}</label>
                  </div>
                  <div class="col-md-6">                  
                    <label for="di">Direccion de Habitacion</label>                  
                    <input type="text" id="di" class="form-control" v-if="action" v-model="member.address">
                    <label for="di1" class="form-control" v-else>{{member.address}}</label>
                  </div>                  
                </div>
                &nbsp;
                <div class="row">
                  <div class="col-md-12">
                    <label for="no">Notas/Observaciones</label>                          
                    <input type="text" id="no" class="form-control" v-if="action" v-model="member.notes">
                    <label for="no1" class="form-control" v-else>{{member.notes}}</label>
                  </div>                                  
                </div>
                &nbsp; 
                 <div class="row">                  
                  <div class="col-md-6">
                    <label for="co">Contraseña</label> 
                    <input type="password" name="pass1" id="co" min="6" class="form-control" v-if="action" v-model="member.password">                    
                    <label for="co1" class="form-control" v-else>{{member.password}}</label>                     
                     <div class="text-danger invalid-feedback" v-if="errorsexist">                              
                      <span v-for="(error,index) in errors['password']" :key="index">
                       <li> {{error}}</li>                                     
                      </span>
                    </div> 
                  </div>                
                  <div class="col-md-6">
                    <label for="rco">Repetir Contraseña</label>                         
                    <input type="password" name="pass2" id="rco" min="6"  class="form-control" v-if="action" v-model="member.confirmpassword">
                    <label for="rco1" class="form-control" v-else>{{member.confirmpassword}}</label>
                    <div class="text-danger" v-if="errorsexist">                              
                      <ul v-for="(error,index) in errors['confirmpassword']" :key="index">
                       <li>{{error}}</li>                                                            
                      </ul>
                    </div>
                  </div>                    
                </div>

              </div>     
            </div>    
            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
              <button id="smb" type="button" class="btn btn-warning" data-dismiss="modal" v-if="action" @click="editMember(member)">Salvar Cambios</button>
              <button idtype="button" class="btn btn-danger" data-dismiss="modal" v-else @click="deleteMember(member)">Dar de Baja...Seguro?</button>
            </div>
           <!--data-dismiss="modal"-->
        </div>
         
    </div>
    
  </div>
      <!--FIN FORMULARIO MODAL SCROLL USADO PARA EDITAR Y ELIMINAR --> 
    </div>
  </div>
</div>


 
 
</template>

<script>
 import Multiselect from 'vue-multiselect';  
 import { mapGetters} from 'vuex';  
 import fontawesome from '@fortawesome/fontawesome-free';
 import Datepicker from 'vuejs-datepicker';
 import { es } from 'vuejs-datepicker/dist/locale';
 import { required, email, minLength, sameAs } from "vuelidate/lib/validators";
 import swal from 'sweetalert';
 
 export default {
    name: 'members-list',   
    components: {Multiselect,Datepicker},  
    data:() => {
      return {         
        member:{
          id:'', 
          name:'',
          lastname: '',
          role: '',
          country_id: '',
          sex_id: 1,
          bloodtype_id:1,
          birthdate:'',
          rut: '',
          civilstate_id: 1,
          jobstate_id: 1,
          occupation: '',
          newbirthdate:'',
          baptizeddate:'',
          lifetestimony: '',
          email:'',
          alternateemail:'',
          phone: '',
          address:'',
          notes:'',
          password:'',
          confirmpassword: ''         
          },
        submitted: false,
        loading: false,        
        action: true,
        es:es,             
        actionTitle: 'Miembros: Actualizacion de datos',
        selected1: null,
        selected2: null,
        selected3: null,
        selected4: null,
        selected5: null,
        valuesex:0,        
        valuecountry:0,
        valueblood:0,
        valuecivil:0,
        valuejob:0,
        idsex:0,
        idcountry:0,        
        idblood:0,
        idcivil:0,
        idjob:0,
        genders: [],      
        countries:[],
        bloods:[],
        civils:[],       
        jobs:[],        
        valid:0,
        usname: '',
        errors: [],
        usnameBlured : false,
        
       // errorsalternateemails:[],
       // errorpasswords:[],
      //  errorconfirmpasswords:[],
        errorsexist: false

      }
    },    
  
    created() {
      this.$store.dispatch("getMembers")
      this.$store.dispatch("getSexOptions")
      this.$store.dispatch("getCountryOptions")
      this.$store.dispatch("getBloodTypeOptions")         
      this.$store.dispatch("getCivilStateOptions")
      this.$store.dispatch("getJobStateOptions")
      
      let sexs=this.sexoptions;  
      for (var key in sexs){
          this.genders.push(sexs[key].sex);          
      }
      
      let countrys=this.countryoptions;  
      for (var key in countrys){
          this.countries.push(countrys[key].country);          
      }
      
      let civils=this.civilstateoptions;  
      for (var key in civils){
          this.civils.push(civils[key].statedescription);          
      }

      let bloods=this.bloodtypeoptions;  
      for (var key in bloods){
          this.bloods.push(bloods[key].bloodtype);          
      }

      let jobs=this.jobstateoptions;  
      for (var key in jobs){
          this.jobs.push(jobs[key].jobdescription);          
      }       
    },
   
    computed: {                  
      ...mapGetters([
        'currentUser',
        'members',
        'sexoptions',
        'countryoptions',
        'bloodtypeoptions',
        'civilstateoptions',
        'jobstateoptions'     
                  
      ])      
    },
    methods: {
      validName(usname) {        
       if( usname.trim===""){
          return this.usnameBlured = true;
       }        
    },
      /*validatehtml(valid){
       let uname=this.member.name;
       let lnam=uname.length;
       let pass1 = String(this.member.password);
       console.log('member es:', this.member);
       let pass2 = String(this.member.confirmpassword);
       let fn = new Date(this.member.birthdate);
       let fnn =new Date(this.member.newbirthdate) ;
       let fb = new Date(this.member.baptizeddate);
       let count=0;       
       if (lnam==0){
         alert("El Nombre esta vacio...");
         count++;         
       }
       if (fnn<fn){
         alert("Fecha de Nuevo Nacimiento Invalida...");
         count++;                  
       }
       if (fb<fnn){
         alert("Fecha de Bautizo Invalida...");
         count++;                  
       }
       if (pass1.length=0){
         alert("Contraseña Vacia");
         count++;         
       }          
       if (pass2.length=0){
         alert("Confirmacion de Contraseña Vacia");
         count++;         
       } 
       if (pass1 != pass2){      
           alert("Las dos claves son distintas...");
           count++;                      
      } 
      console.log(count);
      if (count==0){
        return this.valid=1;
      }else{
        return this.valid=0;  
      } 
      
      }, */ 
      
      initList(member){
        this.idsex=(member.sex_id)-1;
        let ids=this.idsex;
        this.valuesex=this.genders[ids];

        this.idcountry=(member.country_id)-1;
        let idc=this.idcountry;        
        this.valuecountry=this.countries[idc];

        this.idblood=(member.bloodtype_id)-1;
        let idb=this.idblood;
        this.valueblood=this.bloods[idb];

        this.idcivil=(member.civilstate_id)-1;
        let idcs=this.idcivil;
        this.valuecivil=this.civils[idcs];

        this.idjob=(member.jobstate_id)-1;
        let idj=this.idjob;
        this.valuejob=this.jobs[idj];
      },            
      setActionEdit(member) {         
        this.initList(member);
        this.member=member;               
        this.action = true;      
        this.actionTitle='Miembros: Actualizacion de datos';               
      },
      setActionDelete(member) {
        this.initList(member);           
        this.member=member;               
        this.action = false;        
        this.actionTitle='Miembros: Darse de Baja';               
      },       
      editMember(member) { 
         
         
         let fn = new Date(this.member.birthdate);
         let fnn =new Date(this.member.newbirthdate) ;
         let fb = new Date(this.member.baptizeddate);
         if (fnn<fn){
           alert("Fecha de Nuevo Nacimiento Invalida...");                         
         }
         if (fb<fnn){
           alert("Fecha de Bautizo Invalida...");                            
         }
         
        this.idsex=this.genders.indexOf(this.valuesex);
        member.sex_id=(this.idsex)+1;

        this.idcountry=this.countries.indexOf(this.valuecountry);
        member.country_id=(this.idcountry)+1;

        this.idblood=this.bloods.indexOf(this.valueblood);
        member.bloodtype_id=(this.idblood)+1;

        this.idcivil=this.civils.indexOf(this.valuecivil);
        member.civilstate_id=(this.idcivil)+1;

        this.idjob=this.jobs.indexOf(this.valuejob);
        member.jobstate_id=(this.idjob)+1;       
        
         this.loading = true;        
         this.$store.dispatch("editMember", member).then((response) => {
         //this.$toasted.success(response.data.msg);
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
            this.errors = errors; 
            this.loading = true
            this.errorsexist=true;
            this.validName(this.usname);            
                  
         }).finally(() => {
            this.$store.dispatch("getMembers") 
         });
      },       
     deleteMember(member) {
        this.loading = true
        this.$store.dispatch("deleteMember", member).then((response) => {
          this.$toasted.success(response.data.msg)
        }).then(() => {
          this.loading = false
        })
       }
      }
    
  }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
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
