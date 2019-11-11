<template> 
<div class="container-fluid">  
 
  <form @submit.prevent="editMember(form)">  

    <div class="panel panel-success">
      <div class="panel-heading">
        Actualizacion Mis Datos
      </div> 
    </div>
  
   <div class="panel-body"> 

      <div class="form-row">  
        <div class="form-group col-md-6" :class="{ 'has-error': form.errors.has('name') }">    
          <label for="usname">Nombre(s)</label>
          <input type="text" id="usname" class="form-control" v-model="form.name">   
          <has-error :form="form" field="name"></has-error>  
        </div>
        <div class="form-group col-md-6">                  
          <label for="lname">Apellido(s)</label>                         
          <input type="text" id="lname" class="form-control" v-model="form.lastname">    
        </div>
      </div>

      <div class="form-row">
         <div class="form-group col-md-6">
           <label for="dpfn">Fecha Nacimiento</label>   
           <datepicker :value="form.birthdate" id="dpfn" v-model="form.birthdate" :language="es"></datepicker>      
          </div>
         <div class="form-group col-md-6" :class="{ 'has-error': form.errors.has('rut') }">
           <label for="RUN">RUN/Pasaporte/DNI</label>                          
           <input type="text" id="RUN" class="form-control" min="8" max="12" pattern="[0-9]{7,8}-[0-9Kk]{1}" v-model="form.rut">       
          <has-error :form="form" field="rut"></has-error>  
         </div>
      </div>

      <div class="form-row">

        <div class="form-group col-md-5">
          <label id="country">Pais De Origen</label>    
          <multiselect                      
          v-model="valuecountry"
          placeholder="Seleccione Opcion"                      
          :options="countries"
          :searchable="true"                     
          openDirection="bottom"
          select-label="Click/Intro Seleccionar"
          deselectLabel="Click/Intro Desactivar Seleccion">
          <span slot="noOptions">Lista de Paises Vacia...</span> 
          <span slot="noResult">No se encontraron paises que coincidan con el criterio de busqueda</span>                      
          </multiselect> 
        </div>

        <div class="form-group col-md-4">
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

        <div class="form-group col-md-3">
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

    <div class="form-row">

      <div class="form-group col-md-6">
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
      <div class="form-group col-md-6">
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
    <div class="form-group col-md-12">
        <label for="ta">Profesión/Oficio/Ocupación/Talentos/Habilidades o Destrezas</label>                         
        <textarea id="ta" class="form-control" v-model="form.occupation"></textarea>      
      </div> 
      <div class="form-row">
      <div class="form-group col-md-6">
        <label for="fnn">Fecha Nuevo Nacimiento</label>
        <datepicker :value="form.newbirthdate" id="dpfnn" v-model="form.newbirthdate" :language="es"></datepicker> 
      </div>
      <div class="form-group col-md-6">
        <label for="fbi">Fecha Bautismo Por Inmersion</label> 
        <datepicker :value="form.baptizeddate" id="dpfb"  v-model="form.baptizeddate" :language="es"></datepicker>
      </div>
    </div> 
    <div class="form-group col-md-12">
      <label for="lt">Testimonio Personal</label>                         
      <textarea id="lt" class="form-control"  v-model="form.lifetestimony"></textarea>    
    </div>
    <div class="form-row">
      <div class="form-group col-md-6" :class="{ 'has-error': form.errors.has('alternatemail') }">
        <label for="ca">Correo Alternativo</label>                         
        <input type="email" id="ca" class="form-control" placeholder="otrocorreo@gmail.com" v-model="form.alternateemail">
        <has-error :form="form" field="alternatemail"></has-error>  
      </div>
      <div class="form-group col-md-6">
        <label for="te">Telefono(s)</label>                          
        <input type="text" id="te" class="form-control"  v-model="form.phone">
      </div>
    </div>
      <div class="form-group col-md-12">
      <label for="di">Direccion de Habitacion</label>                  
      <input type="text" id="di" class="form-control" v-model="form.address">    
    </div> 

    <div class="form-group col-md-12">
      <label for="no">Notas/Observaciones</label>                          
      <input type="text" id="no" class="form-control" v-model="form.notes">     
    </div>
     <div class="form-row">
      <div class="form-group col-md-6" :class="{ 'has-error': form.errors.has('password') }">
        <label for="co">Contraseña</label> 
        <input type="password" name="pass1" id="co" min="6" class="form-control" v-model="form.password"> 
        <has-error :form="form" field="password"></has-error>       
      </div>
      <div class="form-group col-md-6" :class="{ 'has-error': form.errors.has('confirmpassword') }">
        <label for="rco">Repetir Contraseña</label>                         
        <input type="password" name="pass2" id="rco" min="6"  class="form-control" v-model="form.confirmpassword">     
        <has-error :form="form" field="confirmpassword"></has-error>  
      </div>
    </div> 
</div>
    <div class="panel-footer align-items-center">
    
      <button id="smb" :disabled="form.busy" type="submit" class="btn btn-success float-right">
        <i v-if="form.busy" class="fa fa-fw fa-spinner fa-spin spinner-border text-danger"></i>  
        <i class="fas fa-id-card"></i>&nbsp;&nbsp;Salvar Cambios            
      </button> 
      <button type="button" class="btn btn-danger float-right">Cerrar</button> 
     
    </div>
  </form> 
</div>

</template>

<script>
 import Multiselect from 'vue-multiselect';  
 import {mapGetters} from 'vuex';  
 import fontawesome from '@fortawesome/fontawesome-free';
 import Datepicker from 'vuejs-datepicker';
 import { es } from 'vuejs-datepicker/dist/locale'; 
 import { Form } from 'vform';
 import swal from 'sweetalert';
 
 export default {
    name: 'update-member-form',   
    components: {Multiselect,Datepicker},
    data: () => ({
        members: [],
        submitted: false,
        loading: false,        
        action: true,
        es:es,             
        actionTitle: 'Miembros: Actualizacion de datos',
        errorsexist: false,
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
        form: new Form({
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
          
          })
  }),  
      
    created() {
      this.form.id=this.currentUser.id;
      this.form.name=this.currentUser.name;
      this.form.lastname=this.currentUser.lastname;
      this.form.country_id=this.currentUser.country_id;
      this.form.sex_id=this.currentUser.sex_id;
      this.form.bloodtype_id=this.currentUser.bloodtype_id;  
      this.form.birthdate=this.currentUser.birthdate;     
      this.form.rut=this.currentUser.rut;
      this.form.civilstate_id=this.currentUser.civilstate_id;   
      this.form.jobstate_id=this.currentUser.jobstate_id;    
      this.form.occupation=this.currentUser.occupation;    
      this.form.newbirthdate=this.currentUser.newbirthdate;  
      this.form.baptizeddate=this.currentUser.baptizeddate;    
      this.form.lifetestimony=this.currentUser.lifetestimony;   
      this.form.email=this.currentUser.email;     
      this.form.alternateemail=this.currentUser.alternateemail;     
      this.form.phone=this.currentUser.phone;
      this.form.address=this.currentUser.address;
      this.form.password=this.currentUser.password;
      this.form.confirmpassword=this.currentUser.confirmpassword;        
          
        
      this.$store.dispatch("getSexOptions");
      this.$store.dispatch("getCountryOptions");
      this.$store.dispatch("getBloodTypeOptions");         
      this.$store.dispatch("getCivilStateOptions");
      this.$store.dispatch("getJobStateOptions");
      
      
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
        'sexoptions',
        'countryoptions',
        'bloodtypeoptions',
        'civilstateoptions',
        'jobstateoptions'     
                  
      ])      
    },
    methods: {  
      editMember(form) { 
         let fn = new Date(form.birthdate);
         let fnn =new Date(form.newbirthdate) ;
         let fb = new Date(form.baptizeddate);
         if (fnn<fn){
           alert("Fecha de Nuevo Nacimiento Invalida...");                         
         }
         if (fb<fnn){
           alert("Fecha de Bautizo Invalida...");                            
         }
         
        this.idsex=this.genders.indexOf(this.valuesex);
        form.sex_id=(this.idsex)+1;
        this.idcountry=this.countries.indexOf(this.valuecountry);
        form.country_id=(this.idcountry)+1;
        this.idblood=this.bloods.indexOf(this.valueblood);
        form.bloodtype_id=(this.idblood)+1;
        this.idcivil=this.civils.indexOf(this.valuecivil);
        form.civilstate_id=(this.idcivil)+1;
        this.idjob=this.jobs.indexOf(this.valuejob);
        form.jobstate_id=(this.idjob)+1;       
            
         this.$store.dispatch("editMember", form).then((response) => {
         this.$toasted.success(response.data.msg);
        
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
         //   this.errors = errors; 
         //   this.loading = true
         //   this.errorsexist=true;
                        
                  
         }).finally(() => {
           // this.getMembers();
         });
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
