<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-2">
                <div class="card-header">
                    <h2>Laravel Ajax form Submit with Validation</h2>
                </div>
                <div class="card-body">
                    <div class="alert alert-success" role="alert" id="successMsg" style="display: none" >
                        Blog Saved Successfully!
                    </div>
                </div>

                <form id="submitForm" action="{{ route('blogs.store') }}" method="post">@csrf
                    <div class="mb-3">
                        <label for="InputName" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" id="InputName">
                        <span class="text-danger" id="title"></span>
                    </div>


                    <div class="mb-3">
                        <label for="InputMessage" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="InputMessage" cols="30" rows="4"></textarea>
                        <span class="text-danger" id="description"></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).on('submit','#submitForm',function (event){
        event.preventDefault();
        var formData = new FormData(this);
        let url = $(this).attr('action') , method = $(this).attr('method');

        $.ajax({
            url: url,
            type: method,
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function () {
                $('#successMsg').show();
            },
            error: function (response) {
                if (response.status == 422)
                {
                    let error = response.responseJSON.errors;
                    $.each(error, function (key, value) {
                        $("#" + key).text(value[0]);
                    });
                }
            }
        });
    });
</script>
</body>
</html>
