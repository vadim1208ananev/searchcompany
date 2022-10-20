<template>
      <full-preloader v-if="!insideData"></full-preloader>
    <div v-if="insideData" class="container">
        <app-top></app-top>
        <div class="block-form">
            <div class="block-form-items">
                {{statusFinder}}
                <div class="block-notify">
                    <div class="top-notify">{{getTitle}}</div>
                    <div class="bottom-notify">{{description}}</div>
                </div>
                <div class="own-form">
                    <div class="form-items">
                        <input
                                type="text"
                                v-model="finder"
                                :placeholder="btnPlaceholder"
                                @keydown.enter="SendMessage"
                        >
                        <button @click="SendMessage" type="button">{{btnText}}</button>
                    </div>
                </div>
                <div v-if="statusFinder=='busy'" class="block-link"><a :href="lowerlinkUrl">{{lowerlinkText}}</a></div>
                <div @click="restart" v-if="statusFinder=='free'" class="block-link-free-restart"><a >{{linkRestartText}}</a></div>

            </div>
        </div>
        <app-bottom></app-bottom>
    </div>
</template>
<script>
    import AppTop from "./components/AppTop";
    import AppBottom from "./components/AppBottom";
    import FullPreloader from "./components/FullPreloader";

    export default {
        name: 'App',
        data() {
            return {
                statusFinder:'default',
                finder: '',
                title: 'Is Your Company Name Available?',
                description: 'Enter your desired company name below to ckeck on Companies House..',
                btnPlaceholder: "Enter your desired company name",
                btnText: "Check Now",
                lowerlinkText: 'Need hepl?Get tips on how name a company',
                linkRestartText:'Restart Your Search',
                lowerlinkUrl: '/help',
                insideData:'',
            }
        },
        created(){
            this.loadInsideData()
       },
        computed:{
         getTitle(){

             return this.insideData[this.statusFinder].title
         }
        },
     methods:{
            restart(){
               this.statusFinder='default'
                this.finder=''
            },
            loadInsideData(){
                setTimeout(()=>{
                   this.insideData={

                       default:{title: 'Is Your Company Name Available?default',
                           description: 'Enter your desired company name below to ckeck on Companies House..',
                           btnPlaceholder: "Enter your desired company name",
                           btnText: "Check Now",
                           lowerlinkText: 'Need hepl?Get tips on how name a company',
                           linkRestartText:'Restart Your Search',
                           lowerlinkUrl: '/help'},

                       busy:{title: 'Is Your Company Name Available?busy',
                           description: 'Enter your desired company name below to ckeck on Companies House..',
                           btnPlaceholder: "Enter your desired company name",
                           btnText: "Check Now",
                           lowerlinkText: 'Need hepl?Get tips on how name a company',
                           linkRestartText:'Restart Your Search',
                           lowerlinkUrl: '/help'},
                       free:{title: 'Is Your Company Name Available?free',
                           description: 'Enter your desired company name below to ckeck on Companies House..',
                           btnPlaceholder: "Enter your desired company name",
                           btnText: "Check Now",
                           lowerlinkText: 'Need hepl?Get tips on how name a company',
                           linkRestartText:'Restart Your Search',
                           lowerlinkUrl: '/help'},
                   }
                },1000)
            },
            SendMessage() {
                if (!this.finder.length) return
                var formdata = new FormData();
                formdata.append("search_param", this.finder.trim())
                var requestOptions={
                    method: 'POST',
                    body:formdata,
                }
                fetch(`http://search.loc/api.php`,requestOptions)
                    .then(res=>res.json())
                    .then(row=>{
                        console.log(row.status)
                        this.statusFinder=row.status

                    });
            }
        },
        components: {
            FullPreloader,
            AppTop, AppBottom
        }
    }
</script>
<style>

    .container {
        display: flex;
        flex-direction: column;
        max-width: 1410px;
        margin: 0 auto;
    }
    .top-block {
        margin-bottom: 20px;
    }
    .bottom-block {
        margin-top: 20px;
    }
    .top-notify {
        font-weight: bold;
    }
    .own-form {
        margin-top: 20px;
    }
    .block-form {
        display: flex;
        flex-direction: row;
        justify-content: center;
    }
    .block-link{
        margin-top: 20px;
        display: flex;
        justify-content: center;
    }
    .block-link-free-restart{
        margin-top: 20px;
        display: flex;
        justify-content: center;
        cursor: pointer;
    }
</style>

