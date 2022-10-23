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
                getCaption().then(row=>{
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
    /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */

    /* Document
       ========================================================================== */

    /**
     * 1. Correct the line height in all browsers.
     * 2. Prevent adjustments of font size after orientation changes in iOS.
     */

    html {
        line-height: 1.15; /* 1 */
        -webkit-text-size-adjust: 100%; /* 2 */
    }

    /* Sections
       ========================================================================== */

    /**
     * Remove the margin in all browsers.
     */

    body {
        margin: 0;
    }

    /**
     * Render the `main` element consistently in IE.
     */

    main {
        display: block;
    }

    /**
     * Correct the font size and margin on `h1` elements within `section` and
     * `article` contexts in Chrome, Firefox, and Safari.
     */

    h1 {
        font-size: 2em;
        margin: 0.67em 0;
    }

    /* Grouping content
       ========================================================================== */

    /**
     * 1. Add the correct box sizing in Firefox.
     * 2. Show the overflow in Edge and IE.
     */

    hr {
        box-sizing: content-box; /* 1 */
        height: 0; /* 1 */
        overflow: visible; /* 2 */
    }

    /**
     * 1. Correct the inheritance and scaling of font size in all browsers.
     * 2. Correct the odd `em` font sizing in all browsers.
     */

    pre {
        font-family: monospace, monospace; /* 1 */
        font-size: 1em; /* 2 */
    }

    /* Text-level semantics
       ========================================================================== */

    /**
     * Remove the gray background on active links in IE 10.
     */

    a {
        background-color: transparent;
    }

    /**
     * 1. Remove the bottom border in Chrome 57-
     * 2. Add the correct text decoration in Chrome, Edge, IE, Opera, and Safari.
     */

    abbr[title] {
        border-bottom: none; /* 1 */
        text-decoration: underline; /* 2 */
        text-decoration: underline dotted; /* 2 */
    }

    /**
     * Add the correct font weight in Chrome, Edge, and Safari.
     */

    b,
    strong {
        font-weight: bolder;
    }

    /**
     * 1. Correct the inheritance and scaling of font size in all browsers.
     * 2. Correct the odd `em` font sizing in all browsers.
     */

    code,
    kbd,
    samp {
        font-family: monospace, monospace; /* 1 */
        font-size: 1em; /* 2 */
    }

    /**
     * Add the correct font size in all browsers.
     */

    small {
        font-size: 80%;
    }

    /**
     * Prevent `sub` and `sup` elements from affecting the line height in
     * all browsers.
     */

    sub,
    sup {
        font-size: 75%;
        line-height: 0;
        position: relative;
        vertical-align: baseline;
    }

    sub {
        bottom: -0.25em;
    }

    sup {
        top: -0.5em;
    }

    /* Embedded content
       ========================================================================== */

    /**
     * Remove the border on images inside links in IE 10.
     */

    img {
        border-style: none;
    }

    /* Forms
       ========================================================================== */

    /**
     * 1. Change the font styles in all browsers.
     * 2. Remove the margin in Firefox and Safari.
     */

    button,
    input,
    optgroup,
    select,
    textarea {
        font-family: inherit; /* 1 */
        font-size: 100%; /* 1 */
        line-height: 1.15; /* 1 */
        margin: 0; /* 2 */
    }

    /**
     * Show the overflow in IE.
     * 1. Show the overflow in Edge.
     */

    button,
    input { /* 1 */
        overflow: visible;
    }

    /**
     * Remove the inheritance of text transform in Edge, Firefox, and IE.
     * 1. Remove the inheritance of text transform in Firefox.
     */

    button,
    select { /* 1 */
        text-transform: none;
    }

    /**
     * Correct the inability to style clickable types in iOS and Safari.
     */

    button,
    [type="button"],
    [type="reset"],
    [type="submit"] {
        -webkit-appearance: button;
    }

    /**
     * Remove the inner border and padding in Firefox.
     */

    button::-moz-focus-inner,
    [type="button"]::-moz-focus-inner,
    [type="reset"]::-moz-focus-inner,
    [type="submit"]::-moz-focus-inner {
        border-style: none;
        padding: 0;
    }

    /**
     * Restore the focus styles unset by the previous rule.
     */

    button:-moz-focusring,
    [type="button"]:-moz-focusring,
    [type="reset"]:-moz-focusring,
    [type="submit"]:-moz-focusring {
        outline: 1px dotted ButtonText;
    }

    /**
     * Correct the padding in Firefox.
     */

    fieldset {
        padding: 0.35em 0.75em 0.625em;
    }

    /**
     * 1. Correct the text wrapping in Edge and IE.
     * 2. Correct the color inheritance from `fieldset` elements in IE.
     * 3. Remove the padding so developers are not caught out when they zero out
     *    `fieldset` elements in all browsers.
     */

    legend {
        box-sizing: border-box; /* 1 */
        color: inherit; /* 2 */
        display: table; /* 1 */
        max-width: 100%; /* 1 */
        padding: 0; /* 3 */
        white-space: normal; /* 1 */
    }

    /**
     * Add the correct vertical alignment in Chrome, Firefox, and Opera.
     */

    progress {
        vertical-align: baseline;
    }

    /**
     * Remove the default vertical scrollbar in IE 10+.
     */

    textarea {
        overflow: auto;
    }

    /**
     * 1. Add the correct box sizing in IE 10.
     * 2. Remove the padding in IE 10.
     */

    [type="checkbox"],
    [type="radio"] {
        box-sizing: border-box; /* 1 */
        padding: 0; /* 2 */
    }

    /**
     * Correct the cursor style of increment and decrement buttons in Chrome.
     */

    [type="number"]::-webkit-inner-spin-button,
    [type="number"]::-webkit-outer-spin-button {
        height: auto;
    }

    /**
     * 1. Correct the odd appearance in Chrome and Safari.
     * 2. Correct the outline style in Safari.
     */

    [type="search"] {
        -webkit-appearance: textfield; /* 1 */
        outline-offset: -2px; /* 2 */
    }

    /**
     * Remove the inner padding in Chrome and Safari on macOS.
     */

    [type="search"]::-webkit-search-decoration {
        -webkit-appearance: none;
    }

    /**
     * 1. Correct the inability to style clickable types in iOS and Safari.
     * 2. Change font properties to `inherit` in Safari.
     */

    ::-webkit-file-upload-button {
        -webkit-appearance: button; /* 1 */
        font: inherit; /* 2 */
    }

    /* Interactive
       ========================================================================== */

    /*
     * Add the correct display in Edge, IE 10+, and Firefox.
     */

    details {
        display: block;
    }

    /*
     * Add the correct display in all browsers.
     */

    summary {
        display: list-item;
    }

    /* Misc
       ========================================================================== */

    /**
     * Add the correct display in IE 10+.
     */

    template {
        display: none;
    }

    /**
     * Add the correct display in IE 10.
     */

    [hidden] {
        display: none;
    }

    /**
     * Fonts
     */

    /* cyrillic-ext */
    @font-face {
        font-family: 'Nunito';
        font-style: normal;
        font-weight: 400;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/nunito/v25/XRXV3I6Li01BKofIOOaBXso.woff2) format('woff2');
        unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
    }
    /* cyrillic */
    @font-face {
        font-family: 'Nunito';
        font-style: normal;
        font-weight: 400;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/nunito/v25/XRXV3I6Li01BKofIMeaBXso.woff2) format('woff2');
        unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
    }
    /* vietnamese */
    @font-face {
        font-family: 'Nunito';
        font-style: normal;
        font-weight: 400;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/nunito/v25/XRXV3I6Li01BKofIOuaBXso.woff2) format('woff2');
        unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
    }
    /* latin-ext */
    @font-face {
        font-family: 'Nunito';
        font-style: normal;
        font-weight: 400;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/nunito/v25/XRXV3I6Li01BKofIO-aBXso.woff2) format('woff2');
        unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
    }
    /* latin */
    @font-face {
        font-family: 'Nunito';
        font-style: normal;
        font-weight: 400;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/nunito/v25/XRXV3I6Li01BKofINeaB.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
    }
    /* cyrillic-ext */
    @font-face {
        font-family: 'Nunito';
        font-style: normal;
        font-weight: 500;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/nunito/v25/XRXV3I6Li01BKofIOOaBXso.woff2) format('woff2');
        unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
    }
    /* cyrillic */
    @font-face {
        font-family: 'Nunito';
        font-style: normal;
        font-weight: 500;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/nunito/v25/XRXV3I6Li01BKofIMeaBXso.woff2) format('woff2');
        unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
    }
    /* vietnamese */
    @font-face {
        font-family: 'Nunito';
        font-style: normal;
        font-weight: 500;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/nunito/v25/XRXV3I6Li01BKofIOuaBXso.woff2) format('woff2');
        unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
    }
    /* latin-ext */
    @font-face {
        font-family: 'Nunito';
        font-style: normal;
        font-weight: 500;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/nunito/v25/XRXV3I6Li01BKofIO-aBXso.woff2) format('woff2');
        unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
    }
    /* latin */
    @font-face {
        font-family: 'Nunito';
        font-style: normal;
        font-weight: 500;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/nunito/v25/XRXV3I6Li01BKofINeaB.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
    }
    /* cyrillic-ext */
    @font-face {
        font-family: 'Nunito';
        font-style: normal;
        font-weight: 700;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/nunito/v25/XRXV3I6Li01BKofIOOaBXso.woff2) format('woff2');
        unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
    }
    /* cyrillic */
    @font-face {
        font-family: 'Nunito';
        font-style: normal;
        font-weight: 700;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/nunito/v25/XRXV3I6Li01BKofIMeaBXso.woff2) format('woff2');
        unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
    }
    /* vietnamese */
    @font-face {
        font-family: 'Nunito';
        font-style: normal;
        font-weight: 700;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/nunito/v25/XRXV3I6Li01BKofIOuaBXso.woff2) format('woff2');
        unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
    }
    /* latin-ext */
    @font-face {
        font-family: 'Nunito';
        font-style: normal;
        font-weight: 700;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/nunito/v25/XRXV3I6Li01BKofIO-aBXso.woff2) format('woff2');
        unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
    }
    /* latin */
    @font-face {
        font-family: 'Nunito';
        font-style: normal;
        font-weight: 700;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/nunito/v25/XRXV3I6Li01BKofINeaB.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
    }
    /* cyrillic-ext */
    @font-face {
        font-family: 'Nunito';
        font-style: normal;
        font-weight: 800;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/nunito/v25/XRXV3I6Li01BKofIOOaBXso.woff2) format('woff2');
        unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
    }
    /* cyrillic */
    @font-face {
        font-family: 'Nunito';
        font-style: normal;
        font-weight: 800;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/nunito/v25/XRXV3I6Li01BKofIMeaBXso.woff2) format('woff2');
        unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
    }
    /* vietnamese */
    @font-face {
        font-family: 'Nunito';
        font-style: normal;
        font-weight: 800;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/nunito/v25/XRXV3I6Li01BKofIOuaBXso.woff2) format('woff2');
        unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
    }
    /* latin-ext */
    @font-face {
        font-family: 'Nunito';
        font-style: normal;
        font-weight: 800;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/nunito/v25/XRXV3I6Li01BKofIO-aBXso.woff2) format('woff2');
        unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
    }
    /* latin */
    @font-face {
        font-family: 'Nunito';
        font-style: normal;
        font-weight: 800;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/nunito/v25/XRXV3I6Li01BKofINeaB.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
    }

    /**
     * General Styles
     */

    *, *:before, *:after {
        box-sizing: border-box;
    }

    html {
        font-size: 100%;
    }

    body {
        position: relative;
        background-color: #fff;
        font-family: 'Nunito', sans-serif;
        font-size: 18px;
        font-weight: 500;
        line-height: 1.5;
        color: #293845;
        overflow-x: hidden;
        -webkit-font-smoothing: antialiased;
        -webkit-text-size-adjust: none;
        -moz-osx-font-smoothing: grayscale;
        text-rendering: optimizeLegibility;
    }

    img {
        display: inline-block;
        max-width: 100%;
        height: auto;
        vertical-align: middle;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin-top: 0;
    }

    p {
        margin: 0 0 30px;
    }

    a {
        text-decoration: underline;
        font-weight: 700;
        color: #2C88D9;
        transition: color .3s ease;
    }

    a:hover {
        color: #186ab2;
    }

    a[href*="mailto:"],
    a[href*="tel:"] {
        word-wrap: break-word;
    }

    input,
    textarea,
    select,
    button {
        font-family: inherit;
        font-size: inherit;
        color: inherit;
        outline: none;
    }
    .block-link-free-restart {

        cursor:pointer;
    }

    input,
    textarea {
        box-shadow: none;
    }

    input, button {
        -webkit-appearance: none;
        -moz-appearance:    none;
        appearance:         none;
    }

    input {
        height: 45px;
        padding: 0 15px;
        border: 2px solid #C5CED6;
        border-radius: 6px;
        transition: border-color .3s ease;
    }

    input:focus {
        border-color: #a0a6aa;
    }

    input::placeholder {
        color: #C3CFD9;
    }

    button {
        height: 45px;
        border: none;
        border-radius: 6px;
        background-color: #6558F5;
        font-weight: 700;
        color: #fff;
        transition: background-color .3s ease;
        cursor: pointer;
    }

    textarea {
        resize: none;
    }

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .container {
        width: 100%;
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 50px;
    }

    .light-red {
        color: #D3455B;
    }

    .light-green {
        color: #1AAE9F;
    }

    /**
     * Form Styles
     */

    #app {
        padding: 80px 0;
    }

    .top-block {
        margin-bottom: 60px;
    }

    .top-title {
        text-align: center;
    }

    .top-title > * {
        margin-bottom: 40px;
        font-size: 2.3em;
        font-weight: 800;
    }

    .block-notify {
        margin-bottom: 30px;
    }

    .top-notify {
        margin-bottom: 15px;
        font-size: 1.7em;
        font-weight: 700;
    }

    .form-items {
        display: flex;
        gap: 20px;
        width: 90%;
    }

    .form-items input {
        width: 67%;
    }

    .form-items button {
        flex: 1;
        height: 50px;
        border: none;
        border-radius: 6px;
        background-color: #6558F5;
        font-weight: 700;
        color: #fff;
        transition: background-color .3s ease;
    }

    .form-items button:hover {
        background-color: #4c40e8;
    }

    .block-link-help,
    .block-link-free-restart {
        margin-top: 30px;
        text-align: center;
    }

    .textareablock {
        display: flex;
    }

    .textareablock-b1 {
        width: 50%;
        padding: 20px;
        text-align: center;
    }

    .textareablock-b1-title {
        margin-bottom: 15px;
        font-size: 20px;
        font-weight: 700;
    }

    .textareablock-b1:nth-child(odd) {
        border-right: 2px solid #9EADBA;
    }

    .textareablock-b1:nth-child(odd) .textareablock-b1-button-button {
        background-color: #1AAE9F;
    }

    .textareablock-b1:nth-child(odd) .textareablock-b1-button-button:hover {
        background-color: #0e9384;
    }

    .textareablock-b1:nth-child(even) .textareablock-b1-button-button {
        background-color: #E8833A;
    }

    .textareablock-b1:nth-child(even) .textareablock-b1-button-button:hover {
        background-color: #d36d23;
    }

    .textareablock-b1-button-button {
        width: 60%;
        min-width: 200px;
    }

    .bottom-block {
        margin-top: 150px;
    }

    .preloader {
        position: fixed;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        overflow: hidden;
        background: #e0e0e0;
        z-index: 1001;
    }

    .preloader__image {
        position: relative;
        top: 50%;
        left: 50%;
        width: 70px;
        height: 70px;
        margin-top: -35px;
        margin-left: -35px;
        text-align: center;
        animation: preloader-rotate 2s infinite linear;
    }

    @keyframes preloader-rotate {
        100% {
            transform: rotate(360deg);
        }
    }

    .loaded_hiding .preloader {
        transition: 0.3s opacity;
        opacity: 0;
    }

    .loaded .preloader {
        display: none;
    }

    @media only screen and (max-width: 1023px) {

        .form-items {
            width: 100%;
        }

        .form-items input {
            width: 60%;
        }
    }

    @media only screen and (max-width: 600px) {

        #app {
            padding-top: 50px;
        }

        .container {
            padding: 0 25px;
        }

        .top-title > * {
            margin-bottom: 20px;
            font-size: 1.8em;
        }

        .top-block {
            margin-bottom: 40px;
        }

        .top-notify {
            font-size: 1.5em;
        }

        .form-items {
            flex-direction: column;
        }

        .form-items input {
            width: 100%;
        }

        .form-items button {
            flex: initial;
        }

        .textareablock {
            flex-direction: column;
        }

        .textareablock-b1 {
            width: 100%;
            padding: 0;
        }

        .textareablock-b1:nth-child(odd) {
            border-right: none;
        }

        .textareablock-b1:not(:last-child) {
            margin-bottom: 25px;
            padding-bottom: 35px;
            border-bottom: 2px solid #9EADBA;
        }

        .block-link-free-restart {
            margin-top: 60px;
        }

        .bottom-block {
            margin-top: 60px;
        }
    }

</style>

