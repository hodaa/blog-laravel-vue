
import ArticlesIndex from './components/articles/Index.vue';
import ArticlesCreate from './components/articles/Create.vue';
import ArticlesEdit from './components/articles/Edit.vue';

export const routes = [

    {
        mode: 'history',
        path: '/',
        components: {
            articlesIndex: ArticlesIndex
        }
    },
    {path: '/create', component: ArticlesCreate, name: 'createArticle'},
    {path: '/edit/:id', component: ArticlesEdit, name: 'editArticle'},
];

