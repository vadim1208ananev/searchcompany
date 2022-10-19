<template>
    <div class="container">
        <app-top></app-top>
        <div class="block-form">
            <div class="block-form-items">
                <div class="block-notify">
                    <div class="top-notify">{{title}}</div>
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
            </div>
        </div>
        <app-bottom></app-bottom>
    </div>
</template>
<script>
    import AppTop from "./components/AppTop";
    import AppBottom from "./components/AppBottom";

    export default {
        name: 'App',
        data() {
            return {
                finder: '',
                title: 'Is Your Company Name Available?',
                description: 'Enter your desired company name below to ckeck on Companies House..',
                btnPlaceholder: "Enter your desired company name",
                btnText: "Check Now",
                lowerlinkText: '',
                lowerlinkUrl: '',
            }
        },
        methods: {
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
                    .then(row=>{console.log(row);});
            }
        },
        components: {
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
</style>

