<div class="modal fade" id="createCommentModal" tabindex="-1" role="dialog" aria-labelledby="createCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCommentModalLabel">New Comment</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('comment.create') }}" method="post">
                    <textarea class="form-control" id="content" name="content" rows="5"></textarea>
                    <input type="hidden" name="postId" value="{{ $post->id }}">
                    {{ csrf_field() }}
                    <div class="modal-buttons">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>