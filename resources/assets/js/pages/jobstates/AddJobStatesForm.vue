<template>
  <form @submit.prevent="createJobState" @keydown="form.errors.clear($event.target.name)">          
    <div class="form-group" :class="{ 'has-error': form.errors.has('jobstate') }">
      
        <div class="row">
          <div class="col-lg-8">             
              <input :disabled="form.busy" v-model="form.jobstate" type="text" class="form-control" id="jobstate" placeholder="Ingrese Situacion Laboral">
          </div>
          <div class="col-lg-4"> 
              <button :disabled="form.busy" class="btn btn-info">
              <i class="fas fa-home"></i>&nbsp;&nbsp;Agregar Situacion Laboral            
			       </button> 
          </div>    
      
      </div>     
      <has-error :form="form" field="jobstate"></has-error>      
    </div>
  </form>
  
</template>

<script>
import { mapGetters } from 'vuex'
import { Form } from 'vform'

export default {
  name: 'add-job-states-form',    
  data: () => ({
    form: new Form({
      jobstate: ''
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
            .then(() => {
              this.form.reset()
              this.$toasted.success(data.msg)
            })
        }).catch((error) => {
          // console.log(error)
        })
    }
  }
}
</script>
