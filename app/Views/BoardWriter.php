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
    <v-app>
    <v-container>
    <v-card
    class="mx-auto"
    max-width="800"
    height="500"
    elevation="10"
    >
    <v-app-bar
    color="cyan"
    dark
    > 
      글 작성하기
    </v-app-bar>
    <v-form
    v-model="isFormValid"
    >
        <v-container style="maxWidth: 500px;">
            <v-row>
            <v-text-field
            :counter="50" 
            :rules="[rules.requiredTitle]"
            label="제목" 
            name="title" 
            v-model="title" 
            maxlength="50" >
            </v-text-field>
            </v-row>
            <v-row>
            <v-text-field
            :counter="10" 
            :rules="[rules.requiredId]"
            label="작성자" 
            name="id" 
            v-model="id" 
            maxlength="10" >
            </v-text-field>
            </v-row>
                <v-row>
                <v-textarea 
                    filled name="content" 
                    :rules="[rules.requiredContent]"
                    v-model="content" 
                    :counter="1000" 
                    maxlength="1000" >
                </v-textarea>
                </v-row>
                <v-row>
                <v-text-field
                :counter="4" 
                :rules="[rules.requiredPassword, rules.passwordRule, rules.passwordRuleMin]"
                label="비밀번호" 
                name="password" 
                v-model="password"
                minlength="4"
                maxlength="4" >
                </v-text-field>
                </v-row>
                
                <v-row>
                <v-btn
                    :disabled="!isFormValid"
                    block outlined color="blue"
                    @click="writeClick">
                        등록
                </v-btn>
                </v-row>
        </v-container>
    </v-form>
    </v-card>
    </v-container>
    </v-app>
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
        password: '',

        isFormValid: false,

        rules: {
          requiredContent: value => !!value || '내용을 입력하세요.',
          requiredId: value => !!value || '작성자를 입력하세요.',
          requiredTitle: value => !!value || '제목을 입력하세요.',
          requiredPassword: value => !!value || '비밀번호를 입력하세요.',
          passwordRuleMin: v => v.length >= 4 || '비밀번호는 4글자여야 합니다.',
          passwordRule: v  => {
                                if (!v.trim()) return true;
                                if (!isNaN(v) && v >= 0000 && v <= 9999) return true;
                                  return '0000 부터 9999까지만 가능합니다.';
                            },
        }
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
