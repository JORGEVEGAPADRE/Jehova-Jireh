<template>
  <form @submit.prevent="createJobState" @keydown="form.errors.clear($event.target.name)">          
    <div class="form-group" :class="{ 'has-error': form.errors.has('jobdescription') }">
      
        <div class="row">
          <div class="col-lg-8">             
              <input :disabled="form.busy" v-model="form.jobdescription" type="text" class="form-control" id="jb" placeholder="Ingrese Situacion Laboral">
          </div>
          <div class="col-lg-4"> 
              <button :disabled="form.busy" class="btn btn-info">
              <i class="fas fa-home"></i>&nbsp;&nbsp;Agregar Situacion Laboral            
			       </button> 
          </div>    
      
      </div>     
      <has-error :form="form" field="jobdescription"></has-error>      
    </div>
  </form>
  
</template>

<script>
import { mapGetters } from 'vuex';
import { Form } from 'vform';
import swal from 'sweetalert';

export default {
  name: 'add-job-states-form',    
  data: () => ({
    form: new Form({
      jobdescription: ''
    })
  }),

  computed: {
    ...mapGetters([

    ])
  },

  methods: {
    createJobState() {
      this.form.post('/api/jobstates')
        .then(({ data }) => {
          this.$store.dispatch('addJobState', data.data)
            let msg=data.msg;
              swal({
              icon: "success",              
              title:'Operacion Exitosa!!!',
              text: msg,              
              button: true,              
              position:'bottom-end'
              })
            .then(() => {
              this.form.reset()             
              
              })
        })
    }
  }
}
</script>
