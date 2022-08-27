<div>
    <div class="row">
        @if (session()->has('message'))
            <p class="alert alert-success">{{ session()->get('message') }}</p>
        @endif
            <div class="col-sm-4">
                <label class="form-label" for="date"> Booking Date</label>
                <p>{{ $trip->date }}</p>
            </div>
            <div class="col-sm-4">
                <label class="form-label" for="date"> Booking Time</label>
                <p>{{ $trip->time }}</p>
            </div>
            <div class="col-sm-4">
                <p><b>Seat Info:</b></p>
                <div class="form-check">
                    <input class="form-check-input" disabled type="checkbox">
                    <label class="form-check-label text-danger" for="booked">
                        Booked
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-labebl" for="available">
                        Available
                    </label>
                </div>
            </div>
            <div class="col-sm-12">





                <button wire:click.prevent="searchSeat" class="btn btn-primary btn-sm">View Seats</button>

            </div>

    </div>
    <hr>


    @if (count($seats) > 0)
        @foreach ($trip->bus->seats->chunk(6) as $row)
            <div class=>
                @foreach ($row as $seat)
                    <div class="col-sm-3">
                        <div class="form-check">
                            <input wire:model="selectedSeats" class="form-check-input" type="checkbox" name="chk" onclick= return sakib
                                value="{{ $seat->id }}" id="seat-{{ $seat->id }}"
                                @foreach ($booked as $book)
                            @if ($book->seat_id == $seat->id )

                            disabled


                            @endif

                @endforeach
                >




                <label
                    class="form-check-label
                @foreach ($booked as $book)
                        @if ($book->seat_id == $seat->id)
                            text-danger
                        @endif
                    @endforeach
                "
                    for="seat-{{ $seat->id }}">
                    {{ $seat->name }}
                </label>
            </div>
</div>
@endforeach
</div>
@endforeach
<br>

<h4>Seat and Payment Details:</h4>
<hr>
@if (count($selectedSeats) < 7)
<p><b>Total Seats:</b> {{ count($selectedSeats) ?? '0' }}</p>



<p><b>Total Price:</b> {{ $totalPrice ?? '00.00' }}</p>
@else
<H2>You can  choose only 6 seats at a time</H2>
         @endif

@if(!empty(auth()->user()))

@if (count($selectedSeats)<7 && $mehadi->count()<7 )

<button wire:click="book"  type="submit" class="btn btn-primary btn-sm">Book Now  </button>


<a href="{{route('booking.details')}}" class="btn btn-primary btn-sm">View Booking Details</a>


@else

<a href="{{route('booking.details')}}" class="btn btn-primary btn-sm">View Booking Details </a>

         @endif
@else
<a href="{{route('user.login')}}" class="btn btn-primary btn-sm">Book Now</a>
@endif
@endif



</div>
