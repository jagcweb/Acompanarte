@extends('layouts.app') 

@section('content')

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    .main_div {
        width: 100%;
        display: flex;
        flex-direction: column;
        min-height: 80vh;
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
    }
    
    .client_div {
        cursor: pointer;
        width: 100%;
        position: relative;
        max-height: 39vh;
        transition: all 0.3s;
    }
    
    .pianist_div {
        cursor: pointer;
        border-top: 2px solid #eee;
        width: 100%;
        position: relative;
        max-height: 39vh;
        transition: all 0.3s;
    }

    a {
        text-decoration: none;
        color: #000;
    }

    a:hover{
        color: #000;
    }
    
    .subdiv {
        overflow: hidden;
        max-height: 40vh;
        width: 100%;
    }
    
    img {
        width: 100%;
        object-fit: cover;
        -webkit-filter: grayscale(100%);
        filter: grayscale(100%);
        transition: all 0.3s;
        margin-top: -450px;
    }
    
    .client_div:hover img,
    .pianist_div:hover img {
        -webkit-filter: grayscale(0);
        filter: grayscale(0);
    }

    span:hover {
        background-size: 100% 88%;
    }

    h2 {
        font-family: "Poppins";
    }
    
    span {
        text-align:center;
        font-family: "Poppins";
        position: absolute;
        font-size: 50px;
        padding: 5px;
        font-weight: 500;
        background-image: linear-gradient(120deg, #84fab0 0%, #8fd3f4 100%);
        background-repeat: no-repeat;
        background-size: 100% 0.2em;
        background-position: 0 88%;
        transition: background-size 0.25s ease-in;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .content{
        margin-top: 50px;
    }

    
</style>
<h2 class="w-100 text-center">Regístrate</h2>
<div class="main_div">
    <div class="client_div">
        <a href="{{route('register.index', ['rol' => 'cliente'])}}">
            <div class="subdiv">
                <img src="{{ url('assets') }}/images/client.webp" />
            </div>
            <span>Busco Pianista</span>
        </a>
    </div>

    <div class="pianist_div">
        <a href="{{route('register.index', ['rol' => 'pianista-premium'])}}">
            <div class="subdiv">
                <img src="{{ url('assets') }}/images/pianist.webp" />
            </div>
            <span>Soy Pianista</span>
        </a>
    </div>
</div>

@endsection