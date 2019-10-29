@extends('layouts.app')

@section('content')


<div class="jumbotron-fluid jumbotron-contact">
    <div class="container">
        <h1 class="text-white display-3 text-break">Contact FillStorShip</h1>
        <hr class="my-4" style="background-color:white">

    </div>
  </div>
    <div class="container" style="margin-top:2%">
        <div class="row">
            <div class="col-12 col-lg-12">
                <!-- Flash Alerts Begin -->

                @include('partials.alerts')
                
                <!-- Flash Alerts Ends -->
            </div>
            <div class="col col-12 col-lg-6 py-5">

                <p>Feel free to message us if you have any questions, comments or concerns.</p>
                <br>
                <form action="/contact" method="POST">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control">
                        <div style="font-weight: 700; color:red">{{$errors->first('name')}}</div>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" class="form-control">
                        <div style="font-weight: 700; color:red">{{$errors->first('email')}}</div>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" cols="30" rows="10" class="form-control">{{ old('message')}}</textarea>
                        <div style="font-weight: 700; color:red">{{$errors->first('message')}}</div>
                    </div>

                    @csrf

                    <button type="submit" class="btn bg-orange text-white">Send Message</button>



                </form>
        </div>

    <div class="col col-12 col-lg-6 py-5">
            <strong>Address:</strong> 2356 First Street La Verne, CA 91750
            <br>

            <strong>Phone Number:</strong> 909-592-9000
                <br>
            <strong>E-mail:</strong> ship@fillstorship.com


            <!--The div element for the map -->
            <div id="map"></div>
            <script>
            // Initialize and add the map
            function initMap() {
            // The location of Uluru
            var fss = {lat: 34.097940, lng: -117.768530};
            // The map, centered at Uluru
            var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 15, center: fss});
            // The marker, positioned at Uluru
            var marker = new google.maps.Marker({position: fss, map: map});
            }
                </script>
                <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxKlJDF69eYhnhxfrBykqxuc2RUebYqyg&callback=initMap">

                </script>
        </div>
    </div>
</div>

@endsection
