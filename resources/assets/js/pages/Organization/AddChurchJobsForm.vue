<template>
  <form @submit.prevent="createChurchJob" @keydown="form.errors.clear($event.target.name)">          
    <div class="form-group" :class="{ 'has-error': form.errors.has('churchjob') }">
      
        <div class="row">
          <div class="col-lg-8">             
              <input :disabled="form.busy" v-model="form.churchjob" type="text" class="form-control" id="nbank" placeholder="Ingrese un Banco">
          </div>
          <div class="col-lg-4"> 
              <button :disabled="form.busy" class="btn btn-info">
              <i class="fas fa-home"></i>&nbsp;&nbsp;Agregar Cargo Eclesiastico            
			       </button> 
          </div>    
      
      </div>     
      <has-error :form="form" field="churchjob"></has-error>      
    </div>
  </form>
  
</template>

<script>
import { mapGetters } from 'vuex'
import { Form } from 'vform'

export default {
  name: 'add-church-jobs-form',    
  data: () => ({
    form: new Form({
      churchjob: ''
    })
  }),

  computed: {
    ...mapGetters([

    ])
  },

  methods: {
    createChurchJob() {
      console.log("Jorge Vega");
      console.log(this.form.churchjob);
      console.log(this.form.churchjob);
      console.log(this.form.churchjob);
      this.form.post('/api/churches')
        .then(({ data }) => {
          this.$store.dispatch('addChurchJob',data.data)
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
