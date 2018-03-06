<div class="modal fade" id="editCommentModal{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="editCommentModalLabel{{ $comment->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCommentModalLabel{{ $comment->id }}">Edit Comment</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('comment.update') }}" method="post">
                        <textarea class="form-control" id="content" name="content" rows="5">{{ $comment->content }}</textarea>
                        <input type="hidden" name="postId" value="{{ $post->id }}">
                        <input type="hidden" name="commentId" value="{{ $comment->id }}">
                        {{ csrf_field() }}
                        <div class="modal-buttons">
                            <button type="submit" class="btn btn-primary">Edit</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>