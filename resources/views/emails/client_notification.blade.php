@component('mail::message')
Hello  {{ $client_name }} , your shipping request has been received!

Package Name: {{ $package_name }} <br/>
Package Description: {{ $package_description }} <br/>
Shipping Cost: {{ $shipping_cost }} <br/>
<br />
<br />
One of us will contact you shortly to confirm your details.
<br />
Best regards.
<br />
@endcomponent
