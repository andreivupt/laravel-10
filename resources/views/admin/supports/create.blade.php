<form method="POST" action="{{ route('supports.store') }}">
    @csrf
    <input type="text" placeholder="Assunto" name="subject">
    <textarea name="body" cols="30" rows="5" placeholder="Descrição"></textarea>
    <button type="submit">Salvar</button>
</form>
