import PageHeader from './components/PageHeader.vue'
import Login from './pages/auth/Login.vue'
import Register from './pages/auth/Register.vue'
import NotFound from './components/NotFound.vue'
import BanksList from './pages/banks/BanksList.vue'
import JobStatesList from './pages/jobstates/JobStatesList.vue'
import MinistryList from './pages/ministries/MinistriesList.vue'
import CivilStatesList from './pages/civilstates/CivilStatesList.vue'
import MembersList from './pages/members/MembersList.vue'
import UpdateMemberForm from './pages/members/UpdateMemberForm.vue'
import ChurchJobsList from './pages/organization/ChurchJobsList.vue'
export default [

    { path: '/', name: 'home', component: PageHeader, meta: { requiresAuth: true } },
    { path: '/login', name: 'login', component: Login, meta: { redirectIfLogged: true } },
    { path: '/register', name: 'register', component: Register, meta: { redirectIfLogged: true } },
    { path: '/banks', name: 'banks', component: BanksList, meta: { requiresAuth: true } },
    { path: '/churches', name: 'churches', component: ChurchJobsList, meta: { requiresAuth: true } },
    { path: '/churches/hierarchies', name: 'hierarchies', meta: { requiresAuth: true } },
    { path: '/jobstates', name: 'jobstates', component: JobStatesList, meta: { requiresAuth: true } },
    { path: '/ministries', name: 'ministries', component: MinistryList, meta: { requiresAuth: true } },
    { path: '/civilstates', name: 'civilstates', component: CivilStatesList, meta: { requiresAuth: true } },
    // { path: '/members', name: 'members', component: MembersList, meta: { requiresAuth: true } },
    { path: '/updatemember', name: 'updatemember', component: UpdateMemberForm, meta: { requiresAuth: true } },
    { path: '/genders', name: 'genders', meta: { requiresAuth: true } },
    { path: '/countries', name: 'countries', meta: { requiresAuth: true } },
    { path: '/bloods', name: 'bloods', meta: { requiresAuth: true } },
    // { path: '/members/civilstates', name: 'allcivilstates', meta: { requiresAuth: true } },
    // { path: '/members/jobstates', name: 'alljobstates', meta: { requiresAuth: true } },
    { path: '/allcivilstates', name: 'allcivilstates', meta: { requiresAuth: true } },
    { path: '/alljobstates', name: 'alljobstates', meta: { requiresAuth: true } },
    { path: '/accounts', name: 'accounts', meta: { requiresAuth: true } },
    { path: '*', name: 'not-found', component: NotFound }

]