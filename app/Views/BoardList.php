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
        <v-container>
            <v-data-table 
                :headers="headers" 
                :items="board" 
                :items-per-page="5" 
                class="elevation-1" 
                @click:row="rowClick" 
            > 
            </v-data-table> 
            <v-row> 
                <v-btn outlined color="blue" @click="writeClick" > 작성 </v-btn>
            </v-row>
        </v-container>
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
            window.location.href = `./home/boardwrite` 
        }, 
        rowClick(number) {
            window.location.href = `./home/boardview/${number}`;
        } },

        data () {
            return { 
                headers: [ 
                    { 
                        text: 'Number', 
                        align: 'left', 
                        sortable: false, 
                        value: 'number', 
                    }, 
                    { text: 'Title', value: 'title' }, 
                    { text: 'Create Date', value: 'create_date' },
                    { text: 'Update Date', value: 'modify_date' }
                ], 
            board: [], 
        }
    }
})

</script> 

</body>
</html>