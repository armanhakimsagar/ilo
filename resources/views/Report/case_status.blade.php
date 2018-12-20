@extends('theme.default')
@section('content')
<style type="text/css">
  .highcharts-credits{
    display: none!important
  }
</style>
<div class="row" style="background-color: #00097c;color: #fff; margin-bottom: 10px">
    <div class="col-lg-12">
        <div class="panel-heading">Report Section</div>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row" style="background-color: #eee; border: 1px solid #ccc">
    <div class="col-lg-12" style=" height: 440px;padding: 20px">
    	{!! $chart->html() !!}
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row" style="margin-top: 10px;background-color: #eee; border: 1px solid #ccc">
    <div class="col-lg-6" style=" height: 440px;padding: 20px 0px 20px 20px">
      <div id="container" style="min-width: 310px; height: 400px;margin: 0 auto"></div>
    </div>

    <div class="col-lg-6" style=" height: 440px;padding: 20px">
      <a href="{{ url('agency_details') }}">See details</a>
      <div id="agency" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
    </div>
</div>

<div class="row" style="margin-top: 10px;background-color: #eee; border: 1px solid #ccc">
    <div class="col-lg-12" style=" height: 440px;padding: 20px">
      <div id="country" style=" height: 400px; margin: 0 auto"></div>
    </div>
</div>

<div class="row" style="margin-top: 10px;background-color: #eee; border: 1px solid #ccc">
    <div class="col-lg-6" style=" height: 440px;padding: 20px 0px 20px 20px">
      <div id="complete" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
    </div>
    <div class="col-lg-6" style=" height: 440px;padding: 20px 0px 20px 20px">
      <div id="channel" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
    </div>
</div>


<script type="text/javascript">


Highcharts.chart('channel', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: 0,
    plotShadow: false
  },
  title: {
    text: 'Complain<br>Channel',
    align: 'center',
    verticalAlign: 'middle',
    y: 40
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  plotOptions: {
    pie: {
      dataLabels: {
        enabled: true,
        distance: -50,
        style: {
          fontWeight: 'bold',
          color: 'white'
        }
      },
      startAngle: -90,
      endAngle: 90,
      center: ['50%', '75%']
    }
  },
  series: [{
    type: 'pie',
    name: 'Complain Channel',
    innerSize: '50%',
    data: [

      @foreach($application_types as $application_type) 
 
        ['{{ $application_type->application_type }}', {{ $application_type->total }}],

      @endforeach
      

      {
        name: 'Other',
        y: 0,
        dataLabels: {
          enabled: false
        }
      }
    ]
  }]
});


Highcharts.chart('agency', {
  chart: {
    type: 'column'
  },
  title: {
    text: 'Top 5 Agency List'
  },
  subtitle: {
    text: ''
  },
  xAxis: {
    crosshair: true
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Country List'
    }
  },
  tooltip: {
    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
    footerFormat: '</table>',
    shared: true,
    useHTML: true
  },
  plotOptions: {
    column: {
      pointPadding: 0.2,
      borderWidth: 0
    }
  },
  series: [
    @foreach($agencies as $agency) 
    {
      name: "{{ $agency->agency_name }}",
      data: [{{ $agency->total }}]
    },
    @endforeach
  ]
});



Highcharts.chart('container', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: 'Gender Status'
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
        style: {
          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
        }
      }
    }
  },
  series: [{
    name: '',
    colorByPoint: true,
    data: [{
      name: 'Male',
      y: {{ $male }},
      color: '#556080'
    },{
      name: 'Female',
      y: {{ $female }},
      color: '#F0785A',
      sliced: true,
      selected: true
    },{
      name: 'Other',
      y: {{ $other }},
      color: '#F0C419',
      sliced: true,
      selected: true
    }]
  }]
});


Highcharts.chart('complete', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: 'Case Status'
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
        style: {
          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
        }
      }
    }
  },
  series: [{
    name: '',
    colorByPoint: true,
    data: [{
      name: 'Complete',
      y: {{ $complete }},
      color: '#556080'
    },{
      name: 'Incomplete',
      y: {{ $incomplete }},
      color: '#c8c8c8',
      sliced: true,
      selected: true
    }]
  }]
});

Highcharts.chart('country', {
  chart: {
    type: 'column'
  },
  title: {
    text: 'Top 5 Country List'
  },
  subtitle: {
    text: ''
  },
  xAxis: {
    crosshair: true
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Country List'
    }
  },
  tooltip: {
    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
    footerFormat: '</table>',
    shared: true,
    useHTML: true
  },
  plotOptions: {
    column: {
      pointPadding: 0.2,
      borderWidth: 0
    }
  },
  series: [
    @foreach($countries as $country) 
    {
      name: "{{ $country->sufferer_current_country }}",
      data: [{{ $country->total }}]
    },
    @endforeach
  ]
});
</script>


{!! $chart->script() !!}

@endsection
    