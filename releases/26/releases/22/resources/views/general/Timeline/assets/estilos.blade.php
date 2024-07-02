<style>
    @import url('https://fonts.googleapis.com/css?family=Cardo|Pathway+Gothic+One');

    .timeline {
        display: flex;
        margin: 0 auto;
        flex-wrap: wrap;
        flex-direction: column;
        max-width: 700px;
        position: relative;
    }

    .timeline__content-title {
        font-weight: normal;
        font-size: 66px;
        margin: -10px 0 0 0;
        transition: 0.4s;
        padding: 0 10px;
        box-sizing: border-box;
        font-family: 'Pathway Gothic One', sans-serif;
        color: #fff;
    }

    .timeline__content-desc {
        margin: 0;
        font-size: 15px;
        box-sizing: border-box;
        color: rgba(255, 255, 255, .7);
        font-family: Cardo;
        font-weight: normal;
        line-height: 25px;
    }

    .timeline:before {
        position: absolute;
        left: 50%;
        width: 2px;
        height: 100%;
        margin-left: -1px;
        content: "";
        background: rgba(255, 255, 255, .07);
    }

    @media only screen and (max-width: 767px) {
        .timeline:before {
            left: 40px;
        }
    }

    .timeline-item {
        padding: 40px 0;
        opacity: 0.3;
        filter: blur(2px);
        transition: 0.5s;
        box-sizing: border-box;
        width: calc(50% - 40px);
        display: flex;
        position: relative;
        transform: translateY(-80px);
    }

    .timeline-item:before {
        content: attr(data-text);
        letter-spacing: 3px;
        width: 100%;
        position: absolute;
        color: rgba(255, 255, 255, .5);
        font-size: 13px;
        font-family: 'Pathway Gothic One', sans-serif;
        border-left: 2px solid rgba(255, 255, 255, .5);
        top: 70%;
        margin-top: -5px;
        padding-left: 15px;
        opacity: 0;
        right: calc(-100% - 56px);
    }

    .timeline-item:nth-child(even) {
        align-self: flex-end;
    }

    .timeline-item:nth-child(even):before {
        right: auto;
        text-align: right;
        left: calc(-100% - 56px);
        padding-left: 0;
        border-left: none;
        border-right: 2px solid rgba(255, 255, 255, .5);
        padding-right: 15px;
    }

    .timeline-item--active {
        opacity: 1;
        transform: translateY(0);
        filter: blur(0px);
    }

    .timeline-item--active:before {
        top: 50%;
        transition: 0.3s all 0.2s;
        opacity: 1;
    }

    .timeline-item--active .timeline__content-title {
        margin: -50px 0 20px 0;
    }

    @media only screen and (max-width: 767px) {
        .timeline-item {
            align-self: baseline !important;
            width: 100%;
            padding: 0 30px 150px 80px;
        }

        .timeline-item:before {
            left: 10px !important;
            padding: 0 !important;
            top: 50px;
            text-align: center !important;
            width: 60px;
            border: none !important;
        }

        .timeline-item:last-child {
            padding-bottom: 40px;
        }
    }

    .timeline__img {
        max-width: 100%;
        box-shadow: 0 10px 15px rgba(0, 0, 0, .4);
    }

    .timeline-container {
        width: 100%;
        position: relative;
        padding: 80px 0;
        transition: 0.3s ease 0s;
        background-attachment: fixed;
        background-size: cover;
    }

    .timeline-container:before {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(99, 99, 99, 0.8);
        content: "";
    }

    .timeline-header {
        width: 100%;
        text-align: center;
        margin-bottom: 80px;
        position: relative;
    }

    .timeline-header__title {
        color: #fff;
        font-size: 34px;
        font-family: Cardo;
        font-weight: normal;
        margin: 0;
    }

    .timeline-header__subtitle {
        color: rgba(255, 255, 255, .5);
        font-family: 'Pathway Gothic One', sans-serif;
        font-size: 15px;
        letter-spacing: 5px;
        margin: 10px 0 0 0;
        font-weight: normal;
    }

    .demo-footer {
        padding: 60px 0;
        text-align: center;
    }

    .demo-footer a {
        color: #999;
        display: inline-block;
        font-family: Cardo;
    }

    .wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .typing-demo {
        width: 22ch;
        animation: typing 2s steps(22), blink .5s step-end infinite alternate;
        white-space: nowrap;
        overflow: hidden;
        border-right: 3px solid;
        font-family: monospace;
        font-size: 2em;
    }

    @keyframes typing {
        from {
            width: 0
        }
    }

    @keyframes blink {
        50% {
            border-color: transparent
        }
    }
</style>