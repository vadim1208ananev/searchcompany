<template>
    <div v-if="statusDisplay=='free'" class="textareablock">
        <div class="textareablock-b1">
            <div class="textareablock-b1-title">our-use-top-rade</div>
            <div class="textareablock-b1-button"><button class="textareablock-b1-button-button" >register now</button></div>
        </div>
        <div class="textareablock-b1">
            <div class="textareablock-b1-title">compare-formation</div>
            <div class="textareablock-b1-button"><button class="textareablock-b1-button-button"> read review</button></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AppTextAreaBlock",
        props:
            ['statusDisplay']
    }
</script>

<style>
    .textareablock{
        margin:10px;
        display: flex;
        gap:20px
    }
</style>