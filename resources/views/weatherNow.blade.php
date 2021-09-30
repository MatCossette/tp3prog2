<table>
    <thead>
        <th>#weather</th>
        <th>#temp</th>
        <th>#icon</th>
    </thead>
    <tbody>
        @foreach($weatherNow as $weatherNow)
        <tr>
            <td>{{ $weatherNow->weather }}</td>
            <td>{{ $weatherNow->temp }}</td>
            <td>{{ $weatherNow->icon }}</td>

        </tr>
        @endforeach
    </tbody>
</table>

<!-- Issues with: weatheNow as weatherNow
Comment aller aller chercher les infos nested dans les objects? (Json.parse?) -->