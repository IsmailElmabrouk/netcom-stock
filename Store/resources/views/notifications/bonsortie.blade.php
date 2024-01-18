@component('mail::message')
# Bon de Sortie Notification

Your Bon de Sortie with ID {{ $data['bonSortieId'] }} has been {{ $data['status'] }}.

Thanks,<br>
{{ config('app.name') }}
@endcomponent