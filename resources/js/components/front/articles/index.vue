<template>
    <div class="container">
    <div class="search-wrapper">
        <div class="active-pink-3 active-pink-4 mb-4">
        <input type="text" v-model="search" placeholder="Search title.." class="form-control"  aria-label="Search"/>
        </div>
        <!--<label>Search title:</label>-->
    </div>
        <div class="row">

                <div v-for="article in filteredList" class="post-preview">
                        <router-link :to="{name: 'ArticleDetails' ,params: {id: article.id}}">
                            <h2 class="post-title">
                            {{article.title}}

                        </h2>
                        </router-link>
                        <h3 class="post-subtitle">
                            {{article.content.substring(0,180)+".."}}
                        </h3>
                    <p class="post-meta">Posted by
                        <a href="#">{{article.author}}</a>
                        {{article.created_at}}</p>
                </div>
                <hr>
                <!-- Pager -->
                <!--<div class="clearfix">-->
                    <!--<a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>-->
                <!--</div>-->
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                articles: [],
                search: '',
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/v1/articles')
                .then(function (resp) {
                    app.articles = resp.data.data;
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
        },
        computed: {
            filteredList() {
                return this.articles.filter(article => {
                    return article.title.toLowerCase().includes(this.search.toLowerCase())
                })
            }
        }
    }
</script>