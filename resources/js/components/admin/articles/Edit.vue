<template>
    <div class="container">
        <div class="panel panel-default">
        <div class="panel-heading"><h1>Edit article</h1></div>
        <div class="panel-body">
            <form v-on:submit="saveForm()" class="col-md-12">
                    <div class="col-xs-12 form-group">
                        <label class="control-label">article name</label>
                        <input type="text" v-model="article.title" class="form-control">
                    </div>

                    <div class="col-xs-12 form-group">
                        <label class="control-label">article Category</label>

                        <select class="form-control"  v-model="article.category_id">
                            <option disabled value="">Please select one</option>
                            <option v-for="cat in categories" v-bind:value="cat.id">{{ cat.name }}</option>
                        </select>

                        <!--<span>Selected: {{ selected }}</span>-->
                        <!--<input type="text" v-model="article.address" class="form-control">-->
                    </div>

                <div class="col-xs-12 form-group">
                    <label class="control-label">Article Content</label>
                    <markdown-editor v-model="article.content"></markdown-editor>
                </div>


                <div class="col-xs-12 form-group">
                    <label class="control-label">Article Author</label>
                    <input type="text" v-model="article.author" class="form-control">
                </div>



                <div class="row">
                    <div class="col-xs-12 form-group">
                        <button class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>

</template>
<script>
    export default {
        mounted() {
            let app = this;
            let id = app.$route.params.id;
            app.articleId = id;
            axios.get('/api/v1/articles/' + id)
                .then(function (resp) {
                    app.article = resp.data.data;
                })
                .catch(function () {
                    alert("Could not load your article")
                });

            axios.get('/api/v1/categories/')
                .then(function (resp) {
                    app.categories = resp.data.data;
                })
                .catch(function () {
                    alert("Could not load your article")
                });
        },
        data: function () {
            return {
                articleId: null,
                article: {
                    name: '',
                    address: '',
                    website: '',
                    email: '',
                },
                categories: []
            }
        },
        methods: {
            saveForm() {
                event.preventDefault();
                var app = this;
                var newarticle = {"title":app.article.title,"category_id":app.article.category_id};
                console.log(newarticle);
                axios.put('/api/v1/articles/' + app.articleId, newarticle)
                    .then(function (resp) {
                        app.$router.replace('/');
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not Update your article");
                    });
            }
        }
    }
</script>