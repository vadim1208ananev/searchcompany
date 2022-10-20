<template>
      <full-preloader v-if="!insideData"></full-preloader>
    <div v-if="insideData" class="container">
        <app-top></app-top>
        <div class="block-form">
            <div class="block-form-items">
                    <div class="block-notify">
                    <div :class="{'light-red':statusFinder=='busy','light-green':statusFinder=='free'}"  class="top-notify">{{getTitle}}</div>
                    <div class="bottom-notify">{{getDescription}}</div>
                </div>
                <div v-if="statusFinder!='free'" class="own-form">
                    <div class="form-items">
                        <input
                                type="text"
                                v-model="finderInput"
                                :placeholder="getInputPlaceholder"
                                @keydown.enter="SendMessage"
                        >
                        <button @click="SendMessage" type="button">{{getBtnText}}</button>
                    </div>
                </div>
                <app-text-area-block  :statusDisplay="statusFinder"></app-text-area-block>
                <div  class="block-link-help"><a :href="getHelpLink">{{getHelpText}}</a></div>
                <div @click="restart" v-if="statusFinder=='free'" class="block-link-free-restart"><a>Restart Your Search</a></div>
            </div>
        </div>
        <app-bottom></app-bottom>
    </div>
</template>
<script>
    import AppTop from "./components/AppTop";
    import AppBottom from "./components/AppBottom";
    import FullPreloader from "./components/FullPreloader";
    import AppTextAreaBlock from "./components/AppTextAreaBlock";
    import {getCaption,sendRequest} from "./api"
    export default {
        name: 'App',
        data() {
            return {
               statusFinder:'default',
                finderInput: '',
                pickedFinderInput:'',
                insideData:'',
            }
        },
        created(){
            this.loadInsideData()
       },
        computed:{
         getTitle(){
             return this.insideData[this.statusFinder].title?this.insideData[this.statusFinder].title.replace('COMPANY-NAME',this.pickedFinderInput):''
         },
         getDescription(){
             return this.insideData[this.statusFinder].description?this.insideData[this.statusFinder].description:''
         },
         getInputPlaceholder(){
             return this.insideData[this.statusFinder].inputPlaceholder?this.insideData[this.statusFinder].inputPlaceholder:''
         },
          getBtnText(){
             return this.insideData[this.statusFinder].btnText?this.insideData[this.statusFinder].btnText:''
          },
          getHelpText(){
              return this.insideData[this.statusFinder].helpText?this.insideData[this.statusFinder].helpText:''
          },
            getHelpLink(){
                return this.insideData[this.statusFinder].helpLink?this.insideData[this.statusFinder].helpLink:''
            }
        },
     methods:{
            restart(){
               this.statusFinder='default'
                this.finderInput=''
            },
            loadInsideData(){
                getCaption(1).then(row=>{
                    console.log(row)
                    this.insideData=row})

            },
            SendMessage() {
                if (!this.finderInput.length) return
                sendRequest(this.finderInput.trim()).then(
                    row=>{
                        console.log(row.status)
                        this.statusFinder=row.status
                        this.pickedFinderInput=this.finderInput
                    }
                )
            }
        },
        components: {
            AppTextAreaBlock,
            FullPreloader,
            AppTop, AppBottom
        }
    }
</script>
<style>

    .light-red{
        color:red;
    }
    .light-green{
        color:green
    }
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
    .block-link-help{
        margin-top: 20px;
        display: flex;
        justify-content: center;
    }
    .block-link-free-restart{
        margin-top: 10px;
        display: flex;
        justify-content: center;
        cursor: pointer;
    }
</style>

/*   setTimeout(()=>{
this.insideData={
default:{title: 'Is Your Company Name Available?',
description: 'Enter your desired company name below to ckeck on Companies House..',
inputPlaceholder: "Enter your desired company name",
btnText: "Check Now default",
helpText:'',
helpLink: ''},
busy:{title: 'Sorrry COMPANY-NAME is Already Register',
description: 'Please try a different name...',
inputPlaceholder: "Enter your desired company name",
btnText: "Check Now busy",
helpText: 'Need hepl?Get tips on how name a company',
helpLink: '/help'},
free:{title: 'Congratulation COMPANY-NAME Is Available',
description: 'Secure your chosen name before its too late...',
inputPlaceholder: "Enter your desired company name",
btnText: "Check Now free",
helpText: '',
helpLink: ''},
}
},1000)*/