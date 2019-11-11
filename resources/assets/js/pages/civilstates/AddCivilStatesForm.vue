<template>
   
  <form @submit.prevent="createCivilState" @keydown="form.errors.clear($event.target.name)">          
    <div class="form-group" :class="{ 'has-error': form.errors.has('statedescription') }">
      
        <div class="row">
          <div class="col-lg-8">             
              <input :disabled="form.busy" v-model="form.statedescription" type="text" class="form-control" id="cst" placeholder="Ingrese un Estado Civil">
          </div>
          <div class="col-lg-4"> 
              <button :disabled="form.busy" class="btn btn-info">
              <i class="fas fa-home"></i>&nbsp;&nbsp;Agregar Estado Civil           
			  </button> 
          </div>    
      
      </div>     
      <has-error :form="form" field="statedescription"></has-error>      
    </div>
  </form>
  
</template>

<script>
import { mapGetters } from 'vuex';
import { Form } from 'vform';
import swal from 'sweetalert';

export default {
  name: 'add-civil-states-form',    
  data: () => ({
    form: new Form({
      statedescription: ''
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
