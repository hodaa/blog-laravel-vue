
import ArticlesIndex from './components/admin/articles/Index.vue';
import ArticlesCreate from './components/admin/articles/Create.vue';
import ArticlesEdit from './components/admin/articles/Edit.vue';
//
import ArticlesList from './components/front/articles/index.vue';
import ArticleDetails from './components/front/articles/details.vue';

export const routes = [
    {

        path: 'admin/articles/list',
        components: {
            articlesIndex: ArticlesIndex
        },
    },
    {path: '/create', component: ArticlesCreate, name: 'createArticle'},
    {path: '/edit/:id', component: ArticlesEdit, name: 'editArticle'},

    ////////////////////front//////////////////

    {path: '/',component: ArticlesList, name: 'listArticle'},
    {path: '/article/:id', component: ArticleDetails, name: 'ArticleDetails'},

    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: false
        }
    },
    {
        path: '/admin',
        name: 'admin.dashboard',
        component: AdminDashboard,
        meta: {
            auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/403'}
        }
    },

];

