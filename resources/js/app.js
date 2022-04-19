
$(document).ready(function () {
    $('.post-feedback-actions').on('click', 'button[data-feedback-type]', function () {
        let feedbackType = $(this).data('feedback-type');
        let postId = $(this).data('post-id');
        let container = $(this).closest('.post-feedback-actions');
        let actionUrl = container.data('action-url');
        
        container.addClass('disabled');

        $.ajax({
            url: actionUrl,
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                type: feedbackType,
                post_id: postId,
            },
            success: function (html) {
                let btnSelector = '.post-feedback-buttons';
                let content =  $(html).find(btnSelector).html();

                container.find(btnSelector).html(content);
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