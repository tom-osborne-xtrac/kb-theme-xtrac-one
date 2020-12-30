<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <script src="/wp-content/themes/xtrac-one/js\papaparse.min.js"></script>
        <script src="/wp-content/themes/xtrac-one/js/dev/js/fetchData.js"></script>
        <style>
        @font-face {
            font-family: Roboto;  
            src: local('Roboto-Regular'), 
                url("http://172.20.20.135/wp-content/themes/xtrac-one/fonts/Roboto-Regular.ttf") format('truetype');
            font-weight: 400;  
        }
        #turnkey-credit {
            display: none;
        }
        body {
            font-family: Roboto;
        }
        #tableContainer {
            max-width: 100%;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
        }        
        tr:nth-of-type(odd) {
            /* Zebra striping */
            background: #eee; 
        }
        th { 
            background: #00504e; 
            color: white; 
            font-weight: bold; 
        }
        td, th { 
            padding: 6px; 
            border: 1px solid #ccc; 
            text-align: left; 
        }
        </style>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        <!-- Table of data -->
        <div id="tableContainer">
        <table id="dataTable"></table>
        </div>
        <script>fetchData("dataTable");</script>
    </body>
</html>