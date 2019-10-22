<template>
  <form @submit.prevent="createBank" @keydown="form.errors.clear($event.target.name)">          
    <div class="form-group" :class="{ 'has-error': form.errors.has('bank') }">
      
        <div class="row">
          <div class="col-lg-8">             
              <input :disabled="form.busy" v-model="form.bank" type="text" class="form-control" id="nbank" placeholder="Ingrese un Banco">
          </div>
          <div class="col-lg-4"> 
              <button :disabled="form.busy" class="btn btn-info">
              <i class="fas fa-home"></i>&nbsp;&nbsp;Agregar Banco            
			       </button> 
          </div>    
      
      </div>     
      <has-error :form="form" field="bank"></has-error>      
    </div>
  </form>
  
</template>

<script>
import { mapGetters } from 'vuex'
import { Form } from 'vform'

export default {
  name: 'add-banks-form',    
  data: () => ({
    form: new Form({
      bank: ''
    })
  }),

  computed: {
    ...mapGetters([

    ])
  },

  methods: {
    createBank() {
      this.form.post('/api/banks')
        .then(({ data }) => {
          this.$store.dispatch('addBank', data.data)
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
