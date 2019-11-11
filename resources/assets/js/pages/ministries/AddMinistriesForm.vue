<template>
  <form @submit.prevent="createJobState" @keydown="form.errors.clear($event.target.name)">          
    <div class="form-group" :class="{ 'has-error': form.errors.has('ministry') }">
      
        <div class="row">
          <div class="col-lg-8">             
              <input :disabled="form.busy" v-model="form.ministry" type="text" class="form-control" id="jb" placeholder="Ingrese Descripcion del Ministerio">
          </div>
          <div class="col-lg-4"> 
              <button :disabled="form.busy" class="btn btn-info">
              <i class="fas fa-home"></i>&nbsp;&nbsp;Agregar Ministerio            
			       </button> 
          </div>    
      
      </div>     
      <has-error :form="form" field="ministry"></has-error>      
    </div>
  </form>
  
</template>

<script>
import { mapGetters } from 'vuex';
import { Form } from 'vform';
import swal from 'sweetalert';

export default {
  name: 'add-ministries-form',    
  data: () => ({
    form: new Form({
      ministry: ''
    })
  }),

  computed: {
    ...mapGetters([

    ])
  },

  methods: {
    createJobState() {
      this.form.post('/api/ministries')
        .then(({ data }) => {
          this.$store.dispatch('addMinistry', data.data)
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
