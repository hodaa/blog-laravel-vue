<template>
    <div class="container">
        <div><h1>{{article.title}}</h1></div>

    <div>{{article.content}}</div>
<hr>
    <div class="panel-body">
        <form v-on:submit="comment()" class="col-md-12">
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label class="control-label"><h4> Add Comment</h4></label>
                    <textarea class="form-control rounded-0" id="exampleFormControlTextarea1" rows="6" cols="80"></textarea>
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
