@component('mail::message')
# A new event has been added!

**Name:** {{ $new_event->eventName }}

**On:** {{ $new_event->eventDate }}

**From:** {{ $new_event->eventTimeStart }}

**Until:** {{ $new_event->eventTimeEnd }}

@component('mail::button', ['url' => 'http://www.pubmic.co.uk/pubmic/venues/' . $new_event->venue_id])
Go to Venue
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
