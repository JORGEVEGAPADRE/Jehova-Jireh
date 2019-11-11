<template>
    <div class="banks">
        <AddBanksForm/>
        <p class="no-results" v-show="!banks.length">No Hay Bancos Registrados</p>
        <div class="tableFilters">
            <input class="input" type="text" v-model="search" placeholder="Ingrese elemento a Buscar"
                   @input="resetPagination()">

            <div class="control">
                <div class="select">
                    <select v-model="length" @change="resetPagination()">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                    </select>
                </div>
            </div>
        </div>
        <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
           <thead>
              <tr>                
                <th class="text-center bg-info text-light">ID</th>                                    
                <th class="text-center bg-info text-light">Descripcion del Banco</th>                                  
                <th class="text-center bg-info text-light">Acciones</th>
             </tr>    
           </thead>
           <tbody>
             <tr class="text-center" v-for="(bank,index) in banks" :key="index">                                
              <td>{{bank.id}}</td>                                
              <td>{{bank.namebank}}</td>
              <td>
                <div class="btn-group" role="group">                          
                  <a href="#" data-toggle="modal" data-target="#" title="Editar" @click="setActionEdit(bank)" class="text-success"><i class="fas fa-edit"></i></a>   
                  <a href="#" data-toggle="modal" data-target="#" title="Eliminar" @click="setActionDelete(bank)" class="text-danger"><i class="fas fa-trash-alt"></i></a>
                </div> 
              </td>
             </tr>    
           </tbody>
        </datatable>
        <pagination :pagination="pagination" :client="true" :filtered="filteredBanks"
                    @prev="--pagination.currentPage"
                    @next="++pagination.currentPage">
        </pagination>
</div>
</template>

<script>
import AddBanksForm from './AddBanksForm.vue';
//import BanksServer from './BanksServer.vue';
import Datatable from '../../components/Datatable.vue';
import Pagination from '../../components/Pagination.vue';
export default {
    name: 'banks-list',
    components: { datatable: Datatable, pagination: Pagination, AddBanksForm}, 
    
    data() {
        let sortOrders = {};
        let columns = [
            {width: '10%', label: 'Id', name: 'id', type: 'number' },
            {width: '50%', label: 'Nombre del Banco', name: 'namebank', type: 'string'},
            {width: '39%', label: 'Acciones'}
        ]; 
        columns.forEach((column) => {
           sortOrders[column.name] = -1;
        });
        return {
            banks: [],
            columns: columns,
            sortKey: 'namebank',
            sortOrders: sortOrders,
            length: 10,
            search: '',
            bank:{id:'', namebank:''},            
            loading: false,        
            action: '',
            actionAccount: true,        
            actionTitle: 'Editar Banco',
            accountTitle: '',
            account:{id:'',bank_id:'',openamount:'',accountnumber:'',created_at:''},
            idbank:0,
            payload:0,
            tableData: {
                client: true,
            },
            pagination: {
                currentPage: 1,
                total: '',
                nextPage: '',
                prevPage: '',
                from: '',
                to: ''
            },
        }
    },
    created() {
        this.getBanks();
    },
    methods: {
      /*  getBanks: function(page) {
        var urlBanks = '/api/banks?page='+page;
        axios.get(urlBanks).then(response => {
        this.banks = response.data.banks.data,
        this.pagination = response.data.pagination
        });
      }, */
        getBanks(url = '/api/banks') {            
            axios.get(url, {params: this.tableData})
                .then(response => {
                    this.banks = response.data;
                    this.pagination.total = this.banks.length;
                })
                .catch(errors => {
                    console.log(errors);
                });
        },
        paginate(array, length, pageNumber) {
            this.pagination.from = array.length ? ((pageNumber - 1) * length) + 1 : ' ';
            this.pagination.to = pageNumber * length > array.length ? array.length : pageNumber * length;
            this.pagination.prevPage = pageNumber > 1 ? pageNumber : '';
            this.pagination.nextPage = array.length > this.pagination.to ? pageNumber + 1 : '';
            return array.slice((pageNumber - 1) * length, pageNumber * length);
        },
        resetPagination() {
            this.pagination.currentPage = 1;
            this.pagination.prevPage = '';
            this.pagination.nextPage = '';
        },
        sortBy(key) {
            this.resetPagination();
            this.sortKey = key;
            this.sortOrders[key] = this.sortOrders[key] * -1;
        },
        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value)
        },
    },
    computed: {
        filteredBanks() {
            let banks = this.banks;
            if (this.search) {
                banks = banks.filter((row) => {
                    return Object.keys(row).some((key) => {
                        return String(row[key]).toLowerCase().indexOf(this.search.toLowerCase()) > -1;
                    })
                });
            }
            let sortKey = this.sortKey;
            let order = this.sortOrders[sortKey] || 1;
            if (sortKey) {
                banks = banks.slice().sort((a, b) => {
                    let index = this.getIndex(this.columns, 'name', sortKey);
                    a = String(a[sortKey]).toLowerCase();
                    b = String(b[sortKey]).toLowerCase();
                    if (this.columns[index].type && this.columns[index].type === 'date') {
                        return (a === b ? 0 : new Date(a).getTime() > new Date(b).getTime() ? 1 : -1) * order;
                    } else if (this.columns[index].type && this.columns[index].type === 'number') {
                        return (+a === +b ? 0 : +a > +b ? 1 : -1) * order;
                    } else {
                        return (a === b ? 0 : a > b ? 1 : -1) * order;
                    }
                });
            }
            return banks;
        },
        paginated() {
            return this.paginate(this.filteredBanks, this.length, this.pagination.currentPage);
        }
    }
};
</script>
