

    <!DOCTYPE html>
    <html lang="en" >

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <title>Red Store - Admin Dashboard</title>
    </head>

    <body class="adminBody" onload="loadChart();">


    <div>
    <div class="d-flex justify-content-end container mt-5 mb-4">
            <button class="btn btn-outline-warning col-2" onclick="window.print();">Print</button>
        </div>
    </div>

        <!--Chart-->
        <div  class="col-lg-12 offset-3 mt-4" style="width: 600px;">
        <h2 class="text-center text-light ">Most Sold Product</h2>
            <canvas  id="myChart"></canvas>
        </div> 

        <!--Chart-->
       
        
       

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>

