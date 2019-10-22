<template>
  <form @submit.prevent="createCivilState" @keydown="form.errors.clear($event.target.name)">          
    <div class="form-group" :class="{ 'has-error': form.errors.has('civilstate') }">
      
        <div class="row">
          <div class="col-lg-8">             
              <input :disabled="form.busy" v-model="form.civilstate" type="text" class="form-control" id="ce" placeholder="Ingrese un Estado Civil">
          </div>
          <div class="col-lg-4"> 
              <button :disabled="form.busy" class="btn btn-info">
              <i class="fas fa-home"></i>&nbsp;&nbsp;Agregar Estado Civil           
			  </button> 
          </div>    
      
      </div>     
      <has-error :form="form" field="civilstate"></has-error>      
    </div>
  </form>
  
</template>

<script>
import { mapGetters } from 'vuex'
import { Form } from 'vform'

export default {
  name: 'add-civil-states-form',    
  data: () => ({
    form: new Form({
      civilstate: ''
    })
  }),

  computed: {
    ...mapGetters([

    ])
  },

  methods: {
    createCivilState() {
      this.form.post('/api/civilstates')
        .then(({ data }) => {
          this.$store.dispatch('addCivilState', data.data)
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
