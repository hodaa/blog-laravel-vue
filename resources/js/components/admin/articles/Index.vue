<template>
<div class="container">
    <div class="form-group">
        <router-link :to="{name: 'createArticle'}" class="btn btn-success">Create new Article</router-link>
    </div>
    <div class="panel panel-default">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Artcles</li>
            </ol>
        </nav>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th> Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-if="!articles.length">
                    <td colspan="3">No Articles found</td>
                </tr>
                <tr v-for="article, index in articles">
                    <td>{{ article.title }}</td>
                    <td>{{ article.category}}</td>

                    <td>
                        <router-link :to="{name: 'editArticle', params: {id: article.id}}" class="btn btn-xs btn-info">
                            Edit
                        </router-link>
                        <a href="#" class="btn btn-xs btn-danger" v-on:click="deleteEntry(article.id, index)">
                            Delete
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
            <pagination v-if="pagination.last_page > 0" :pagination="pagination" :offset="5" @paginate="fetchPosts()"></pagination>
        </div>
    </div>
</div>
</template>
<script>
    export default {
        data: function () {
            return {
                articles: [],
                pagination:''
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/v1/articles')
                .then(function (resp) {
                    app.articles = resp.data.data;
                    app.pagination=resp.data.meta
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load articles");
                });
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    axios.delete('/api/v1/articles/' + id)
                        .then(function (resp) {
                            app.companies.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete company");
                        });
                }
            }
        }
    }
</script>