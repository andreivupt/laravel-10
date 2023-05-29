<h1>Lista de suportes</h1>

<div>
    <a href="{{ route('supports.create') }}">Criar suporte</a>
</div>

<table>
    <thead>
        <th>Assunto</th>
        <th>Status</th>
        <th>Descrição</th>
        <th></th>
        <th></th>
        <th></th>
    </thead>
    <tbody>
        @foreach($supports->items() as $support)
            <tr>
                <td>{{ $support->subject }}</td>
                <td>{{ $support->status }}</td>
                <td>{{ $support->body }}</td>
                <td>
                    <a href="{{ route('supports.show', ['id' => $support->id]) }}">Ver</a>
                </td>
                <td>
                    <a href="{{ route('supports.edit', ['id' => $support->id]) }}">Modificar</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<x-pagination
    :paginator="$supports"
    :appends="$filters"
/>
