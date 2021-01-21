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
    <v-form
    v-model="isFormValid"
    >
        <v-container style="maxWidth: 700px;">
            <v-row>
            <v-text-field
            :counter="50" 
            :rules="[rules.requiredTitle]"
            label="수정할 제목을 입력하세요." 
            name="title" 
            v-model="board.title" 
            maxlength="50" 
            >
            </v-text-field>
            </v-row>
                
                <v-row>
                <v-textarea 
                    filled name="content" 
                    :rules="[rules.requiredContent]"
                    hint="수정할 내용을 입력해주세요." 
                    v-model="board.content" 
                    :counter="1000" 
                    maxlength="1000">
                    
                </v-textarea>
                </v-row>
                <v-row>
                <v-btn
                    block outlined color="blue"
                    :disabled="!isFormValid"
                    @click="modifyClick">
                        수정
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
        board: {
            id: '',
            title: '',
            content: '',
            password: '',
            create_date: '',
            modify_date: ''
        },

        isFormValid: false,

        rules: {
          requiredContent: value => !!value || '내용을 입력하세요.',
          requiredTitle: value => !!value || '제목을 입력하세요.',
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

        modifyClick() { 
            const form = new FormData();
            form.append("id", this.board.id);
            form.append("title", this.board.title);
            form.append("content", this.board.content);
            form.append("password", this.board.password);

            console.log('fetch list') 
            axios.post(`http://localhost/public/boardcontroller/update/${this.board.number}`, form)
            .then((response) => {
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
