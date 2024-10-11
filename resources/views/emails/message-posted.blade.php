
<x-mail::message>
    <x-mail::panel> 
        You have received a new enquiry
    </x-mail>

    Name: {{ $data['name'] }}
    Email: {{ $data['email'] }}
    Message: {{ $data['message'] }}

    Thanks

</x-mail>
    