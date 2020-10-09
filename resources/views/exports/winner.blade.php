<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Hadiah</th>
    </tr>
    </thead>
    <tbody>
    @foreach($participants as $key => $participant)
        <tr>
            <th scope="row">{{$key + 1}}</th>
            <td>{{$participant->name}}</td>
            <td>{{$participant->prizes->name}}</td>
        </tr>
    @endforeach
    </tbody>
</table>