<!DOCTYPE html>
<html>
<head>
  <title>Laporan Booking</title>
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>
<body>
  <div id="pdfTable" class="container text-center">
    <h2>LAPORAN BOOKING PERIODE </h4>
    <h4>{{$from}} - {{$to}} STATUS : {{ strtoupper($status)}} </h5>
    <br>
    <table class="table ">
      <thead>
        <tr>
          <th class="text-center" >No</th>
          <th class="text-center" >Nama</th>
          <th class="text-center" >Email</th>
          <th class="text-center" >Waktu Booking</th>
          <th class="text-center" >Lapang</th>
          <th class="text-center" >No Telpon</th>
          <th class="text-center" >Total Biaya</th>
        </tr>

      </thead>
      <tbody>
        @php
          $no=1;
        @endphp
        @foreach($booking as $data)
        <tr>
          <td>{{$no}}</td>
          <td>{{$data->user->name}}</td>
          <td>{{$data->user->email}}</td>
          <td>{{$data->created_at}}</td>
          <td>{{$data->detail->first()->lapang->nama}}</td>
          <td>{{$data->user->no_telpon}}</td>
          <td>Rp. {{number_format($data->total_harga,2) }}</td>
        </tr>
        @php
          $no++;
        @endphp
        @endforeach
      </tbody>

    </table>
  </div>
  <div id="editor"></div>
<script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.0/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $(function(){

   // html2canvas(document.body,{
   //   onrendered:function(canvas){
   //      console.log(canvas);
   //      var wid;
   //      var hgt;
   //      var img = canvas.toDataURL("image/png", wid = canvas.width, hgt = canvas.height);
   //      var hratio = hgt/wid
   //      var doc = new jsPDF('p','pt','a4');
   //      var width = doc.internal.pageSize.width;
   //      var height = width * hratio
   //      doc.addImage(img,'JPEG',20,20, width, height);
   //      doc.save('Test.pdf');
   //   }
   // });
    // var options = { pagesplit: true,'background': '#fff' };
    // var pdf = new jsPDF('l','pt','legal');
    // pdf.addHTML(document.body,function() {
    //     pdf.save('web.pdf');
    // });
    // html2canvas(document.body).then(function(canvas) {
    //     var imgData = canvas.toDataURL("image/jpeg", 1.0);
    //     var pdf = new jsPDF('p', 'mm', [400, 480]);
    //     pdf.addImage(imgData, 'JPEG', 20, 20);
    //     pdf.save("screen-3.pdf");
    // });
    // var customWindow = window.open('', '_blank', '');
    // customWindow.close();
    window.print();

  });

</script>


</body>
</html>
