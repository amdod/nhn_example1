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
        <v-container style="maxWidth: 700px;">
        <v-app-bar
        color = "black"
        > 
        <span class="white--text">{{board['title']}}</span>
        </v-app-bar> 
        <v-col></v-col>
            <v-card width="100%" height="400" elevation="10">
             
            <v-card-subtitle>
            <p> 작성자: {{board['id']}} </br>
             날짜: {{board['modify_date']}}</p>
             </v-card-subtitle>
             <v-card-text>
            <div class="text--primary">
                {{board['content']}}
            </div>
            </v-card-text>
            </v-card>
            
            <v-dialog
                v-model="dialog1"
                persistent
                max-width="290"
              >
                <template v-slot:activator="{ on, attrs }">
                <v-btn 
                    color="grey lighten-2"
                    v-bind="attrs"
                    v-on="on"
                >
                    <span class="blue--text">수정하기</span>
                </v-btn>
                </template>
                <v-card>
                <v-card-title
                    class="subtitle-1"
                    align="center"
                >
                  <span class="blue--text">수정하려면 비밀번호를 입력하세요.</span>
                </v-card-title>
                
                <v-text-field
                    class="ma-5"
                    v-model="input_password_modify"
                    :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                    :rules="[rules.requiredPassword, rules.passwordRuleMin, rules.passwordRule]"
                    :type="show1 ? 'text' : 'password'"
                    label="0000~9999사이의 비밀번호"
                    counter
                    @click:append="show1 = !show1"
                ></v-text-field>
                <v-card-actions>
                <v-spacer></v-spacer>
                  <v-btn
                    color="green darken-1"
                    text
                    @click="dialog1 = false"
                  >
                    아니오
                </v-btn>
                <v-btn
                  color="green darken-1"
                  text
                  @click="modifyCheck"
                  >
                    예
                </v-btn>
                </v-card-actions>
              </v-card>
              </v-dialog>

            <!-- <v-col>
            <div align="left">
            <v-btn color="grey lighten-2" @click="modifyClick">
            <span class="blue--text">수정하기</span>
            </v-btn> -->

            <v-dialog
                v-model="dialog2"
                persistent
                max-width="290"
              >
                <template v-slot:activator="{ on, attrs }">
                <v-btn 
                    color="grey lighten-2"
                    v-bind="attrs"
                    v-on="on"
                >
                    <span class="red--text">삭제하기</span>
                </v-btn>
                </template>
                <v-card>
                <v-card-title
                    class="subtitle-1"
                    align="center"
                >
                  <span class="red--text">삭제하려면 비밀번호를 입력하세요.</span>
                </v-card-title>
                
                <v-text-field
                    class="ma-5"
                    v-model="input_password_delete"
                    :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                    :rules="[rules.requiredPassword, rules.passwordRuleMin, rules.passwordRule]"
                    :type="show1 ? 'text' : 'password'"
                    label="0000~9999사이의 비밀번호"
                    counter
                    @click:append="show1 = !show1"
                ></v-text-field>
                <v-card-actions>
                <v-spacer></v-spacer>
                  <v-btn
                    color="green darken-1"
                    text
                    @click="dialog2 = false"
                  >
                    아니오
                </v-btn>
                <v-btn
                  color="green darken-1"
                  text
                  @click="deleteCheck"
                  >
                    예
                </v-btn>
                </v-card-actions>
              </v-card>
              </v-dialog>
            
            <!-- <v-btn color="grey lighten-2" @click="deleteClick">
            <span class="red--text">삭제하기</span>
            </v-btn>
            </div> -->
            </v-col>
            
            <div align="right">
            <v-btn color="grey lighten-2" @click="listClick">
            <span class="black--text">목록으로</span>
            </v-btn>
            </div>
            

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
        board: {
            id: '',
            title: '',
            content: '',
            password: '',
            create_date: '',
            modify_date: ''
        },
        show1: false,
        rules: {
            requiredPassword: value => !!value || '비밀번호를 입력하세요.',
            passwordRuleMin: v => v.length == 4 || '비밀번호는 4글자여야 합니다.',
            passwordRule: v  => {
                                if (!v.trim()) return true;
                                if (!isNaN(v) && v >= 0000 && v <= 9999) return true;
                                  return '0000 부터 9999까지만 가능합니다.';
                            },
        },
        input_password_modify: '',
        input_password_delete: '',
        dialog1: false,
        dialog2: false,
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

        deleteCheck() {
            if (this.input_password_delete == this.board.password) {
                this.deleteClick();
            }
            else{
                this.dialog2 = false;
                alert("패스워드가 다릅니다.");
            }
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

        modifyCheck() {
            if (this.input_password_modify == this.board.password) {
                this.modifyClick();
            }
            else{
                this.dialog1 = false;
                alert("패스워드가 다릅니다.");
            }
        },
        modifyClick() { 
            const temp = location.pathname.split('/');
            const idx = temp[temp.length - 1];
            window.location.href = `http://localhost/public/home/boardmodify/${idx}`;
        }
    
    }
})

</script> 

</body>
</html>