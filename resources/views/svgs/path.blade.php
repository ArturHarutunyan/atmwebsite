<svg xmlns:xlink="http://www.w3.org/1999/xlink" viewbox="-1600 0 2900 200" id="SVGpath" style='overflow:visible' fill="none" preserveAspectRatio="none">

    <!-- __________________________ first with path background _______________________ -->

    <path id="first_path_background" d="
         M 1256 -1205 Q 630 -561 184 -709Q -400 -904 -1043 -521Q -1800 -80.4355 -1300 300    "></path>


    <mask id="mask1">
        <use class="mask" xlink:href="#first_path_background">
    </mask>

    <use class="paths" fill='#fff' xlink:href="#first_path_background" mask="url(#mask1)" />

    <!-- ___________________________ secend path background __________________________ -->
    <path stroke="#004171" stroke-width="1.5" id="secend_path_background" data-id='secend_path_background2' d="
           M -1302 301.7 Q -420 1168.7 -1087.86 1242.89Q -1870 1403.54 -1031.935 2258.96Q -274.449 2527.01 -1200 3300"></path>


    <!-- __________________________ first  path  _______________________ -->

    <path stroke="#ffffff" stroke-width="3.5" id="first_path" d="
            M 1256 -1205 Q 630 -561 184 -709Q -400 -904 -1043 -521Q -1800 -80.4355 -1300 300   "></path>

    <!-- ___________________________ secend path  __________________________ -->
    <path stroke="#004171" stroke-width="3.5" id="secend_path" d="
               M -1302 301.7 Q -420 1168.7 -1087.86 1242.89Q -1870 1403.54 -1031.935 2258.96Q -274.449 2527.01 -1200 3300"></path>

    <!-- ____________________ circls_______________ -->
    <!-- ________________ circle 01_______________ -->

    <defs>
        <pattern id="firstBreackpointImage" height="100%" width="100%" patternContentUnits="objectBoundingBox">
            <image xlink:href="{{asset('uploads/images/main/firstBreackpoint.png')}}" preserveAspectRatio="none" width="1.05" height="1.05">

            </image>
        </pattern>
    </defs>
    <circle cx="0" cy="0" class="shadow" r="0" fill="url(#firstBreackpointImage)" id="firstBreackpoint">
    </circle>

    <!-- ________________ circle 02 _______________ -->
    <defs>
        <pattern id="secendBreackpointImage" height="100%" width="100%" patternContentUnits="objectBoundingBox">
            <image xlink:href="{{asset('uploads/images/main/secondBreackpoint.png')}}" preserveAspectRatio="none" width="1.01" height="1.01">

            </image>
        </pattern>
    </defs>
    <circle cx="0" cy="0" class="shadow" r="0" fill="url(#secendBreackpointImage)" id="secendBreackpoint">
    </circle>

    <!-- ________________ circle 03 _______________ -->

    <defs>
        <pattern id="thirdBreackpointImage" height="100%" width="100%" patternContentUnits="objectBoundingBox">
            <image xlink:href="{{asset('uploads/images/main/secondBreackpoint.png')}}" preserveAspectRatio="none" width="1.01" height="1.01">

            </image>
        </pattern>
    </defs>
    <circle cx="0" cy="0" class="shadow" r="0" fill="url(#thirdBreackpointImage)" id="thirdBreackpoint">
    </circle>

    <!-- id fordBreackpoint -->


    <defs>
        <pattern id="fordBreackpointImage" height="100%" width="100%" patternContentUnits="objectBoundingBox">
            <image xlink:href="{{asset('uploads/images/main/secondBreackpoint.png')}}" preserveAspectRatio="none" width="1.01" height="1.01">

            </image>
        </pattern>
    </defs>
    <circle cx="0" cy="0" class="shadow" r="0" fill="url(#fordBreackpointImage)" id="fordBreackpoint">
    </circle>


    <!-- ________________ circle 04 _______________ -->
    <defs>
        <pattern id="lastBreackpointImage" height="100%" width="100%" patternContentUnits="objectBoundingBox">
            <image xlink:href="{{asset('uploads/images/main/secondBreackpoint.png')}}" preserveAspectRatio="none" width="1.01" height="1.01">

            </image>
        </pattern>
    </defs>
    <circle cx="0" cy="0" class="shadow" r="0" fill="url(#lastBreackpointImage)" id="lastBreackpoint">
    </circle>
    <!-- __________________  globus circle _________________ -->
    <defs>
        <pattern id="circleImage" height="0" width="0" patternContentUnits="objectBoundingBox">
            <image xlink:href="{{asset('uploads/images/main/Circle_frame.svg')}}" preserveAspectRatio="none" width="0" height="0">

            </image>
        </pattern>
    </defs>
    <circle cx="0" cy="0" class="circlGlobus" r="0" fill="url(#circleImage)" id="circl">
    </circle>
    <!-- ______________________ globus ______________ -->
    <defs>
        <pattern id="attachedImage" height="100%" width="100%" patternContentUnits="objectBoundingBox">
            <image xlink:href="{{asset('uploads/images/main/globus.gif')}}" preserveAspectRatio="none" id="globusImage" width="1.01" height="1.01">

            </image>
        </pattern>
    </defs>
    <circle cx="0" cy="0" class="shadow" r="35" fill="url(#attachedImage)" style='border:1px solid black' id="dot">
    </circle>
</svg>