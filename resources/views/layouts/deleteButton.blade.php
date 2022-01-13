<style>
    #deleteButton {
	background: none;
	color: inherit;
	border: none;
	padding: 0;
	cursor: pointer;
	outline: inherit;
}
</style>
<form action="{{$action}}" method="POST">
    @csrf
    @method('delete')
        <button onclick="return confirm('Are you sure?')" id="deleteButton" type="submit" class="text-danger fa fa-trash"></button>
</form>