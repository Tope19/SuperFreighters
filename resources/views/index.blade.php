<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<body>

    <div class="container">

        <div class="m-5">
            <a href="{{ route('login') }}">Admin Login</a>
            <div class="title">Move your goods from UK or Us as affordable price</div>
            <form action="{{ route('index') }}" method="post"> @csrf
                <div class="mt-3 row">
                    <div class="form-group col-md-4">
                        <label for="">Pickup Country</label>
                        <select name="country_id" id="country_id" class="form-control"  required>
                            <option value="">Select Pickup Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}" aria-url="{{ route('api.general.country.routes', $country->id) }}"
                                    {{ ($query['country'] ?? '') == $country->id ? 'selected' : '' }}>{{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Pickup City</label>
                        <select name="route_id" id="route_id" class="form-control" required>
                            <option value="" disabled selected>Select Pickup City</option>

                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Transport Mode</label>
                        <select name="transport_mode" id="" class="form-control" required>
                            <option value="">Select Transport Mode</option>
                            @foreach ($transportModes as $mode)
                                <option value="{{ $mode->id }}"
                                    {{ ($query['transport_mode'] ?? '') == $mode->id ? 'selected' : '' }}>
                                    {{ $mode->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Weight (KG)</label>
                        <input type="number" class="form-control" name="weight" placeholder="Enter weight"
                            value="{{ $query['weight'] ?? '' }}" required>
                    </div>
                </div>
                <div class="mt-2">
                    <button class="btn btn-primary">Get Price</button>
                </div>
            </form>

            @if (!empty($shippingCostData))
                <div class="mt-5">
                    <p><b>Total: </b> ₦{{ $shippingCostData['total_price'] ?? 'N/A' }}</p>
                    <p><b>Custom Tax: </b> ₦{{ $shippingCostData['custom_tax'] ?? 'N/A' }}</p>
                    <p><b>Shipping Cost: </b> ₦{{ $shippingCostData['shipping_cost'] ?? 'N/A' }}</p>
                </div>

                <form class="mt-3 row" method="post" action="{{ route("proceed") }}">@csrf
                    <input type="hidden" name="route_id" required value="{{ $query['route_id'] ?? '' }}">
                    <input type="hidden" name="transport_mode" required value="{{ $query['transport_mode'] ?? '' }}">
                    <input type="hidden" name="weight" required value="{{ $query['weight'] ?? '' }}">
                    <div class="form-group col-md-4">
                        <label for="">Your Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter first and last names"
                            value="{{ old("name") }}" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Email Address</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter email address"
                            value="{{ old("email") }}" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Phone Number</label>
                        <input type="tel" class="form-control" name="phone" placeholder="Enter phone"
                            value="{{ old("phone") }}" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Package Name</label>
                        <input type="tel" class="form-control" name="package_name" placeholder="Package Name"
                            value="{{ old("package_name") }}" required>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="">Describe goods to be transported</label>
                        <textarea class="form-control" name="description" placeholder="..."required>
                            {!! old("description") !!}
                        </textarea>
                    </div>
                    <div class="col-12 mt-3 text-center">
                        <button class="btn btn-success">Proceed</button>
                    </div>
                </form>
            @endif
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": '{{ csrf_token() }}',
            },
        });

        $('#country_id').change(function(){
            var url = $(this).find('option:selected').attr('aria-url');
            let route_list = [];
            $.ajax({
                url: url,
                type: 'GET',
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data);

                    route_list = [];
                    jQuery.each(data , function(index){
                        let route = data[index];
                        route_list.push('<option value="'+ route.id +'">'+ route.name +'</option>');
                    });
                    $('#route_id').html(route_list)

                }

            });
        })
</script>
</body>

</html>
