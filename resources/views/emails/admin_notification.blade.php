@component('mail::message')
A new shipping request has been received!

Client Name: {{ $client_name }} <br/>
Client Email: {{ $client_email }} <br/>
Package Name: {{ $package_name }} <br/>
Package Description: {{ $package_description }} <br/>
Shipping Cost: {{ $shipping_cost }} <br/>
<br />
<br />

Best regards.
<br />
@endcomponent
