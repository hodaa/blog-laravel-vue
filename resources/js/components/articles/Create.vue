<template>
    <div class="panel panel-default">
        <div class="panel-heading">Create new article</div>
        <div class="panel-body">
            <form v-on:submit="saveForm()" class="col-md-12">
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label class="control-label">Article name</label>
                        <input type="text" v-model="article.title" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label class="control-label">Article Category</label>

                        <select class="form-control"  v-model="article.category_id">
                            <option disabled value="">Please select one</option>
                            <option v-for="cat in categories" v-bind:value="cat.id">{{ cat.name }}</option>
                        </select>

                        <!--<span>Selected: {{ selected }}</span>-->
                        <!--<input type="text" v-model="article.address" class="form-control">-->
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 form-group">
                        <button class="btn btn-success">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</template>
<script>
    export default {
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
                categories: []
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