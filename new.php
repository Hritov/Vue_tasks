<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html prefix="og: http://ogp.me/ns#" lang="ru">
<head>
<title>Vue приложение</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
<link rel="icon" href="/favicon.ico" type="image/x-icon" />
<link rel="stylesheet/less" type="text/css" href="/new.less" />
<link href="https://fonts.googleapis.com/css?family=Play:400,700&display=swap&subset=cyrillic" rel="stylesheet">
</head>
<body>
<div id="app">
	<div class="head_sort">
	    <h1>{{h1}}</h1>
	    <div class="sort">
	    	<span class="type_sort" @click="sortParam='number_asc'" v-bind:class="{ active: ascActive }">&dArr;</span>
	    	<span class="type_sort" @click="sortParam='number_desc'" v-bind:class="{ active: descActive }">&uArr;</span>
	    </div>
    </div>
    <div class="tasks">
      <div v-for="(card, index) in sortedList.slice(this.startPage, this.endPage)" class="task">
        <p>{{ card.name }}<button v-on:click="removeElement(index)">x</button></p>
      </div>
    </div>

    <div class="pagination">
        <a v-for="(page_number, index) in pageCount" v-on="index+1 !== pageIndex ? { click: () => clickPage(index) } : {}" :class="{ active : index+1 === pageIndex }">{{ index+1 }}</a>
    </div>

    <p class="enter_task">
        <textarea v-model="newCard" :placeholder="[[ placeHolder ]]"></textarea>
        <button v-on="newCard != '' ? { click: () => addElement(newCard, cards.length+1) } : {click: () => PlaceHolderBack()}">Добавить задачу</button>
    </p>
</div>
<script src="https://unpkg.com/vue"></script>
<script>
    var app = new Vue({
        el: '#app',
        data: {
            h1: 'Задачи',
            sortParam: '',
            placeHolder: 'Введите задачу',
            newCard: [],
            ascActive: true,
            descActive: false,
            cards:  [
                    { name: 'Задача 1', number: 1 },
                    { name: 'Задача 2', number: 2 },
                    { name: 'Задача 3', number: 3 },
                    { name: 'Задача 4', number: 4 },
                    { name: 'Задача 5', number: 5 },
                    { name: 'Задача 6', number: 6 },
                    { name: 'Задача 7', number: 7 },
                    { name: 'Задача 8', number: 8 },
                    { name: 'Задача 9', number: 9 },
                    { name: 'Задача 10', number: 10 },
                    { name: 'Задача 11', number: 11 },
                    { name: 'Задача 12', number: 12 },
                    { name: 'Задача 13', number: 13 },
                    { name: 'Задача 14', number: 14 },
                    { name: 'Задача 15', number: 15 },
                    { name: 'Задача 16', number: 16 },
                    { name: 'Задача 17', number: 17 },
                    { name: 'Задача 18', number: 18 },
                    { name: 'Задача 19', number: 19 },
                    { name: 'Задача 20', number: 20 },
                    { name: 'Задача 21', number: 21 }
                    ],
            pageCount: 0,
            cardCount: 10,
            startPage: 0,
            endPage: 10,
            pageIndex: null
        },
        computed:{
            sortedList () {
                switch(this.sortParam){
                    case 'number_asc': this.ascActive = true; this.descActive = false; return this.cards.sort(sortByNumberAsc);
                    case 'number_desc': this.descActive = true; this.ascActive = false; return this.cards.sort(sortByNumberDesc);
                    default: return this.cards;
                }
             }
        },
        mounted(){
            if (localStorage.cards){
                this.cards = JSON.parse(localStorage.cards);
            }
        },
        methods:{
            addElement(new_name, new_number){
                this.cards.push({
                  "name" : new_name,
                  "number" : new_number
                });
                localStorage.cards = JSON.stringify(this.cards);
                this.newCard = "";
            },
            removeElement(index){
                this.cards.splice(index + this.startPage, 1);
                localStorage.cards = JSON.stringify(this.cards);
            },
            clickPage(index){
                this.startPage = index * 10;
                this.endPage = this.startPage + 10;
                this.pageIndex = this.endPage / 10;
            },
            PlaceHolderBack(){
            	this.placeHolder = 'Поле не должно быть пустым';
				setTimeout( ()=> {
            		this.placeHolder = 'Введите задачу';
				}, 1000)
            }
        },
        created(){
            this.pageCount = Math.ceil(this.cards.length / this.cardCount);
            this.pageIndex = this.endPage / 10;
        },
        updated(){
            this.pageCount = Math.ceil(this.cards.length / this.cardCount);
        }
    });
var sortByNumberAsc = function (d1, d2) {return (d1.number > d2.number) ? 1 : -1;};
var sortByNumberDesc = function (d1, d2) {return (d1.number < d2.number) ? 1 : -1;};
</script>

<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.7.3/less.min.js"></script>
</body>
</html>

