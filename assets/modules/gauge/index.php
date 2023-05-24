<!DOCTYPE html>
<html>
<head>
  <title>gauge.js</title>
  <meta name="description" content="100% native and cool looking animated JavaScript/CoffeeScript gauge">
  <meta name="viewport" content="width=1024, maximum-scale=1">
  <meta property="og:image" content="http://bernii.github.com/gauge.js/assets/preview.jpg?v=1" />
  <link rel="shortcut icon" href="favicon.ico">
  <meta http-equiv="X-UA-Compatible" content="IE=7" />
  <!--[if lt IE 9]><script type="text/javascript" src="assets/excanvas.compiled.js"></script><![endif]-->
</head>
<body>
<canvas id="myChart" width=800 height=500></canvas>
    
  <!-- <script type="text/JavaScript">
  var ctx = document.getElementById("myChart");
  var myChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
          labels: ["Temperature"],
          datasets: [{
              label: '# of Votes',
              data: [<?php echo $data; ?>],
              backgroundColor: [
                  <?php echo $warna; ?>,
                  '#ffffff'
              ],
              borderColor: [
                  <?php echo $warna; ?>,
                  <?php echo $warna; ?>
              ],
              borderWidth: 1
          }]
      },
      options: {
          rotation: 1 * Math.PI,
          circumference: 1 * Math.PI

      }
  });
  </script> -->

<script src="dist/gauge.js"></script>

<script type="text/JavaScript">
  var opts = {
    angle: 0, // The span of the gauge arc
    lineWidth: 0.56, // The line thickness
    radiusScale: 1, // Relative radius
    pointer: {
      length: 0.59, // // Relative to gauge radius
      strokeWidth: 0.035, // The thickness
      color: '#000000' // Fill color
    },
    staticLabels: {
      font: "10px sans-serif",  // Specifies font
      labels: [0, 200, 500, 2100, 2800, 3000],  // Print labels at these values
      color: "#000000",  // Optional: Label text color
      fractionDigits: 0  // Optional: Numerical precision. 0=round off.
    },
    staticZones: [
           {strokeStyle: "#F03E3E", min: 0, max: 200},
           {strokeStyle: "#FFDD00", min: 200, max: 500},
           {strokeStyle: "#30B32D", min: 500, max: 2100},
           {strokeStyle: "#FFDD00", min: 2100, max: 2800},
           {strokeStyle: "#F03E3E", min: 2800, max: 3000}
           ],
    limitMax: false,     // If false, max value increases automatically if value > maxValue
    limitMin: false,     // If true, the min value of the gauge will be fixed
    colorStart: '#6FADCF',   // Colors
    colorStop: '#8FC0DA',    // just experiment with them
    strokeColor: '#E0E0E0',  // to see which ones work best for you
    generateGradient: true,
    highDpiSupport: true,     // High resolution support
    
  };
  var target = document.getElementById('myChart'); // your canvas element
  var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
  gauge.maxValue = 3000; // set max gauge value
  gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
  gauge.animationSpeed = 32; // set animation speed (32 is default value)
  gauge.set(1250); // set actual value
  </script>
</body>
</html>
