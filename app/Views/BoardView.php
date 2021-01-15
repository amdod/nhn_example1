<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta charset="utf-8"/>
    <title>
        게시판
    </title>
</head>
<body>


<div id="app">
<template>
        <v-container>
        <v-app-bar> 
        {{board['title']}}
        </v-app-bar> 
            <v-card width="100%" height="400" elevation="10">
             
            <v-card-subtitle>
            <p> 작성자: {{board['id']}} </br>
             작성 날짜: {{board['modify_date']}}</p>
             </v-card-subtitle>
             <v-card-text>
            <div class="text--primary">
                {{board['content']}}
            </div>
            </v-card-text>
            </v-card>

            <div align="left">
            <v-btn color="black" @click="modifyCLick">
            수정하기
            </v-btn>

            <v-btn color="black" @click="deleteClick">
            삭제하기
            </v-btn>
            </div>

            <div align="right">
            <v-btn color="black" @click="listClick">
            목록으로
            </v-btn>
            </div>

        </v-container>
</template>
</div>


<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>


<script> 

new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    
    data: {
        board: {
            id: '',
            title: '',
            content: '',
            password: '',
            create_date: '',
            modify_date: ''
        }
      },

    created() { 
        this.fetch()
    }, 
    
    methods: { 
        fetch() { 
            const data = location.pathname.split('/');
            const number = data[data.length - 1];
            console.log('fetch list') 
            axios.get(`http://localhost/public/boardcontroller/board/${number}`)
            .then((response) => {
                console.log(response)
                this.board = response.data;
            })
            .catch((error) => {
                console.log(error) 
            })
            },
        listClick() { 
            window.location.href = `http://localhost/public/home`
        }, 
        deleteClick() {
            const data = location.pathname.split('/');
            const number = data[data.length - 1];
            axios.get(`http://localhost/public/boardcontroller/delete/${number}`)
            .then((response) => {
                console.log(response)
                window.location.href = `http://localhost/public/home`
            })
            .catch((error) => {
                console.log(error) 
            })
        },
        modifyClick() { 
            window.location.href = `http://localhost/public/home`
        }
    
    }
})

</script> 

</body>
</html>