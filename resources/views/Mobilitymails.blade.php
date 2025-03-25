<!DOCTYPE html>
<html>

<head>
    <title>{{ $mobilityData['title'] }}</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6;">
    <div style="max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
        <h1 style="text-align: center; color: #333;">{{ $mobilityData['title'] }}</h1>

        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd; background-color: #f9f9f9; font-weight: bold;">Name:
                </td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $mobilityData['patient']->patientname }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd; background-color: #f9f9f9; font-weight: bold;">Phone:
                </td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $mobilityData['patient']->patientphone }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd; background-color: #f9f9f9; font-weight: bold;">Email:
                </td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $mobilityData['patient']->patientemail }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd; background-color: #f9f9f9; font-weight: bold;">Age:
                </td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $mobilityData['patient']->age }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd; background-color: #f9f9f9; font-weight: bold;">Gender:
                </td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $mobilityData['patient']->gender }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd; background-color: #f9f9f9; font-weight: bold;">
                    Suffering From:
                </td>
                <td style="padding: 8px; border: 1px solid #ddd;">
                    @foreach ($mobilityData['body']->suffering as $item)
                        @if ($item === '1')
                            Paralysis,
                        @elseif($item === '2')
                            Knee Joint Pain,
                        @elseif($item === '17')
                            Parkinson Disease,
                        @elseif($item === '18')
                            Cervical Pain,
                        @elseif($item === '19')
                            Lower Back Pain,
                        @elseif($item === '20')
                            Muscular Dystrophy,
                        @elseif($item === '21')
                            Motor Neuron Disease,
                        @elseif($item === '22')
                            Guillain-Barre Syndrome,
                        @endif
                    @endforeach
                </td>
            </tr>
        </table>

        <p style="text-align: center; color: #999; margin-top: 20px;">MOBILITY TEST</p>
    </div>
</body>

</html>
