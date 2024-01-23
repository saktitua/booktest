<style>
@media (max-width: 1024px) {
    .kt-header-mobile--fixed .kt-header-mobile{
        position: fixed;
        top: 0;
        right: 0;
        left: 0;
        z-index: 97;
    }
    .kt-header-mobile {
        background-color: #FFF;
        -webkit-box-shadow: 0px 1px 9px -3px rgba(0, 0, 0, 0.1);
        box-shadow: 0px 1px 9px -3px rgba(0, 0, 0, 0.1);
    }
    .kt-header-mobile {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        padding: 0 15px;
        height: 110px;
        min-height: 50px;
        position: relative;
        font-size: 1px;
        z-index: 1;
    }
    .kt-header-mobile__logo{
        margin-top:25px;
    }    
}

    body{
        margin:0;
    }
    .pagination {
        margin-top: 0em;
        display: inline-block;
        margin-left: 0.5em;
        font-size:0.8em;
        border-radius: 0px;
    }

    .pagination a {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
        font-size:0.5em;
        border: #1a1a27 solid;
        border-radius: 0px;
    }

    .pagination a.active {
        background-color: #4CAF50;
        color: white;
        border-radius: 0px;
        font-size: 0.5em;
        border-radius: 0px;
    }

    .pagination a:hover:not(.active) {
        background-color: #4CAF50;
        border-radius: 0px;
        font-size: 0.9em;
    }
    
    .header{
        margin: 2em;
    }
    .question{
        display: inline-block;
        margin: 0.1em;
        font-size: 1em;
    }
    .question-text{
        padding: 8px 16px;
        display: inline-block;
        margin: 0em;
        font-size: 0.8em;
    }
    .header_text{
        font-size: 0.8em;
    }


    .pagination2 a {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
        border: #1a1a27 solid;
        font-size: 0.8em;
    }

    .pagination2 a.active {
        background-color: #4CAF50;
        color: white;
        border-radius: 0px;
        font-size: 0.8em;
    }

    .pagination2 a:hover:not(.active) {
        background-color: #4CAF50;
        border-radius: 0px;
        font-size: 0.8em;
    }

    .form-control {
        margin-top: 2em;
        width: 100%;
        height: calc(1.5em + 1.3rem + 2px);
        padding: 0.65rem 1rem;
        font-size: 0.8rem;
        font-weight: 400;
        line-height: 1.5;
        margin-left:0.1em;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #e2e5ec;
        border-radius: 4px;
        -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
        transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    }
    .button {
        display:block;
        background-color: #4CAF50;
        border: none;
        color: white;
        padding:15px 52px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 8px;
        width: 100%;
        cursor: pointer;
    }

</style>