<link rel="manifest" href="site.webmanifest">
<link rel="icon" href="{{ asset ('template1/img/icon.webp') }}">
 <!-- Vendor Styles -->
 <link rel="stylesheet" media="screen" href="template1/vendor/boxicons/css/boxicons.min.css" />
 <link rel="stylesheet" href="template1/vendor/swiper/swiper-bundle.min.css" />
 <!-- Main Theme Styles + Bootstrap -->
 <link rel="stylesheet" media="screen" href="template1/css/theme.min.css" />
 <link rel="stylesheet" href="" />

<!-- Datatables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

 <!-- Page loading styles -->
 <style>
     .page-loading {
         position: fixed;
         top: 0;
         right: 0;
         bottom: 0;
         left: 0;
         width: 100%;
         height: 100%;
         -webkit-transition: all 0.4s 0.2s ease-in-out;
         transition: all 0.4s 0.2s ease-in-out;
         background-color: #fff;
         opacity: 0;
         visibility: hidden;
         z-index: 9999;
     }

     .dark-mode .page-loading {
         background-color: #0b0f19;
     }

     .page-loading.active {
         opacity: 1;
         visibility: visible;
     }

     .page-loading-inner {
         position: absolute;
         top: 50%;
         left: 0;
         width: 100%;
         text-align: center;
         -webkit-transform: translateY(-50%);
         transform: translateY(-50%);
         -webkit-transition: opacity 0.2s ease-in-out;
         transition: opacity 0.2s ease-in-out;
         opacity: 0;
     }

     .page-loading.active>.page-loading-inner {
         opacity: 1;
     }

     .page-loading-inner>span {
         display: block;
         font-size: 1rem;
         font-weight: normal;
         color: #9397ad;
     }

     .dark-mode .page-loading-inner>span {
         color: #fff;
         opacity: 0.6;
     }

     .page-spinner {
         display: inline-block;
         width: 2.75rem;
         height: 2.75rem;
         margin-bottom: 0.75rem;
         vertical-align: text-bottom;
         border: 0.15em solid #b4b7c9;
         border-right-color: transparent;
         border-radius: 50%;
         -webkit-animation: spinner 0.75s linear infinite;
         animation: spinner 0.75s linear infinite;
     }

     .dark-mode .page-spinner {
         border-color: rgba(255, 255, 255, 0.4);
         border-right-color: transparent;
     }

     @-webkit-keyframes spinner {
         100% {
             -webkit-transform: rotate(360deg);
             transform: rotate(360deg);
         }
     }

     @keyframes spinner {
         100% {
             -webkit-transform: rotate(360deg);
             transform: rotate(360deg);
         }
     }
 </style>
