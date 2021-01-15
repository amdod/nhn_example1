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
    <v-form>
        <v-container>
            <v-row>
                제목
            </v-row>
            <v-row>
            <v-text-field
            :counter="50" 
            label="제목" 
            name="title" 
            v-model="title" 
            maxlength="50" >
            </v-text-field>
            </v-row>
            <v-row>
                작성자
            </v-row>
            <v-row>
            <v-text-field
            :counter="10" 
            label="작성자" 
            name="id" 
            v-model="id" 
            maxlength="10" >
            </v-text-field>
            </v-row>
                <v-row>
                    내용
                </v-row>
                <v-row>
                <v-textarea 
                    filled name="content" 
                    hint="내용을 입력해주세요." 
                    v-model="content" 
                    :counter="1000" 
                    maxlength="1000" >
                </v-textarea>
                </v-row>
                <v-row>
                비밀번호
                </v-row>
                <v-row>
                <v-text-field
                :counter="4" 
                label="비밀번호" 
                name="password" 
                v-model="password" 
                maxlength="4" >
                </v-text-field>
                </v-row>
                
                <v-row>
                <v-btn
                    block outlined color="blue"
                    @click="writeClick">
                        등록
                </v-btn>
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
    el: '#app',
    vuetify: new Vuetify(),
    data: {
        id: '',
        title: '',
        content: '',
        password: ''
      },

    methods: { 
        writeClick() { 
            const form = new FormData();
            form.append("id", this.id);
            form.append("title", this.title);
            form.append("content", this.content);
            form.append("password", this.password);
            

            console.log('fetch list') 
            axios.post(`http://localhost/public/boardcontroller/create`, form)
            .then((response) => {
                console.log(response)
                window.location.href = `http://localhost/public/home`
            })
            .catch((error) => {
                console.log(error) 
            })
            },


    }
})

</script> 

</body>
</html>
