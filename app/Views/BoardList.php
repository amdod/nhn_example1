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

<div id="app-1">
    <template>
    <v-app-bar> 
      실습과제 1 게시판 만들기
    </v-app-bar> 
    </template>
</div>

<div id="app-2"> 
    <template>
    <v-app>
        <v-container style="maxWidth: 900px;">
            <v-simple-table>
            <template v-slot:default>
            <thead>
            <tr>
                <th class="text-left">
                    글 번호
                    </th>
                <th class="text-left">
                제목
                </th>  
                <th class="text-left">
                작성자
                </th>
                <th class="text-left">
                글 생성 날짜
                </th>
                <th class="text-left">
                글 수정 날짜
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in board"
                :key = "item.number"
                @click="rowClick(item.number)"
            >
                <td>{{ item.number }}</td>
                <td>{{ item.title }}</td>
                <td>{{ item.id }}</td>
                <td>{{ item.create_date }}</td>
                <td>{{ item.modify_date }}</td>
            </tr>
            </tbody>
            </template>
            </v-simple-table>

            
        </v-container>

        <v-container style="maxWidth: 900px;">
                <v-btn @click="writeClick">
                    글쓰기
                </v-btn>
        
        <div align="right">
        <span class="grey--text">정렬: 최근 업데이트 순</span>

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
            axios.get('http://localhost/public/boardcontroller/index')
            .then((response) => {
                console.log(response)
                this.board = response.data;
            })
            .catch((error) => {
                console.log(error) 
            })
            },
        writeClick() { 
            window.location.href = `http://localhost/public/home/boardwrite` 
        }, 
        rowClick(number) {
            window.location.href = `http://localhost/public/home/boardview/${number}`;
        } },

        data () {
            return { 
            board: [], 
        }
    }
})

</script> 

</body>
</html>