<style lang="scss">
.pagination {
    justify-content: flex-end !important;
    .page-stats {
        align-items: center;
        margin-right: 5px;
    }
    i {
        color: #3273dc !important;
    }
}
</style>

<template>
    <nav class="pagination" v-if="!client">
        <span class="page-stats">{{pagination.from}} - {{pagination.to}} de {{pagination.total}}</span>
        <a v-if="pagination.prevPageUrl" class="button is-small pagination-previous" title="Anterior" @click="$emit('prev');">
          <i class="fa fa-backward"></i> 
        </a>
        <a class="button is-small pagination-previous" title="Anterior" v-else :disabled="true">
          <i class="fa fa-backward"></i> 
        </a>
        --
        <a v-if="pagination.nextPageUrl" class="button is-small pagination-next" title="Siguiente" @click="$emit('next');">
          <i class="fa fa-forward"></i>
        </a>
        <a class="button is-small pagination-next" title="Siguiente" v-else :disabled="true">
          <i class="fa fa-forward"></i>
        </a>
    </nav>

    <nav class="pagination" v-else>
        <span class="page-stats">
           {{pagination.from}} - {{pagination.to}} de {{filtered.length}} 
            <span v-if="filtered.length<pagination.total">->(Filtrado de {{pagination.total}} total registros)</span>
        </span> 
        <a v-if="pagination.prevPage" class="button is-small pagination-previous" title="Anterior" @click="$emit('prev');">
           <i class="fa fa-backward"></i> 
        </a>
        <a class="button is-small pagination-previous" title="Anterior" v-else :disabled="true">
           <i class="fa fa-backward"></i>   
        </a>
         --  
        <a class="button is-small pagination-next" v-if="pagination.nextPage"  title="Siguiente" @click="$emit('next');">
            <i class="fa fa-forward"></i>
        </a>
        <a class="button is-small pagination-next" title="Siguiente" v-else :disabled="true">
            <i class="fa fa-forward"></i>
        </a>
    </nav>
</template>
    
<script>
    import fontawesome from '@fortawesome/fontawesome-free';
    export default {
        props: ['pagination', 'client', 'filtered']
    }
</script>