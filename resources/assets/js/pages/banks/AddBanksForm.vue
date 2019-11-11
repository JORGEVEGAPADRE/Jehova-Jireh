<template>
  <form @submit.prevent="createBank" @keydown="form.errors.clear($event.target.name)">          
    <div class="form-group" :class="{ 'has-error': form.errors.has('namebank') }">
      
        <div class="row">
          <div class="col-lg-8">             
              <input :disabled="form.busy" v-model="form.namebank" type="text" class="form-control" id="nbank" placeholder="Ingrese un Banco">
          </div>
          <div class="col-lg-4"> 
              <button :disabled="form.busy" type="submit" class="btn btn-info">
              <i v-if="form.busy" class="fa fa-fw fa-spinner fa-spin spinner-border text-danger"></i>  
              <i class="fas fa-home"></i>&nbsp;&nbsp;Agregar Banco            
			       </button> 
          </div>                 
      </div>     
        <has-error :form="form" field="namebank"></has-error>      
      </div>
  </form>
  
</template>

<script>
import { mapGetters } from 'vuex';
import { Form } from 'vform';
import swal from 'sweetalert';

export default {
  name: 'add-banks-form',    
  data: () => ({
    form: new Form({
      namebank:''
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