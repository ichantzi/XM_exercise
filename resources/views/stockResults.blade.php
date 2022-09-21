<!DOCTYPE html>
<html>
  <head>
    <title>Stock Results for {{$symbol}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
    <div class="container mt-12">
      <div class="row ml-1 mt-1 mb-1">
      <form class="text-center" action="/">
        <input class="btn btn-primary" type="submit" value="Search Again" />
      </form>
      </div>
      <div class="card">
        <div class="card-header text-center font-weight-bold">
            Results for the {{$symbol}} stock
        </div>
        <div class="card-body">
          <div class="table-responsive"> 
            <table class="table table-striped">
              <tr>
                <th>Date</th>
                <th>Open</th>
                <th>High</th>
                <th>Low</th>
                <th>Close</th>
                <th>Volume</th>
              </tr>
              @foreach ($prices as $price)
                <tr>
                    <td>{{gmdate("M d Y H:i:s", $price->date)}}</td>
                    <?php if(isset($price->open)) : ?>
                      <td>{{$price->open}}</td>
                    <?php else : ?>
                      <td>No data found</td>
                    <?php endif; ?>
                    <?php if(isset($price->high)) : ?>
                      <td>{{$price->high}}</td>
                    <?php else : ?>
                      <td>No data found</td>
                    <?php endif; ?><?php if(isset($price->low)) : ?>
                      <td>{{$price->low}}</td>
                    <?php else : ?>
                      <td>No data found</td>
                    <?php endif; ?><?php if(isset($price->close)) : ?>
                      <td>{{$price->close}}</td>
                    <?php else : ?>
                      <td>No data found</td>
                    <?php endif; ?><?php if(isset($price->volume)) : ?>
                      <td>{{$price->volume}}</td>
                    <?php else : ?>
                      <td>No data found</td>
                    <?php endif; ?>
                </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>  
  </body>
</html>
