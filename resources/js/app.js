$(document).ready(function () {
    $('.post-feedback-actions').on('click', 'button[data-feedback-type]', function () {
        let feedbackType = $(this).data('feedback-type');
        let postId = $(this).data('post-id');
        let container = $(this).closest('.post-feedback-actions');
        let likeBtn = container.find('.btn-like');
        let dislikeBtn = container.find('.btn-dislike');
        
        container.addClass('disabled');

        $.ajax({
            url: '{{ route('post.feedback.update') }}',
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                type: feedbackType,
                post_id: postId,
            },
            success: function (html) {
                let btnSelector = '.post-feedback-buttons';
                let btnHtml =  $(html).find(btnSelector);

                container.find(btnSelector).html(btnHtml);
            },
            error: function () {
                alert('Error sending request');
            },
            complete: function () {
                container.removeClass('disabled');
            },
        });
    });
});