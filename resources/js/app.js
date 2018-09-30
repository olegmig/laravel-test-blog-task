import swal from "sweetalert";

require('./bootstrap');

$(document).ready(() => {
    const $addCommentForm = $('.js-add-comment-form'),
          $commentsSection = $('.js-comments-section'),
          $commentsBlock = $commentsSection.find('.js-comments-block'),
          $noCommentsLabel = $commentsSection.find('.js-no-comments'),
          $errorLabel = $('.js-error-label');

    // add new comment
    $addCommentForm.on('submit', function (e) {
        e.preventDefault();

        let data = {
            author: $('#author').val(),
            content: $('#content').val(),
            category_id: $('#category_id').val(),
            post_id: $('#post_id').val(),
        };

        // clear all possible previously shown errors
        $errorLabel.hide().html('');

        // send a request to server to add the comment
        axios.post($(this).attr('action'), data)
            .then(response => {
                // check for errors
                if (!response.data.status || !response.data.comment) {
                    for (let field in response.data.messages) {
                        let errorMessages = [];
                        response.data.messages[field].forEach(error => {
                            errorMessages.push(error);
                        });

                        // show errors in associated labels
                        $(`#${field}`).next().html(errorMessages.join('<br>')).show();
                    }
                    return;
                }

                // okay, append this comment
                let commentHtml = `
                    <div class="card mb-2">
                        <div class="card-body">
                            <p>
                                <strong>${response.data.comment.author}</strong>
                            </p>
                            <div class="clearfix"></div>
                            <p>${response.data.comment.content}</p>
                        </div>
                    </div>
                `;
                $commentsBlock.prepend(commentHtml);

                // remove "no comments" text
                if ($noCommentsLabel.length) {
                    $noCommentsLabel.remove();
                }

                // clear form
                $(this).trigger('reset');
            })
            .catch(error => {
                console.error(error);
                return swal('Error', 'Error occurred', 'error');
            });
    });
});
