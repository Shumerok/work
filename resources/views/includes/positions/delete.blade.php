<div class="modal fade" id="delete{{$position->id}}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Positions</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 class="text-center">Are you sure you want to delete Position: <strong>{{$position->name}}</strong>?
                </h4>
            </div>
            <div class="modal-footer">
                <div class="form-group col-auto">
                    <form action="{{route('positions.destroy', $position->id)}}"
                          class=""
                          method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="d-flex">
                            <div class="mr-3">
                                <button type="reset" class="btn btn-block btn-secondary btn-flat" data-dismiss="modal">
                                    Cancel
                                </button>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-block btn-secondary btn-flat">Remove</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>