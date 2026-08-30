
 



        
     <center>

        <div class="w3-container mb-5">
            <button class="w3-button w3-round-xxlarge w3-green" id="btnPrint">SAVE RECIEPT</button>
            <button class="w3-button w3-round-xxlarge w3-blue" id="btnPrints">PRINT RECIEPT</button>

        </div>



        <table class=' w3-table-responsive' id="pins">


            <tr>
                
                <td>
                 <center> <b>DUBAI COMMUNICATION</b>
    </center> <br>  <img src="https://subarena.com//static/ogbam/images/AIRTEL.jpg">

                 <div class="content" style="padding-left: 10px;margin-top:-19px;"><span><b>REF:</b></span> &nbsp;&nbsp;  <span> <b>51128</b></span> <br>
                    <span><b>PIN:</b></span>&nbsp;&nbsp;<span style="font-size:11px"><b> 5248462687002356,
</b></span><br>
                    <span><b>S/N:</b></span>&nbsp;&nbsp;<span><b> 8598</b></span><br>
                    <span><b>Date:</b></span>&nbsp;&nbsp;<span><b>March 9, 2024, 3:42 p.m.</b></span><br>
                </div>

                <div class="bottom">

                  <span class="amt"><b>₦100.0</b></span>


                 <center>
                 
                          <span style="font-size:8px;"> <b> *311*PIN #</b></span>
               

                    </center>


                </div>

                </td>
                
        
            </tr>

        </table>
        
    </center>

</div>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

<script type="text/javascript">
     document.getElementById('btnPrint').addEventListener('click',
     Export);

function Export() {
          html2canvas(document.getElementById('pins'), {
              onrendered: function (canvas) {
                  var data = canvas.toDataURL();
                  var docDefinition = {
                      content: [{
                          image: data,
                          width: 500
                      }]
                  };
                  pdfMake.createPdf(docDefinition).download("Rechargepin.pdf");
              }
          });
      }  </script>
      
<script type="text/javascript">
     document.getElementById('btnPrints').addEventListener('click',
     Export);

function Export() {
          html2canvas(document.getElementById('pins'), {
              onrendered: function (canvas) {
                  var data = canvas.toDataURL();
                  var docDefinition = {
                      content: [{
                          image: data,
                          width: 500
                      }]
                  };
                  window.print("Rechargepin.pdf");
                //   pdfMake.createPdf(docDefinition).download("Rechargepin.pdf");
              }
          });
      }  </script>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">


     <meta name="theme-color" content="#110b94">
     <link rel="stylesheet" href="https://subarena.com/static/ogbam/form.css">
     <link rel="stylesheet" href="https://subarena.com/static/ogbam/w3.css">
<link rel="manifest" href="https://subarena.com/static/img/manifest.json">
<meta name="msapplication-TileColor" content="#110b94">
<meta name="msapplication-TileImage" content="https://subarena.com/static/img/bg.jpg">
 <meta itemprop="name" content="lensgold- Buy Airtime and Data for all Network. Make payment for DSTV, GOTV, PHCN other services">
     <meta itemprop="description" content="Buy Cheap Internet Data Plan and Airtime Recharge for Airtel, 9mobile, GLO, MTN, Pay DSTV, GOTV, PHCN.">

</head>

<body>

<div >
<style>
.table, tr, td {
  border: 1px solid black;
  border-style: dashed;
  padding:0px;

}


td{
    font-size:10px;
}

.amt{
    float:right;
    font-weight: bolder;
}

.content{
    padding-right:60px;
}
img{
   float:right;
   height: 35px;
   width: 35px;
}

.bottom{
    clear:both ;
}
</style>
