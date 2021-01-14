<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta charset="utf-8"/>
    <title>
        글쓰기
    </title>
</head>
<body>

<div id="app-1">
    <template>
    <v-app-bar> 
      실습과제 1 게시판 만들기
    </v-app-bar> 
    </template>
</div>

<div id="app-2">
<template>
    <v-form>
        <v-container>
            <v-row>
                제목
            </v-row>
            <v-row>
                {{ title }}
            </v-row>
            <v-row>
                내용
            </v-row>
            <v-row>
                {{ content }}
            </v-row>
            <v-row>
            <v-btn block outlined color="blue" @click="listClick"> 목록 </v-btn>
            </v-row>
        </v-container>
    </v-form>
</template>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
new Vue({
  el: '#app-1',
  vuetify: new Vuetify(),
})
</script>

<script> 

new Vue({
    el: '#app-2',
    vuetify: new Vuetify(),
    
    created() { 
        this.fetch()
    }, 
    
    methods: { 
        fetch() { 
            console.log('fetch list') 
            axios.get('http://localhost/public/boardcontroller/board/${number}')
            .then((response) => {
                console.log(response)
                this.board = response.data;
            })
            .catch((error) => {
                console.log(error) 
            })
            },
        listClick() { 
            window.location.href = `./home`
        }, 
        deleteClick(item) {
            this.$router.push('/view/' + item.seq)
        } },

        data() {
            return {
                title : "",
                content: ""
            }
        }
    
})

</script> 

</body>
</html>