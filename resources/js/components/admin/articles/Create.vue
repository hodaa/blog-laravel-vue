<template>
    <div class="panel panel-default">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Articles</li>
                <li class="breadcrumb-item active" aria-current="page">create new article</li>
            </ol>
        </nav>
        <div class="panel-body">
            <form v-on:submit="saveForm()" class="col-md-12">

                    <div class="col-xs-12 form-group">
                        <label class="control-label">Article name</label>
                        <input type="text" v-model="article.title" class="form-control">
                    </div>


                    <div class="col-xs-12 form-group">
                        <label class="control-label">Article Category</label>

                        <select class="form-control"  v-model="article.category_id">
                            <option disabled value="">Please select one</option>
                            <option v-for="cat in categories"  :value="cat.id" >{{ cat.name }}</option>
                        </select>

                    </div>


                    <div class="col-xs-12 form-group">
                        <label class="control-label">Article Content</label>
                        <markdown-editor v-model="article.content"></markdown-editor>
                    </div>
                <div class="col-xs-12 form-group">
                    <label class="control-label">Published</label>
                   <input type="checkbox" true-value="1"
                          false-value="0" class="control-label"  v-model="article.published"/>
                </div>

                    <div class="col-xs-12 form-group">
                        <label class="control-label">Article Author</label>
                        <input type="text" v-model="article.author" class="form-control">
                    </div>

                    <div class="col-xs-12 form-group">
                        <button class="btn btn-success">Create</button>
                    </div>

            </form>
        </div>
    </div>

</template>

<script>
    import htmlEditor from '../../html-editor'
    export default {
        components: {
            htmlEditor
        },
        mounted() {
            var app = this;
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
                article: {
                    title: '',
                    category_id: '',
                },
                categories: [],
                editor1: '',
            }
        },
        methods: {
            saveForm() {
                event.preventDefault();
                var app = this;
                var newarticle = app.article;
                axios.post('/api/v1/articles', newarticle)
                    .then(function (resp) {
                        app.$router.push({path: '/'});
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your article");
                    });
            }
        }
    }
</script>