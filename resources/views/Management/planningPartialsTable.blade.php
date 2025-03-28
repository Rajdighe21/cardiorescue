@if ($WeekSessions->isNotEmpty())
    @foreach ($WeekSessions as $session)
        <tr>
            @foreach (['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day)
                <td>
                    @if ($session->day == $day)
                        <div class="d-flex flex-column align-items-center">
                            <h6 class="mb-0 text-xs">
                                {{ $session->patient ? $session->patient->patient_name : 'Unknown' }}
                            </h6>
                            <p class="text-xs text-secondary mb-0">{{ $session->date }}</p>
                        </div>
                    @else
                        <h6 class="mb-0 text-xs">-</h6>
                    @endif
                </td>
            @endforeach
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="7" class="text-center">No Record Found</td>
    </tr>
@endif
