<template>
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="container">
      
          <img src="assets/img/logo.jpg" alt="Jehova Jireh"/>
          <strong>Vida Abundante...Comunidad Cristiana .-Chile</strong>
       <!-- <a class="navbar-brand" href="#">Vida Abundante...Comunidad Cristiana .-Chile</a> -->   
        </div>	
				
      </div>
    
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav" v-show="authenticated">
          <router-link :to="{name:'members'}"><a href="#"> Miembros |</a></router-link>
        </ul>
        <ul class="nav navbar-nav" v-show="authenticated">
          <router-link :to="{name:'churches'}"><a href="#"> Estructura Organizativa |</a></router-link>
        </ul>        
        <ul class="nav navbar-nav" v-show="authenticated">
          <router-link :to="{name:'banks'}"><a href="#"> Bancos |</a></router-link>
        </ul>
        <ul class="nav navbar-nav" v-show="authenticated">
          <router-link :to="{name:'civilstates'}"><a href="#" exact> Estado Civil |</a></router-link>
        </ul>
        
        <ul class="nav navbar-nav" v-show="authenticated">
          <router-link :to="{name:'jobstates'}"><a href="#"> Situacion Laboral |</a></router-link>
        </ul>
       
        <ul class="nav navbar-nav navbar-right" v-show="authenticated">
          <li v-if="currentUser"><a>{{currentUser.name}}</a></li>
          <li><a @click.prevent="logout">Logout</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right" v-show="!authenticated">
          <router-link :to="{name:'login'}"><a href="#">Login</a></router-link>
          <router-link :to="{name:'register'}"><a href="#">Register</a></router-link>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'page-header',
  computed: {
    ...mapGetters([
      'currentUser',
      'authenticated'
    ])
  },
  methods: {
    logout() {
      this.$store.dispatch('logout').then(() => {
        this.$router.push({ name: 'login' })
      })
    }
  }
}
</script>
