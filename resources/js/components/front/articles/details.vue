<template>
    <div class="container">
        <div><h1>{{article.title}}</h1></div>
    <div>{{article.content}}</div>
    <div class="panel-heading">Comment</div>
    <div class="panel-body">
        <form v-on:submit="comment()" class="col-md-12">
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label class="control-label">Comment Name</label>
                    <textarea></textarea>
                </div>
            </div>


            <div class="row">
                <div class="col-xs-12 form-group">
                    <button class="btn btn-success">Add Comment</button>
                </div>
            </div>
        </form>
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
        },
        data: function () {
            return{
                article:{
                    content:''
                }
            }
        },
        methods:{
            comment() {
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
