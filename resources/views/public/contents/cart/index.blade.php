@extends('public.index')
@section('heads')
  <title>Keranjang</title>
@endsection
@section('content')
  <header class="header-2">
    <div class="page-header min-vh-75 relative">
      <span class="mask bg-gradient-primary opacity-4 pt-6"></span>
      <form class="container mt-6" action="{{ route('order.store') }}" method="POST">
        @csrf
        <div class="row">
          <div class="card card-body blur shadow-blur col-lg-6 my-6 bg-light">
            <div class="px-6">
              <div class="row">
                @livewire('textfield.input-text-field', [
                  'id' => 'email',
                  'type' => 'text',
                  'label' => 'Email'
                ])
              </div>
              <div class="row">
                @livewire('textfield.input-text-field', [
                  'id' => 'country',
                  'type' => 'text',
                  'label' => 'Country/Region'
                ])
              </div>
              <div class="row">
                @livewire('textfield.input-text-field', [
                  'id' => 'first_name',
                  'type' => 'text',
                  'label' => 'First Name'
                ])
                @livewire('textfield.input-text-field', [
                  'id' => 'last_name',
                  'type' => 'text',
                  'label' => 'Last Name'
                ])
              </div>
              <div class="row">
                @livewire('textfield.input-text-field', [
                  'id' => 'company',
                  'type' => 'text',
                  'label' => 'Company(Optional)'
                ])
              </div>
              <div class="row">
                @livewire('textfield.input-text-field', [
                  'id' => 'address',
                  'type' => 'text',
                  'label' => 'Address'
                ])
              </div>
              <div class="row">
                @livewire('textfield.input-text-field', [
                  'id' => 'city',
                  'type' => 'text',
                  'label' => 'City'
                ])
              </div>
              <div class="row">
                @livewire('textfield.input-text-field', [
                  'id' => 'province',
                  'type' => 'text',
                  'label' => 'Province'
                ])
                @livewire('textfield.input-text-field', [
                  'id' => 'postal_code',
                  'type' => 'text',
                  'label' => 'Postal Code'
                ])
              </div>
              <div class="row">
                @livewire('textfield.input-text-field', [
                  'id' => 'phone',
                  'type' => 'text',
                  'label' => 'Phone'
                ])
              </div>
              @livewire('button.complete-order-button')
            </div>
          </div>
          @livewire('cart.preview-cart')
        </div>
      </form>
    </div>
  </header>    
@endsection
@section('scripts')
  <script>
    function foo(button) {
      // Set the date we're counting down to
      let currentTimePlus5Minutes = new Date().getTime() + 1 * 60000;
      var countDownDate = new Date(currentTimePlus5Minutes).getTime();
      let countdown = 60;

      let interval = setInterval(() => {
        // Get today's date and time
        let now = new Date().getTime();

        // Find the distance between now and the count down date
        let distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        let minutes = Math.floor((distance % (1000 * countdown * countdown)) / (1000 * countdown));
        let seconds = Math.floor((distance % (1000 * countdown)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s ";

        // If the count down is finished, write some text
        if (distance < 0) {
          clearInterval(interval);
          document.getElementById("timer").innerHTML = "EXPIRED";
        }
      }, 1000);
    }
  </script>
@endsection
