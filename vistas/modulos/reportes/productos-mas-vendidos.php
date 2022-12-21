<?php 

$item = null;
$valor = null;
$orden = "ventas";

$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

$colores = array("red","green","yellow","aqua","purple","blue","cyan","magenta","orange","gold");

$totalVentas = ControladorProductos::ctrMostrarSumaVentas();


?>



<div class="box box-default">

	<div class="box-header with-border">

		<h3 class="box-title">Productos más vendidos</h3>

		
	</div>


<div class="box-body">

	<div class="row">

		<div class="col-md-7">

			<div class="chart-responsive">

				<canvas id="pieChart" height="300"></canvas>

			</div>

		</div>

			<div class="col-md-5">

				<ul class="chart-legend clearfix">

          <?php 

          for ($i=0; $i < 10; $i++) { 
            echo '<li><i class="fa fa-circle-o text-'.$colores[$i].'"></i> '.$productos[$i]["descripcion"].'</li>';
          }

          ?>

				
				</ul>

			</div>

		</div>

	</div>

	<div class="box-footer no-padding">

		<ul class="nav nav-pills nav-stacked">

       <?php 

          for ($i=0; $i < 5; $i++) { 

            echo '<li>

                <a href="#">  

                  '.$productos[$i]["descripcion"].'

                  <span class="pull-right text-'.$colores[$i].'"><i class="fa fa-angle-down"></i> '.$productos[$i]["ventas"]*100/$totalVentas["total"].' %</span>

                </a>

              </li>';

      
          }

          ?>


		</ul>

	</div>

</div>


<script>
	

  // -------------
  // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas=$('#pieChart').get(0).getContext('2d');
  var pieChart=new Chart(pieChartCanvas);
  var PieData=[

    <?php 

    for ($i=0; $i < 10; $i++) { 

      echo " {
      value    : ".$productos[$i]["ventas"].",
      color    :'".$colores[$i]."',
      highlight:'".$colores[$i]."',
      label    :'".$productos[$i]["descripcion"]."'
    },";
    
    }

    ?>

   
    ];

    var pieOptions={segmentShowStroke:true,
      segmentStrokeColor:'#fff',
      segmentStrokeWidth:1,
      percentageInnerCutout:50,
      animationSteps:100,
      animationEasing:'easeOutBounce',
      animateRotate:true,
      animateScale:false,
      responsive:true,
      maintainAspectRatio:false,
      legendTemplate:'<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
      tooltipTemplate:'<%=value %> <%=label%> '

      };

      pieChart.Doughnut(PieData,pieOptions);

</script>