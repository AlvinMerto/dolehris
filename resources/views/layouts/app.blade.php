<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title></title>

        <!-- Fonts -->
        <!-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- vendor css -->
        <link href="{{ asset('lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
        <link href="{{ asset('lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">

        <!-- Bracket CSS -->
        <link rel="stylesheet" href="{{ asset('css/bracket.css') }}">

        <!-- data tables -->
        <link href="{{ asset('lib/datatables/jquery.dataTables.css') }}" rel="stylesheet">

        <!-- wysiwyg -->
        <link href="{{ asset('lib/summernote/summernote-bs4.css') }}" rel="stylesheet">
        <!-- end wysiwyg -->

        <!-- Scripts -->
        <link href="{{ asset('lib/select2/css/select2.min.css') }}" rel="stylesheet">

        <!-- dole css Scripts -->
        <link href="{{ asset('css/dolehris.css') }}" rel="stylesheet">

        <link href="{{ asset('lib/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
        <link href="{{ asset('lib/jquery-switchbutton/jquery.switchButton.css') }}" rel="stylesheet">
        <link href="{{ asset('lib/highlightjs/github.css') }}" rel="stylesheet">
        <link href="{{ asset('lib/jquery-toggles/toggles-full.css') }}" rel="stylesheet">
        <link href="{{ asset('lib/jt.timepicker/jquery.timepicker.css') }}" rel="stylesheet">
        <link href="{{ asset('lib/spectrum/spectrum.css') }}" rel="stylesheet">
        <link href="{{ asset('lib/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">
        <link href="{{ asset('lib/ion.rangeSlider/css/ion.rangeSlider.css') }}" rel="stylesheet">
        <link href="{{ asset('lib/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css') }}" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.leftnav')
            @include('layouts.navigation')
  
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
        </div>

        <div class="br-mainpanel bg-gray-100" style="min-height: 885px;">
            <!-- Page Content -->
            <!-- <main> -->
                {{ $slot }}
            <!-- </main> -->
        </div>
        
        <div id='themodal' class="modal fade show">
            <div class="modal-dialog modal-dialog-vertical-center"> 
                <div class="modal-content bd-0 tx-14" id='showwindowhere'> 
                    
                </div>
            </div>
        </div>

        <!-- <script src="{{asset('lib/jquery/jquery.js')}}"></script> -->
        <script src='https://code.jquery.com/jquery-3.5.1.js'></script>
        <script src="{{asset('lib/popper.js/popper.js')}}"></script>
        <script src="{{asset('lib/bootstrap/bootstrap.js')}}"></script>
        <script src="{{asset('lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>
        <script src="{{asset('lib/moment/moment.js')}}"></script>
        <script src="{{asset('lib/jquery-ui/jquery-ui.js')}}"></script>
        <script src="{{asset('lib/select2/js/select2.min.js')}}"></script>
        <script src="{{asset('lib/jquery-switchbutton/jquery.switchButton.js')}}"></script>
        <script src="{{asset('lib/peity/jquery.peity.js')}}"></script>
        <script src="{{asset('lib/jquery.sparkline.bower/jquery.sparkline.min.js')}}"></script>
        <script src="{{asset('lib/d3/d3.js')}}"></script>
         <!-- <script src="{{asset('lib/chartist/chartist.js')}}"></script> -->
        <!-- <script src="{{asset('lib/rickshaw/rickshaw.min.js')}}"></script> -->

        <!-- data tables -->
        <!-- <script src="{{asset('lib/datatables/jquery.dataTables.js')}}"></script> -->
        <script src='https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js'></script>
        <!-- end of data tables -->

        <!-- Calendar date range -->
        <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <!-- Calendar date range end --> 

        <script src="{{asset('js/bracket.js')}}"></script>
        <script>
            var url = "{{url('')}}";
        </script>

        <script src="{{asset('dolejs/process.js')}}"></script>
        <script src="{{asset('dolejs/generatedtr.procs.js')}}"></script>
        <script src="{{asset('dolejs/personnel.procs.js')}}"></script>
        <!-- <script src="{{asset('dolejs/leavecalendar.procs.js')}}"></script> -->
        <script src="{{asset('dolejs/leavecredits.procs.js')}}"></script>
        
        <!-- <script src="{{asset('js/ResizeSensor.js')}}"></script>
        <script src="{{asset('js/dashboard.js')}}"></script> -->
        
    </body>
</html>
