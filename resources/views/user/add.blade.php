    <form action="{{url('/asss')}}" method="POST">
    @csrf
        <input type="text" name="name">
        <input type="submit" value="发懵中">
    </form>