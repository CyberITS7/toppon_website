<style>
    #load_screen{
        background: rgba(0,0,0,0.4);
        position: fixed;
        z-index:999999;
        display:none;
        top: 0px;
        left:0;
        width: 100%;
        height: 1600px;
    }
    #load_screen #loading{
        color:#FFF;
        width:120px;
        height:24px;
        margin: 300px auto;
    }
    #loading h3{
        width:180px;
    }
    #circularG{
        position:relative;
        width:45px;
        height:45px;
        margin: auto;
    }

    .circularG{
        position:absolute;
        background-color:#3F87D4;
        width:10px;
        height:10px;
        border-radius:7px;
        -o-border-radius:7px;
        -ms-border-radius:7px;
        -webkit-border-radius:7px;
        -moz-border-radius:7px;
        animation-name:bounce_circularG;
        -o-animation-name:bounce_circularG;
        -ms-animation-name:bounce_circularG;
        -webkit-animation-name:bounce_circularG;
        -moz-animation-name:bounce_circularG;
        animation-duration:1.1s;
        -o-animation-duration:1.1s;
        -ms-animation-duration:1.1s;
        -webkit-animation-duration:1.1s;
        -moz-animation-duration:1.1s;
        animation-iteration-count:infinite;
        -o-animation-iteration-count:infinite;
        -ms-animation-iteration-count:infinite;
        -webkit-animation-iteration-count:infinite;
        -moz-animation-iteration-count:infinite;
        animation-direction:normal;
        -o-animation-direction:normal;
        -ms-animation-direction:normal;
        -webkit-animation-direction:normal;
        -moz-animation-direction:normal;
    }

    #circularG_1{
        left:0;
        top:18px;
        animation-delay:0.41s;
        -o-animation-delay:0.41s;
        -ms-animation-delay:0.41s;
        -webkit-animation-delay:0.41s;
        -moz-animation-delay:0.41s;
    }

    #circularG_2{
        left:4px;
        top:4px;
        animation-delay:0.55s;
        -o-animation-delay:0.55s;
        -ms-animation-delay:0.55s;
        -webkit-animation-delay:0.55s;
        -moz-animation-delay:0.55s;
    }

    #circularG_3{
        top:0;
        left:18px;
        animation-delay:0.69s;
        -o-animation-delay:0.69s;
        -ms-animation-delay:0.69s;
        -webkit-animation-delay:0.69s;
        -moz-animation-delay:0.69s;
    }

    #circularG_4{
        right:4px;
        top:4px;
        animation-delay:0.83s;
        -o-animation-delay:0.83s;
        -ms-animation-delay:0.83s;
        -webkit-animation-delay:0.83s;
        -moz-animation-delay:0.83s;
    }

    #circularG_5{
        right:0;
        top:18px;
        animation-delay:0.97s;
        -o-animation-delay:0.97s;
        -ms-animation-delay:0.97s;
        -webkit-animation-delay:0.97s;
        -moz-animation-delay:0.97s;
    }

    #circularG_6{
        right:4px;
        bottom:4px;
        animation-delay:1.1s;
        -o-animation-delay:1.1s;
        -ms-animation-delay:1.1s;
        -webkit-animation-delay:1.1s;
        -moz-animation-delay:1.1s;
    }

    #circularG_7{
        left:18px;
        bottom:0;
        animation-delay:1.24s;
        -o-animation-delay:1.24s;
        -ms-animation-delay:1.24s;
        -webkit-animation-delay:1.24s;
        -moz-animation-delay:1.24s;
    }

    #circularG_8{
        left:4px;
        bottom:4px;
        animation-delay:1.38s;
        -o-animation-delay:1.38s;
        -ms-animation-delay:1.38s;
        -webkit-animation-delay:1.38s;
        -moz-animation-delay:1.38s;
    }



    @keyframes bounce_circularG{
        0%{
            transform:scale(1);
        }

        100%{
            transform:scale(.3);
        }
    }

    @-o-keyframes bounce_circularG{
        0%{
            -o-transform:scale(1);
        }

        100%{
            -o-transform:scale(.3);
        }
    }

    @-ms-keyframes bounce_circularG{
        0%{
            -ms-transform:scale(1);
        }

        100%{
            -ms-transform:scale(.3);
        }
    }

    @-webkit-keyframes bounce_circularG{
        0%{
            -webkit-transform:scale(1);
        }

        100%{
            -webkit-transform:scale(.3);
        }
    }

    @-moz-keyframes bounce_circularG{
        0%{
            -moz-transform:scale(1);
        }

        100%{
            -moz-transform:scale(.3);
        }
    }
    /*end loading screen*/
</style>
<!-- loading screen -->
<div id="load_screen">
    <div id="loading">
        <div id="circularG">
            <div id="circularG_1" class="circularG"></div>
            <div id="circularG_2" class="circularG"></div>
            <div id="circularG_3" class="circularG"></div>
            <div id="circularG_4" class="circularG"></div>
            <div id="circularG_5" class="circularG"></div>
            <div id="circularG_6" class="circularG"></div>
            <div id="circularG_7" class="circularG"></div>
            <div id="circularG_8" class="circularG"></div>
        </div>
        <h3>LOADING ...</h3>
    </div>
</div>