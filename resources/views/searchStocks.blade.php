<!DOCTYPE html>
<html>
  <head>
    <title>Search for Stock prices</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
  </head>
  <body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
            Add your search parameters
            </div>
            <div class="card-body">
                <form name="post-form" id="post-form" method="post" action="{{url('search-stocks')}}">
                @csrf
                    <div class="form-group">
                        <label for="stockSearchForm">Stock</label>
                        <select type="text" id="symbol" name="symbol" class="form-control" required="">
                            @foreach ($companies as $company)
                                <option value="{{$company->symbol}}">{{$company->company_name}} -- {{$company->symbol}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="stockSearchForm">Start Date</label>
                        <input id="start_date" name="start_date" class="date form-control" type="text" required="">
                    </div>
                    <div class="form-group">
                        <label for="stockSearchForm">End Date</label>
                        <input id="end_date" name="end_date" class="date form-control" type="text" required="">
                    </div>
                    <div class="form-group">
                        <label for="stockSearchForm">Email</label>
                        <input type="text" id="email" name="email" class="form-control" required="email">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>  
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <script type="text/javascript">
    $('.date').datepicker({  
       format: 'dd/mm/yyyy'
     });  
</script> 
</body>
</html>
